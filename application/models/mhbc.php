<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mhbc extends CI_Model
{
	private $hbc_db;
    /**
     * Construct a mcgs instance
     *
     */
	public function __construct()
	{
		parent::__construct();
		
		$this->hbc_db = $this->load->database('hbc_db', TRUE);
	}
	
    /**
     * 根据条件查询黄标车辆信息
     * 
     * @param array $q 查询数组
     * @return object
     */
	public function getHbc($q)
	{	
		$sqlstr = '';
		if (isset($q['hpzl'])) {
			$sqlstr .= " AND a.hpzl='$q[hpzl]'";
		}
		return $this->hbc_db->query("SELECT a.nxh, a.hphm, a.hpzl FROM hz_vehicle v INNER JOIN hbc_all a ON v.xh = a.nxh WHERE a.hphm = v.hphm AND a.hphm='$q[hphm]'" . $sqlstr);
	}

    /**
     * 根据条件查询所有黄标车辆信息
     * 
     * @param array $q 查询数组
     * @return object
     */
	public function getHbcAll()
	{	
		return $this->hbc_db->query("SELECT a.nxh, a.hphm, a.hpzl FROM hz_vehicle v INNER JOIN hbc_all a ON v.xh = a.nxh WHERE a.hphm = v.hphm AND a.hpzl = v.hpzl");
	}
}
?>

