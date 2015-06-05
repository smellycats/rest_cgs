<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mcgs extends CI_Model
{
	private $cgs_db;
    /**
     * Construct a mcgs instance
     *
     */
	public function __construct()
	{
		parent::__construct();
		
		$this->cgs_db = $this->load->database('cgs_db', TRUE);
	}
	
    /**
     * 根据条件查询车辆信息
     * 
     * @param array $data 查询数组
     * @return object
     */
	public function getVehicle($data)
	{	
		$this->cgs_db->select('*');
		$this->cgs_db->from('vehicle_gd');
		$this->cgs_db->where('hphm', $data['hphm']);
		return $this->cgs_db->get();
	}

}
?>

