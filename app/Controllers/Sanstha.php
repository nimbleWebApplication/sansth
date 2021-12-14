<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use \App\Models\HomeModel;
use \App\Models\UserModel;
use \App\Models\RegionModel;
use \App\Models\statesModel;
use \App\Models\CitiesModel;
use \App\Models\SansthaModel;
use \App\Models\PickupModel;
use \App\Models\SansthaDetailsModel;
$session = \Config\Services::session();

class Sanstha extends Controller
{
	public function __construct()
	{ 
		$this->SansthaModel = new SansthaModel();
	}
	function sanstha_details()
	{
		// echo service('uri')->getSegment(3); die();
		helper('text');

		if(service('uri')->getSegment(3) == 9999){
			$sansthaD=(new SansthaModel())->where('cs_isDelete',0)->findAll();
		}else{
			$sansthaD=(new SansthaModel())->where(array('cs_isDelete'=>0,'cs_state'=>service('uri')->getSegment(3)))->findAll();
		}

		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),			
			"state"=>(new statesModel())->where('country_id',101)->findAll(),
			"cities"=>(new CitiesModel())->where('st_id',22)->findAll(),
			"region"=>(new RegionModel())->where('reg_isDelete',0)->findAll(),	
			"sanstha"=>$sansthaD,	
			"page"=>$this->SansthaModel->where('cs_isDelete', 0)->orderBy('cs_createdOn','DESC')->paginate(),		
			"pager" => $this->SansthaModel->pager,
		];
		// print_r($data['sanstha']);die();
		//print_r($data);
		return view('sanstha/sanstha_details', $data);
	}
	
	function create_sanstha()
	{
		$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),			
			"state"=>(new statesModel())->where('country_id',101)->findAll(),
			"cities"=>(new CitiesModel())->where('st_id',22)->findAll(),
			"region"=>(new RegionModel())->where('reg_isDelete',0)->findAll(),
			"prefix"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>7))->findAll(),
			"op_area"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>6))->findAll(),
			"class_1"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>1))->findAll(),
			"class_2"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>2))->findAll(),
			"class_3"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>3))->findAll(),
			"class_4"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>4))->findAll(),
		];
		if($this->request->getMethod() == 'post'){
			$sanstha=[
				'cs_prefix'=>$this->request->getVar('cs_prefix'),
				'cs_name'=>$this->request->getVar('cs_name'),
				'cs_state'=>$this->request->getVar('cs_state'),
				'cs_district'=>$this->request->getVar('cs_district'),
				'cs_taluka'=>$this->request->getVar('cs_taluka'),
				'cs_zone'=>$this->request->getVar('cs_zone'),
				'cs_type'=>$this->request->getVar('cs_type'),
				'cs_head_off_addr'=>$this->request->getVar('cs_head_off_addr'),
				'cs_head_off_place'=>$this->request->getVar('cs_head_off_place'),
				'cs_head_off_pincode'=>$this->request->getVar('cs_head_off_pincode'),
				'cs_head_off_landline'=>$this->request->getVar('cs_head_off_landline'),
				'cs_head_off_mobile'=>$this->request->getVar('cs_head_off_mobile'),
				'cs_head_off_email'=>$this->request->getVar('cs_head_off_email'),
				'cs_status'=>$this->request->getVar('cs_status'),
				'cs_foundation_year'=>$this->request->getVar('cs_foundation_year'),
				'cs_years'=>$this->request->getVar('cs_years'),
				'cs_operation_area'=>$this->request->getVar('cs_operation_area 	'),
				'cs_classification1'=>$this->request->getVar('cs_classification1'),
				'cs_classification2'=>$this->request->getVar('cs_classification2'),
				'cs_classification3'=>$this->request->getVar('cs_classification3'),
				'cs_classification4'=>$this->request->getVar('cs_classification4'),
				'cs_membership_status'=>$this->request->getVar('cs_membership_status'),
				'cs_membership_start_date'=>$this->request->getVar('cs_membership_start_date'),
				'cs_membership_end_date'=>$this->request->getVar('cs_membership_end_date'),
				'cs_desc'=>$this->request->getVar('cs_desc'),
				'cs_createdBy'=>session()->get('id'),
				'cs_createdOn'=>date('Y-m-d H:i:s'),
			];
			(new SansthaModel())->insert($sanstha);
			$sanstha_id = (new SansthaModel)->insertID();
			//print_r($sanstha);die();
			$sanstha_details=[
				'csd_sanstha_id'=>$sanstha_id,
				'csd_branch_nos'=>$this->request->getVar('csd_branch_nos'),
				'csd_estension_counters'=>$this->request->getVar('csd_estension_counters'),
				'csd_members_count'=>$this->request->getVar('csd_members_count'),
				'csd_annual_turnover'=>$this->request->getVar('csd_annual_turnover'),
				'csd_chairman_name'=>$this->request->getVar('csd_chairman_name'),
				'csd_chairman_mobile'=>$this->request->getVar('csd_chairman_mobile'),
				'csd_md_name'=>$this->request->getVar('csd_md_name'),
				'csd_md_mobile'=>$this->request->getVar('csd_md_mobile'),
				'csd_createdOn'=>date('Y-m-d H:i:s'),
				'csd_createdBy'=>session()->get('id'),
			];
			(new SansthaDetailsModel())->insert($sanstha_details);

			session()->setFlashdata('success','Sanstha Registered Successfully  ..!!');
			return redirect()->route('sanstha/sanstha_details');
			
		}
		return view('sanstha/create_sanstha', $data);

	}
	function updateSanstha()
		{
		   	$sansthaData = [
		        'cs_id'  => (service('uri'))->getSegment(3)
			];
			// print_r($sansthaData); die();
			session()->set($sansthaData);			
			return redirect()->route('sanstha/sansthaUpdateRe');			
		}

		function update_sanstha_record()
		{	
			helper('form');
			$sanstha_data=session()->get($sansthaData);				
			$data = [
			"sanstha" => (new SansthaModel())->where('cs_id',$sanstha_data['cs_id'])->findAll(),
			"sanstha_details" => (new SansthaDetailsModel())->where('csd_sanstha_id',$sanstha_data['cs_id'])->findAll(),
			"state"=>(new statesModel())->where('country_id',101)->findAll(),
			"cities"=>(new CitiesModel())->where('st_id',22)->findAll(),
			"region"=>(new RegionModel())->where('reg_isDelete',0)->findAll(),
			"taluka" => array(),
			"s_type" => array(),
			"prefix"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>7))->findAll(),
			"op_area"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>6))->findAll(),
			"class_1"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>1))->findAll(),
			"class_2"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>2))->findAll(),
			"class_3"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>3))->findAll(),
			"class_4"=>(new PickupModel())->where(array('c_isDelete'=>0,'c_type'=>4))->findAll(),
			];


			return view('sanstha/sansthaDetailsUpdate', $data);
		}
		function update_sanstha_save_record(){
			$sanstha=[
				'cs_prefix'=>$this->request->getVar('cs_prefix'),
				'cs_name'=>$this->request->getVar('cs_name'),
				'cs_state'=>$this->request->getVar('cs_state'),
				'cs_district'=>$this->request->getVar('cs_district'),
				'cs_taluka'=>$this->request->getVar('cs_taluka'),
				'cs_zone'=>$this->request->getVar('cs_zone'),
				'cs_type'=>$this->request->getVar('cs_type'),
				'cs_head_off_addr'=>$this->request->getVar('cs_head_off_addr'),
				'cs_head_off_place'=>$this->request->getVar('cs_head_off_place'),
				'cs_head_off_pincode'=>$this->request->getVar('cs_head_off_pincode'),
				'cs_head_off_landline'=>$this->request->getVar('cs_head_off_landline'),
				'cs_head_off_mobile'=>$this->request->getVar('cs_head_off_mobile'),
				'cs_head_off_email'=>$this->request->getVar('cs_head_off_email'),
				'cs_status'=>$this->request->getVar('cs_status'),
				'cs_foundation_year'=>$this->request->getVar('cs_foundation_year'),
				'cs_years'=>$this->request->getVar('cs_years'),
				'cs_operation_area'=>$this->request->getVar('cs_operation_area 	'),
				'cs_classification1'=>$this->request->getVar('cs_classification1'),
				'cs_classification2'=>$this->request->getVar('cs_classification2'),
				'cs_classification3'=>$this->request->getVar('cs_classification3'),
				'cs_classification4'=>$this->request->getVar('cs_classification4'),
				'cs_membership_status'=>$this->request->getVar('cs_membership_status'),
				'cs_membership_start_date'=>$this->request->getVar('cs_membership_start_date'),
				'cs_membership_end_date'=>$this->request->getVar('cs_membership_end_date'),
				];
				(new SansthaModel())->update($this->request->getVar('cs_id'),$sanstha);
				
				//print_r($sanstha); die();
				$sanstha_details=[
				'csd_branch_nos'=>$this->request->getVar('csd_branch_nos'),
				'csd_estension_counters'=>$this->request->getVar('csd_estension_counters'),
				'csd_members_count'=>$this->request->getVar('csd_members_count'),
				'csd_annual_turnover'=>$this->request->getVar('csd_annual_turnover'),
				'csd_chairman_name'=>$this->request->getVar('csd_chairman_name'),
				'csd_chairman_mobile'=>$this->request->getVar('csd_chairman_mobile'),
				'csd_md_name'=>$this->request->getVar('csd_md_name'),
				'csd_md_mobile'=>$this->request->getVar('csd_md_mobile'),
				'csd_createdOn'=>date('Y-m-d H:i:s'),
				'csd_createdBy'=>session()->get('id'),
				];
				(new SansthaDetailsModel())->update($this->request->getVar('csd_id'),$sanstha_details);
				//print_r($sanstha_details); die();
				return redirect()->route('sanstha/sanstha_details');
		}

		public function sansthaDelete()
		{
			$cs_id = $_POST['cs_id'];
			$model= $this->SansthaModel->CO_SansthaD($cs_id.'','cos_sanstha',array('cs_isDelete'=>1));
			$data = [
			"success" => session()->getFlashdata('success'),
			"error" => session()->getFlashdata('error'),
			"info" => session()->getFlashdata('info'),
			"user" => (new HomeModel())->where(array('user_id'=>session()->get('id'),'user_isDelete'=> 0))->findAll(),			
			"state"=>(new statesModel())->where('country_id',101)->findAll(),
			"cities"=>(new CitiesModel())->where('st_id',22)->findAll(),
			"region"=>(new RegionModel())->where('reg_isDelete',0)->findAll(),
			"sanstha"=>$this->SansthaModel->where('cs_isDelete', 0)->orderBy('cs_createdOn','DESC')->paginate(),	
			"pager" => $this->SansthaModel->pager,
		];
		return view('sanstha/sanstha_details',$data);
		}
	
		function getCity()
		{
			$chkVal = $_POST['chkVal'];	
			$cityInfo = (new HomeModel())->getData(array('st_id'=>$chkVal),'cos_cities');
			echo json_encode($cityInfo);
		}

		function getRegion()
		{
			$chkVal = $_POST['chkVal'];	
			$regionInfo = db_connect()->query("SELECT * FROM cos_zone JOIN cos_state on  cos_zone.zone_id = cos_state.st_zone_id WHERE cos_state.st_id = ".$chkVal."")->getResultArray();
			echo json_encode($regionInfo);
		}	

		function getSubSector()
		{
			$sector = $_POST['sector'];	
			$regionInfo = (new HomeModel())->getData(array('ss_sector_id'=>$sector),'cos_subsector');
			echo json_encode($regionInfo);
		}	

		function stateWiseDisplay()
		{
			$states=$_POST['st_id'];
			$stateInfo = db_connect()->query("SELECT * FROM cos_sanstha JOIN cos_sanstha_details on cos_sanstha.cs_id = cos_sanstha_details.csd_sanstha_id WHERE cos_sanstha.cs_state = ".$states."")->getResultArray();
			echo json_encode($stateInfo);
		}
	
    }
?>