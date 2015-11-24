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
     * @param array $q 查询数组
     * @return object
     */
	public function getVehicle($q)
	{	
		$this->cgs_db->select('id');
		$this->cgs_db->select('hpzl');
		$this->cgs_db->select('hphm');
		$this->cgs_db->select('clpp1');
		$this->cgs_db->select('clpp2');
		$this->cgs_db->select('clxh');
		$this->cgs_db->select('zzcmc');
		$this->cgs_db->select('clsbdh');
		$this->cgs_db->select('fdjh');
		$this->cgs_db->select('cllx');
		$this->cgs_db->select('csys');
		$this->cgs_db->select('syr');
		$this->cgs_db->select('fzrq');
		$this->cgs_db->from('vehicle_gd');
		$this->cgs_db->where('hphm', $q['hphm']);
		// 号牌种类查询
		if (isset($q['hpzl'])) {
			$this->cgs_db->where('hpzl', $q['hpzl']);
		}
		// 号牌颜色查询
		if (isset($q['hpys'])) {
			switch ($q['hpys']) {
				case 'blue':
				case '蓝':
				case 'BU':
				case '2':
					$this->cgs_db->where_in('hpzl', ['02', '08']);
					break;
				case 'yellow':
				case '黄':
				case 'YL':
				case '3':
					$this->cgs_db->where_in('hpzl', ['01', '07', '13', '14', '15', '16', '17']);
					break;
				case 'white':
				case '白':
				case 'WT':
				case '4':
					$this->cgs_db->where_in('hpzl', ['20', '21', '22', '24', '32']);
					break;
				case 'black':
				case '黑':
				case 'BK':
				case '5':
					$this->cgs_db->where_in('hpzl', ['03', '04', '05', '06', '09', '10', '11', '12']);
					break;
				default:
					break;
			}
		}
		return $this->cgs_db->get();
	}

    /**
     * 获取号牌种类
     * 
     * @return object
     */
	public function getHpzl()
	{	
		$this->cgs_db->select('hpzl.*');
		$this->cgs_db->select('hpys.name as hpys');
		$this->cgs_db->select('hpys.code as hpys_code');
		$this->cgs_db->join('hpys', 'hpys.code = hpzl.hpys_code');
		return $this->cgs_db->get('hpzl');
	}

    /**
     * 获取车身颜色
     * 
     * @return object
     */
	public function getCsys()
	{	
		$this->cgs_db->select('*');
		return $this->cgs_db->get('csys');
	}

    /**
     * 获取车辆类型
     * 
     * @return object
     */
	public function getCllx()
	{	
		$this->cgs_db->select('*');
		return $this->cgs_db->get('d_cllx');
	}
}
?>

