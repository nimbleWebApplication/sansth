<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\userModel;

class Master extends Controller
{
	function create_new_customer()
	{
		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"departments"=>(new HomeModel())->getData('dept_isDelete=0','sales_department'),
			"state"=>(new HomeModel())->getData('country_id=101','sales_state'),
			"cities"=>(new HomeModel())->getData('st_id=22','sales_cities'),
		];
		return view('masters/create_new_customer', $data);
	}

	function new_customer()
	{
		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"departments"=>(new HomeModel())->getData('dept_isDelete=0','sales_department'),
			"state"=>(new HomeModel())->getData('country_id=101','sales_state'),
			"cities"=>(new HomeModel())->getData('st_id=22','sales_cities'),
		];
		return view('masters/new_customer', $data);
	}
	function getCity()
	{
		$chkVal = $_POST['chkVal'];	
		$cityInfo = (new HomeModel())->getData(array('st_id'=>$chkVal),'sales_cities');
		echo json_encode($cityInfo);
	}

	function save_customer()
	{
		if($this->request->getMethod() == 'post'){
			// print_r($lead);die();
			$cust = [
				'client_name' => $this->request->getVar('client_name'),
				'client_contact' => $this->request->getVar('client_contact'),
				'client_other_contact' => $this->request->getVar('client_other_contact'),
				'client_email' => $this->request->getVar('client_email'),
				'client_other_email' => $this->request->getVar('client_other_email'),
				'client_address' => $this->request->getVar('client_address'),
				'client_state' => $this->request->getVar('client_state'),
				'client_city' => $this->request->getVar('client_city'),
				'client_pincode' => $this->request->getVar('client_pincode'),
				'client_website' => $this->request->getVar('client_website'),
				// 'client_department' => $this->request->getVar('client_department'),
				'client_createdBy' => session()->get('id'),
				'client_createdOn' => date('Y-m-d H:i:s'),
			];
			
			(new HomeModel())->insertData($cust,'sales_client');
			//print_r($cust);die();
			$client_id = (new HomeModel())->insertID();	//die();
			$contact_person = [
				'cp_first_name' => $this->request->getVar('cp_first_name'),
				'cp_middle_name' => $this->request->getVar('cp_middle_name'),
				'cp_last_name' => $this->request->getVar('cp_last_name'),
				'cp_mobile' => $this->request->getVar('cp_mobile'),
				'cp_other_contact' => $this->request->getVar('cp_other_contact'),
				'cp_email' => $this->request->getVar('cp_email'),
				'cp_company' => $client_id,
				'cp_contact_for' => 1,
				'cp_department' => $this->request->getVar('cp_department'),
				'cp_createdBy' =>  session()->get('id'),
				'cp_createdOn' => date('Y-m-d H:i:s'),
				'cp_isDelete' => 0,
			];
			(new HomeModel())->insertData($contact_person,'sales_contact_person');
			//print_r($contact_person);die();
			session()->setFlashdata('success','Client successfully created..!');
			return redirect()->route('sales/pre-sales');
		}

	}
	function save_new_customer()
	{
		if($this->request->getMethod() == 'post'){
			// print_r($lead);die();
			$cust = [
				'client_name' => $this->request->getVar('client_name'),
				'client_contact' => $this->request->getVar('client_contact'),
				'client_other_contact' => $this->request->getVar('client_other_contact'),
				'client_email' => $this->request->getVar('client_email'),
				'client_other_email' => $this->request->getVar('client_other_email'),
				'client_address' => $this->request->getVar('client_address'),
				'client_state' => $this->request->getVar('client_state'),
				'client_city' => $this->request->getVar('client_city'),
				'client_pincode' => $this->request->getVar('client_pincode'),
				'client_website' => $this->request->getVar('client_website'),
				// 'client_department' => $this->request->getVar('client_department'),
				'client_createdBy' => session()->get('id'),
				'client_createdOn' => date('Y-m-d H:i:s'),
			];
			
			(new HomeModel())->insertData($cust,'sales_client');
			//print_r($cust);die();
			$client_id = (new HomeModel())->insertID();	//die();
			$contact_person = [
				'cp_first_name' => $this->request->getVar('cp_first_name'),
				'cp_middle_name' => $this->request->getVar('cp_middle_name'),
				'cp_last_name' => $this->request->getVar('cp_last_name'),
				'cp_mobile' => $this->request->getVar('cp_mobile'),
				'cp_other_contact' => $this->request->getVar('cp_other_contact'),
				'cp_email' => $this->request->getVar('cp_email'),
				'cp_company' => $client_id,
				'cp_contact_for' => 1,
				'cp_department' => $this->request->getVar('cp_department'),
				'cp_createdBy' =>  session()->get('id'),
				'cp_createdOn' => date('Y-m-d H:i:s'),
				'cp_isDelete' => 0,
			];
			(new HomeModel())->insertData($contact_person,'sales_contact_person');
			//print_r($contact_person);die();
			session()->setFlashdata('success','Client successfully created..!');
			return redirect()->route('master/customer_details');
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

	function update_cust()
	{
		//echo service('uri'); die();
		$client_id = [
	        'client_id'  => (service('uri'))->getSegment(3),
	        'lead_id'  => (service('uri'))->getSegment(4)
		];
		session()->set($client_id);			
		return redirect()->route('master/update_customer');	
	}

	function update_customer()
	{
		helper('text');
		$home = new HomeModel();

		$client_data= session()->get($client_id); 

		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"departments"=>(new HomeModel())->getData('dept_isDelete=0','sales_departments'),
			"state"=>(new HomeModel())->getData('country_id=101','sales_state'),
			"cities"=>(new HomeModel())->getData('st_id=22','sales_cities'),
			"customer_details"=>(new HomeModel())->getData('client_id='.$client_data['client_id'].'','sales_client'),
			"lead_details"=>(new HomeModel())->getData('lead_id='.$client_data['lead_id'].'','sales_lead'),
		];
		//print_r($data);die();
		return view('masters/update_customer', $data);
	}
	function update_customer_save()
	{
		if($this->request->getMethod() == 'post'){
			// print_r($lead);die();
			$cust = [
				'client_name' => $this->request->getVar('client_name'),
				'client_contact' => $this->request->getVar('client_contact'),
				'client_other_contact' => $this->request->getVar('client_other_contact'),
				'client_email' => $this->request->getVar('client_email'),
				'client_other_email' => $this->request->getVar('client_other_email'),
				'client_address' => $this->request->getVar('client_address'),
				'client_state' => $this->request->getVar('client_state'),
				'client_city' => $this->request->getVar('client_city'),
				'client_pincode' => $this->request->getVar('client_pincode'),
				'client_website' => $this->request->getVar('client_website'),
			];
			$lead_id = $this->request->getVar('lead_id');
			(new HomeModel())->updateData($cust,'sales_client',array('client_id'=>$this->request->getVar('client_id')));
			//print_r($cust);die();
			session()->setFlashdata('success','Client successfully updated..!');
			return redirect()->to('sales/update_lead_open/'.$lead_id.'');
		}
	}

	function customer_details(){

		helper('text');
		$home = new HomeModel();
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
			"client_details"=>(new HomeModel())->getData(array('client_isDelete'=>0),'sales_client'),
		];

		return view('masters/customer_details', $data);
	}

	function up_cust()
	{
		//echo service('uri'); die();
		$client_id = [
	        'client_id'  => (service('uri'))->getSegment(3),
		];
		session()->set($client_id);			
		return redirect()->route('master/up_customer');	
	}

	function up_customer()
	{
		helper('text');
		$home = new HomeModel();

		$client_data= session()->get($client_id); 

		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"departments"=>(new HomeModel())->getData('dept_isDelete=0','sales_departments'),
			"state"=>(new HomeModel())->getData('country_id=101','sales_state'),
			"cities"=>(new HomeModel())->getData('st_id=22','sales_cities'),
			"customer_details"=>(new HomeModel())->getData('client_id='.$client_data['client_id'].'','sales_client'),
			// "lead_details"=>(new HomeModel())->getData('lead_id='.$client_data['lead_id'].'','sales_lead'),
			"dept_details"=>(new HomeModel())->getData('dept_isDelete=0','sales_department'),
			"cp_details"=>(new HomeModel())->getData('cp_company='.$client_data['client_id'].'','sales_contact_person'),
		];
		//print_r($data);die();
		return view('masters/update_cust', $data);
	}

	function up_customer_save()
	{
		if($this->request->getMethod() == 'post'){
			// print_r($lead);die();
			$cust = [
				'client_name' => $this->request->getVar('client_name'),
				'client_contact' => $this->request->getVar('client_contact'),
				'client_other_contact' => $this->request->getVar('client_other_contact'),
				'client_email' => $this->request->getVar('client_email'),
				'client_other_email' => $this->request->getVar('client_other_email'),
				'client_address' => $this->request->getVar('client_address'),
				'client_state' => $this->request->getVar('client_state'),
				'client_city' => $this->request->getVar('client_city'),
				'client_pincode' => $this->request->getVar('client_pincode'),
				'client_website' => $this->request->getVar('client_website'),
			];
			// $lead_id = $this->request->getVar('lead_id');
			// print_r($cust);die();
			(new HomeModel())->updateData($cust,'sales_client',array('client_id'=>$this->request->getVar('client_id')));
			session()->setFlashdata('success','Client successfully updated..!');

			$data = [
				"success" => session()->getFlashdata('success'),
				"error" => session()->getFlashdata('error'),
				"info" => session()->getFlashdata('info'),
				"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
				"client_details"=>(new HomeModel())->getData(array('client_isDelete'=>0),'sales_client'),
			];
			return view('masters/customer_details', $data);
		}
	}

	function delete_cp()
	{
		$cp_id=$_POST['cp_id']; 
		$client_id=$_POST['client_id'];// die();
		(new HomeModel())->updateData(array('cp_isDelete'=>1),'sales_contact_person',array('cp_id'=>$cp_id));
		//return redirect()->route('master/up_cust/'.$client_id.'');	
		session()->setFlashdata('success','Contact person deleted..!');
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"departments"=>(new HomeModel())->getData('dept_isDelete=0','sales_departments'),
			"state"=>(new HomeModel())->getData('country_id=101','sales_state'),
			"cities"=>(new HomeModel())->getData('st_id=22','sales_cities'),
			"customer_details"=>(new HomeModel())->getData('client_id='.$_POST['client_id'].'','sales_client'),
			//"lead_details"=>(new HomeModel())->getData('lead_id='.$client_data['lead_id'].'','sales_lead'),
			"dept_details"=>(new HomeModel())->getData('dept_isDelete=0','sales_department'),
			"cp_details"=>(new HomeModel())->getData(array('cp_company'=>$_POST['client_id'],'cp_isDelete'=>0),'sales_contact_person'),
		];
		//print_r($data);die();
		return view('masters/update_cust', $data);

	}

	function add_cp()
	{
		$contact_person = [
				'cp_first_name' => $_POST['cp_first_name'],
				'cp_middle_name' => $_POST['cp_middle_name'],
				'cp_last_name' => $_POST['cp_last_name'],
				'cp_mobile' => $_POST['cp_mobile'],
				'cp_other_contact' => $_POST['cp_other_contact'],
				'cp_email' => $_POST['cp_email'],
				'cp_company' => $_POST['client_id'],
				'cp_contact_for' => 1,
				'cp_department' => $_POST['cp_department'],
				'cp_createdBy' =>  session()->get('id'),
				'cp_createdOn' => date('Y-m-d H:i:s'),
				'cp_isDelete' => 0,
			];
			(new HomeModel())->insertData($contact_person,'sales_contact_person');
			//print_r($contact_person); die();
			$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),	
			"departments"=>(new HomeModel())->getData('dept_isDelete=0','sales_departments'),
			"state"=>(new HomeModel())->getData('country_id=101','sales_state'),
			"cities"=>(new HomeModel())->getData('st_id=22','sales_cities'),
			"customer_details"=>(new HomeModel())->getData('client_id='.$_POST['client_id'].'','sales_client'),
			//"lead_details"=>(new HomeModel())->getData('lead_id='.$client_data['lead_id'].'','sales_lead'),
			"dept_details"=>(new HomeModel())->getData('dept_isDelete=0','sales_department'),
			"cp_details"=>(new HomeModel())->getData(array('cp_company'=>$_POST['client_id'],'cp_isDelete'=>0),'sales_contact_person'),
		];
		//print_r($data);die();
		return view('masters/update_cust', $data);
	}
}

?>