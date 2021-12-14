<?php namespace App\Models;

use CodeIgniter\Model;

class PickupModel extends Model 
{
    protected $table = 'cos_pickup';
    protected $primaryKey = 'c_id';
    protected $allowedFields =['c_type','c_name','c_isDelete'];


    public function productD($id)
	{
		return $this->db->table('cos_pickup')->delete(['c_id' => $id]);
	}
}
