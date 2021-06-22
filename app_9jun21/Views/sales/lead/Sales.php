<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\userModel;

class Sales extends Controller
{
	function pre_sales_details()
	{
		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
			"lead_details"=>(new HomeModel())->getData(array('lead_isDelete'=>0),'sales_lead'),
		];

		return view('sales/pre_sales_details', $data);
	}

	function create_lead()
	{
		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"client_details"=>(new HomeModel())->getData('client_isDelete=0','sales_client'),
			"all_products"=>(new HomeModel())->getData('product_isDelete=0','sales_product'),
		];
		return view('sales/lead/create_lead', $data);
	}
	function save_lead()
	{
		if($this->request->getMethod() == 'post'){
			// print_r($lead);die();
			$lead = [
				'lead_generated_date' => $this->request->getVar('lead_generated_date'),
				'lead_client' => $this->request->getVar('lead_client'),
				'lead_dept' => $this->request->getVar('lead_dept'),
				'lead_due_date' => $this->request->getVar('lead_due_date'),
				'lead_budget' => $this->request->getVar('lead_budget'),
				'lead_procurement_type' => 0,
				'lead_file_status' => 0,
				'lead_status' => 0,
				'lead_participation_status' => 0,
				'lead_participation_remark' => '',
				'lead_createdBy' => session()->get('id'),
				'lead_createdOn' => date('Y-m-d H:i:s'),
			];
			//print_r($lead);die();
			(new HomeModel())->insertData($lead,'sales_lead');
			$lead_id = (new HomeModel())->insertID();	

			for ($i=0; $i < count($this->request->getVar('lr_product_id')) ; $i++) { 
				$product=[
					'lr_lead_id'=>$lead_id,
					'lr_product_id'=>$this->request->getVar('lr_product_id'.'['.$i.']'),
					'lr_quantity'=>$this->request->getVar('lr_quantity'.'['.$i.']'),
					'lr_proposed_product'=>$this->request->getVar('lr_proposed_product'.'['.$i.']'),
					'lr_product_specification'=>$this->request->getVar('lr_product_specification'.'['.$i.']'),
					'lr_product_gem_link'=>$this->request->getVar('lr_product_gem_link'.'['.$i.']'),
					'lr_isDelete'=>0,
				];
				//print_r($product);die();
				(new HomeModel())->insertData($product,'sales_lead_requirement');
			}
			
			session()->setFlashdata('success','Lead successfully created..!');
			return redirect()->route('sales/pre-sales');
		}

	}
	function getClientInfo()
	{
		$chkVal = $_POST['chkVal'];	
		$clientInfo=(new HomeModel())->getData(array('client_id'=>$chkVal,'client_isDelete'=>0),'sales_client');
		echo json_encode($clientInfo);
	}

	function getDepartment()
	{
		$chkVal = $_POST['chkVal'];	
		$cpInfo = (new HomeModel())->getDepartment($chkVal);
		echo json_encode($cpInfo);
	}

	function getContactPersons()
	{
		$chkVal = $_POST['chkVal'];	
		$cpInfo=(new HomeModel())->getData(array('cp_company'=>$chkVal,'cp_isDelete'=>0,'cp_contact_for'=>1),'sales_contact_person');
		echo json_encode($cpInfo);
	}

	function getContactPersonsDept()
	{
		$dept = $_POST['dept'];	
		$client = $_POST['client'];	
		$cpInfo=(new HomeModel())->getData(array('cp_company'=>$client,'cp_isDelete'=>0,'cp_contact_for'=>1,'cp_department'=>$dept),'sales_contact_person');
		echo json_encode($cpInfo);
	}

	function update_lead_open()
	{
		//echo service('uri'); die();
		$lead_id = [
	        'lead_id'  => (service('uri'))->getSegment(3)
		];
		session()->set($lead_id);			
		return redirect()->to('sales/update_lead');	
	}
	function update_lead()
	{
		$lead_data= session()->get($lead_id); 
		//print_r($lead_data);

		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"client_details"=>(new HomeModel())->getData('client_isDelete=0','sales_client'),
			"all_products"=>(new HomeModel())->getData('product_isDelete=0','sales_product'),
			"lead_details"=>(new HomeModel())->getData('lead_isDelete=0 AND lead_id='.$lead_data['lead_id'].'','sales_lead'),
			"dept_details"=>(new HomeModel())->getData('dept_isDelete=0','sales_department'),
			"cp_details"=>(new HomeModel())->getData('cp_isDelete=0','sales_contact_person'),
			"product_details"=>(new HomeModel())->getData(array('lr_isDelete'=>0,'lr_lead_id'=>$lead_data['lead_id']),'sales_lead_requirement'),
		];
		return view('sales/lead/update_lead', $data);
	}

	function delete_lead_product() //updateData($data,$table,$where)
	{
		$lead_id = $_POST['lead_id'];	
		$lr_id = $_POST['lr_id'];	
		$update=(new HomeModel())->updateData(array('lr_isDelete'=>1),'sales_lead_requirement',array('lr_id'=>$lr_id));
		echo json_encode($update);
	}

	function save_lead_update()
	{
		if($this->request->getMethod() == 'post'){
			// print_r($lead);die();
			$lead = [
				'lead_generated_date' => $this->request->getVar('lead_generated_date'),
				'lead_client' => $this->request->getVar('lead_client'),
				'lead_dept' => $this->request->getVar('lead_dept'),
				'lead_due_date' => $this->request->getVar('lead_due_date'),
				'lead_budget' => $this->request->getVar('lead_budget'),
				'lead_procurement_type' => 0,
				'lead_file_status' => 0,
				'lead_status' => 0,
				'lead_participation_status' => 0,
				'lead_participation_remark' => ''
			];
			//print_r($lead);die();
			(new HomeModel())->updateData($lead,'sales_lead',array('lead_id'=>$this->request->getVar('lead_id')));
			for ($i=0; $i < count($this->request->getVar('lr_product_id')) ; $i++) { 
				if($this->request->getVar('lr_id'.'['.$i.']') == 0 ){
					$product=[
						'lr_lead_id'=>$this->request->getVar('lead_id'),
						'lr_product_id'=>$this->request->getVar('lr_product_id'.'['.$i.']'),
						'lr_quantity'=>$this->request->getVar('lr_quantity'.'['.$i.']'),
						'lr_proposed_product'=>$this->request->getVar('lr_proposed_product'.'['.$i.']'),
						'lr_product_specification'=>$this->request->getVar('lr_product_specification'.'['.$i.']'),
						'lr_product_gem_link'=>$this->request->getVar('lr_product_gem_link'.'['.$i.']'),
						'lr_isDelete'=>0
					];
					//print_r($product);die();
					(new HomeModel())->insertData($product,'sales_lead_requirement');					
				}else{
					$product=[
						'lr_product_id'=>$this->request->getVar('lr_product_id'.'['.$i.']'),
						'lr_quantity'=>$this->request->getVar('lr_quantity'.'['.$i.']'),
						'lr_proposed_product'=>$this->request->getVar('lr_proposed_product'.'['.$i.']'),
						'lr_product_specification'=>$this->request->getVar('lr_product_specification'.'['.$i.']'),
						'lr_product_gem_link'=>$this->request->getVar('lr_product_gem_link'.'['.$i.']'),
					];
					(new HomeModel())->updateData($product,'sales_lead_requirement',array('lr_id'=>$this->request->getVar('lr_id'.'['.$i.']')));
				}
			}
			
			session()->setFlashdata('success','Lead successfully created..!');
			return redirect()->route('sales/pre-sales');
		}
	}
}
?>