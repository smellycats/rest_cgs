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
		switch (@$data['hpys']) {
			case 'blue':
			case '蓝':
			case '2':
				$this->cgs_db->where_in('hpzl', ['02', '08']);
				break;
			case 'yellow':
			case '黄':
			case '3':
				$this->cgs_db->where_in('hpzl', ['01', '07', '13', '14', '15', '16', '17']);
				break;
			case 'white':
			case '白':
			case '4':
				$this->cgs_db->where_in('hpzl', ['20', '21', '22', '24', '32']);
				break;
			case 'black':
			case '黑':
			case '5':
				$this->cgs_db->where_in('hpzl', ['03', '04', '05', '06', '09', '10', '11', '12']);
				break;
			default:
				break;
		}
		return $this->cgs_db->get();
	}

}
?>

