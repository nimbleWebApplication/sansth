<?php namespace App\Models;

use CodeIgniter\Model;

class statesModel extends Model 
{
    protected $table = 'cos_state';
    protected $primaryKey = 'st_id';
    protected $allowedFields =['st_name','country_id'];
}
