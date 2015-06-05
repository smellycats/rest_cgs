<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is vehicle info rest
 *
 * @package		CodeIgniter
 * @subpackage	Cgs Rest Server
 * @category	Controller
 * @author		Fire
*/

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Cgs extends REST_Controller
{
	function __construct()
    {
        // Construct our parent class
        parent::__construct();
        
        $this->load->model('Mcgs');
    }
    
    /**
     * vehicle get method
     * 
     * @return json
     */
    function vehicles_get()
    {
        $p = $this->input->get('p');
        if (!$p) {
            $e = [array('resource'=>'Search', 'field'=>'q', 'code'=>'missing')];
            $this->response(array('message' => 'Validation Failed', 'errors' => $e), 422);
        }

        foreach (explode(' ', $p) as $id => $r) {
            if ($id == 0) {
                $data['hphm'] = $r;
            } else {
                $p_arr = explode(':', $r);
                $data[$p_arr[0]] = $p_arr[1];
            }
        }
        $result = $this->Mcgs->getVehicle($data);

        if ($result) {
            $this->response(array('total_count'=> $result->num_rows(),
                                  'items'=> $result->result_array()), 200); // 200 being the HTTP response code
        } else {
            $this->response(array('message' => 'Database error'), 500);
        }
    }

}