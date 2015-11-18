<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is a REST style cgs controller
 *
 * @package		CodeIgniter
 * @subpackage	Cgs Rest Server
 * @category	Controller
 * @author		Fire
*/

class Hbc extends Parsing_Controller
{
	public function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
        $this->load->model('Mhbc');

        $this->load->helper('url');

        header('Cache-Control:public, max-age=60, s-maxage=60');
        header('Content-Type: application/json; charset=utf-8');
        header("HTTP/1.1 200 OK");
    }

    /**
     * vehicle get method
     * 
     * @return json
     */
    public function hbc_get()
    {
        if (empty(@$this->gets['q'])) {
            $e = [array('resource'=>'Search', 'field'=>'q', 'code'=>'missing')];
            $this->response(array('message' => 'Validation Failed', 'errors' => $e), 422);
        }
        // 解析q参数
        $q_arr = h_convert_param($this->gets['q']);
        $q_arr['hphm'] = @$q_arr['q'];

        $query = $this->Mhbc->getHbc($q_arr);
        $result['items'] = $query->result_array();
        $result['total_count'] = $query->num_rows();

        echo json_encode($result);
    }

    /**
     * vehicle get method
     * 
     * @return json
     */
    public function hbcall_get()
    {
        $query = $this->Mhbc->getHbcAll();
        foreach ($query->result_array() as $id=>$row) {
            $result['items'][$id]['nxh'] = $row['NXH'];
            $result['items'][$id]['hphm'] = $row['HPHM'];
            $result['items'][$id]['hpzl'] = $row['HPZL'];
        }
        $result['total_count'] = $query->num_rows();

        echo json_encode($result);
    }

}