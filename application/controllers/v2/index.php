<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is a version2 guide controller
 *
 * @package		CodeIgniter
 * @subpackage	Cgs Rest Server
 * @category	Controller
 * @author		Fire
*/

class Index extends CI_Controller
{
	public function __construct()
    {
        // Construct our parent class
        parent::__construct();

        $this->load->helper('url');

        header('Content-type:application/json');
        header('Cache-Control:public, max-age=60, s-maxage=60');
    }

    /**
     * vehicle get method
     * 
     * @return json
     */
    public function index()
    {
        $urls = ['vehiles_url' => site_url('v2/cgs/vehiles?q={query}')];
        
        echo str_replace("\\/", "/",  json_encode($urls));
    }

}