<?php 
	namespace App\Models;
	use CodeIgniter\Model;

	class LeadModel extends Model
	{		
		protected $table = "sales_lead";
		protected $primaryKey = 'lead_id';

    	protected $returnType     = 'array';
		// protected $allowedFields = ['user_firstName','user_lastName','user_name','user_mobile','user_email','user_adhar_card','	user_pan_card','user_passport','user_password','user_role_id','user_vendor_id','user_createdOn','user_createdBy'];
		function insert($value='')
		{
			# code...
		}
	}
?>