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

class Cgs extends Parsing_Controller
{
	public function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
        $this->load->model('Mcgs');

        $this->load->helper('url');
        $this->load->helper('cgs');

        header('Cache-Control:public, max-age=60, s-maxage=60');
    }

    /**
     * vehicle get method
     * 
     * @return json
     */
    public function vehicles_get()
    {
        if (empty(@$this->gets['q'])) {
            $e = [array('resource'=>'Search', 'field'=>'q', 'code'=>'missing')];
            $this->response(array('message' => 'Validation Failed', 'errors' => $e), 422);
        }
        // 解析q参数
        $q_arr = h_convertParam($this->gets['q']);
        $q_arr['hphm'] = @$q_arr['q'];

        $result = $this->Mcgs->getVehicle($q_arr);
        if ($result) {
            $this->response(array('total_count'=> $result->num_rows(),
                                  'items'=> $result->result_array()), 200); // 200 being the HTTP response code
        } else {
            $this->response(array('message' => 'Database error'), 500);
        }
    }

}