<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\BidModel;
use \App\Models\BidProductModel;
use \App\Models\HomeModel;
use \App\Models\ClientModel;
use \App\Models\DepartmentModel;
use \App\Models\EligibilityModel;
use \App\Models\TermsModel;
use \App\Models\BideligibilityModel;
use \App\Models\BidTermsModel;
use \App\Models\DataCallModel;

class Bid extends Controller
{
	function bid_details()
	{
		$pager = \Config\Services::pager();
		helper('text');
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),			
			"clients"=>(new ClientModel())->where('client_isDelete', 0)->findAll(),
			"departments"=>(new DepartmentModel())->where('dept_isDelete', 0)->findAll(),
			// "bids"=>(new BidModel())->where('bid_isDelete', 0)->findAll()->paginate(2),
			// "pager"=>(new BidModel())->where('bid_isDelete', 0)->findAll()->pager,
			"all_products"=>(new HomeModel())->getData('product_isDelete=0','sales_product'),
			"bids"=> (new BidModel())->paginate(2),
			"pager" => (new BidModel())->pager
		];
		return view('bid/bid_details', $data);
	}

	function create_bid()
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
			"all_region"=>(new HomeModel())->getData('reg_isDelete=0','sales_region'),
			"departments"=>(new DepartmentModel())->where('dept_isDelete', 0)->findAll(),
			"eligibility"=>(new EligibilityModel())->where('el_isDelete', 0)->findAll(),
			"terms"=>(new TermsModel())->where('term_isDelete', 0)->findAll(),
		];

		if($this->request->getMethod() == 'post'){
			$bid = [
				'bid_type'=>$this->request->getVar('bid_type'),
				'bid_lead_ref'=>$this->request->getVar('bid_lead_ref'),
				'bid_endDate'=>date('Y-m-d H:i:00',strtotime($this->request->getVar('bid_endDate'))),
				'bid_openDate'=>date('Y-m-d H:i:00',strtotime($this->request->getVar('bid_openDate'))),
				'bid_validity'=>$this->request->getVar('bid_validity'),
				'bid_region'=>$this->request->getVar('bid_region'),
				'bid_client'=>$this->request->getVar('bid_client'),
				'bid_dept'=>$this->request->getVar('bid_dept'),
				'bid_emd'=>$this->request->getVar('bid_emd'),
				'bid_epbg'=>$this->request->getVar('bid_epbg'),
				'bid_contact_person'=>$this->request->getVar('bid_contact_person'),
				'bid_status'=>0,
				'bid_createdBy'=>session()->get('id'),
				'bid_createdOn'=>date('Y-m-d H:i:s'),
			];
			(new BidModel())->insert($bid);
			$bid_id = (new BidModel)->insertID();
			for ($i=0; $i < count($this->request->getVar('bidprod_product_id')); $i++) { 
				$product = [
					'bidprod_bid_id'=>$bid_id,
					'bidprod_product_id'=>$this->request->getVar('bidprod_product_id'.'['.$i.']'),
					'bidprod_qty'=>$this->request->getVar('bidprod_qty'.'['.$i.']'),
					'bidprod_spcification'=>$this->request->getVar('bidprod_spcification'.'['.$i.']'),
					'bidprod_mm'=>$this->request->getVar('bidprod_mm'.'['.$i.']'),
					'bidprod_budget'=>$this->request->getVar('bidprod_budget'.'['.$i.']'),
					'bidprod_gem'=>$this->request->getVar('bidprod_gem'.'['.$i.']'),
					'bidprod_tprice'=>$this->request->getVar('bidprod_tprice'.'['.$i.']'),
					'bidprod_qprice'=>$this->request->getVar('bidprod_qprice'.'['.$i.']'),
					'bidprod_status'=>0,
					'bidprod_createdOn'=>date('Y-m-d H:i:s'),
				];
				(new BidProductModel())->insert($product);
			}

			for ($j=0; $j < count($data['eligibility']); $j++) {
				if(in_array(($j+1), $this->request->getVar('be_eligibility_id')) == 1){ 
					$eligibility = [
						'be_bid_id'=>$bid_id,
						'be_eligibility_id'=>$data['eligibility'][$j]['el_id'],
						'be_value'=>$this->request->getVar('be_value'.'['.$j.']'),
						'be_doc_required'=>$this->request->getVar('be_doc_required'.'['.$j.']'),
						'be_doc_name'=>$this->request->getVar('be_doc_name'.'['.$j.']'),
						'be_createdOn'=>Date('Y-m-d_H-i:s'),
						'be_createdBy'=>session()->get('id')
					];
					(new BideligibilityModel())->insert($eligibility);
				}
			}

			for ($k=0; $k < count($data['terms']); $k++) { 
				if(in_array(($k+1), $this->request->getVar('bt_term_id')) == 1){ 
					$terms = [
						'bt_bid_id'=>$bid_id,
						'bt_term_id'=>$data['terms'][$k]['term_id'],
						'bt_value'=>$this->request->getVar('bt_value'.'['.$k.']'),
						'bt_doc_required'=>$this->request->getVar('bt_doc_required'.'['.$k.']'),
						'bt_doc_remark'=>$this->request->getVar('bt_doc_remark'.'['.$k.']'),
						'bt_createdOn'=>Date('Y-m-d_H-i:s'),
						'bt_createdBy'=>session()->get('id')
					];
					(new BidTermsModel())->insert($terms);
				}
			}
			
			session()->setFlashdata('success','Bid successfully created..!');
			return redirect()->route('bid/bid_details');
		}
		return view('bid/create_bid', $data);
	}

	function getBidInfo()
	{
		$chkVal = $_POST['chkVal'];	
		$bid_data=(new HomeModel())->getData(array('bid_id'=>$chkVal),'sales_bid');
		echo json_encode($bid_data);
	}

	function getBidProducts()
	{	
		$chkVal = $_POST['chkVal'];	
		$prData= db_connect()->query("SELECT * FROM `sales_bid_products` JOIN sales_product on bidprod_product_id = product_id WHERE bidprod_bid_id = ".$chkVal." AND bidprod_isDelete = 0")->getResultArray();
		echo json_encode($prData);
	}

	function getDepartmentInfo()
	{
		$chkVal = $_POST['chkVal'];	
		$dpData = (new HomeModel())->getData(array('dept_id'=>$chkVal),'sales_department');
		echo json_encode($dpData);
	}
	function getEligibility()
	{
		$chkVal = $_POST['chkVal'];	
		$elInfo = db_connect()->query("SELECT * FROM `sales_bid_eligibility` JOIN sales_eligibility on be_eligibility_id = el_id WHERE be_bid_id = ".$chkVal." AND be_isDelete = 0")->getResultArray();
		echo json_encode($elInfo);
	}

	function getTerms()
	{
		$chkVal = $_POST['chkVal'];	
		$elInfo = db_connect()->query("SELECT * FROM `sales_bid_terms` JOIN sales_terms on bt_term_id = term_id WHERE bt_bid_id = ".$chkVal." AND bt_isDelete = 0")->getResultArray();
		echo json_encode($elInfo);
	}

	function bid_data_call()
	{
		// print_r((service('uri'))->getSegment(2));
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),
			"dataCall" => (new DataCallModel())->where(array('dc_isDelete'=>0,'dc_type'=>2,'dc_type_id'=>(service('uri'))->getSegment(2)))->findAll(),
		];

		if($this->request->getMethod() == 'post'){
			$dataCall = [
				'dc_type' => 2,
				'dc_type_id' => $this->request->getVar('dc_lead_id'),
				'dc_date' => $this->request->getVar('dc_date'),
				'dc_action' => $this->request->getVar('dc_action'),
				'dc_remark' => $this->request->getVar('dc_remark'),
				'dc_createdBy' => session()->get('id'),
				'dc_createdOn' => date('Y-m-d H:i:s'),
			];
			(new DataCallModel())->insert($dataCall);
			session()->setFlashdata('success','Data Call Updated...!!');
			return redirect()->to("bid_progress");
		}

		return view('bid/bid_data_call',$data);
	}


}