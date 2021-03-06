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

        $query = $this->Mcgs->getVehicle($q_arr);
        
        if ($query) {
            header("HTTP/1.1 200 OK");
            header('Content-Type: application/json');
            echo json_encode(array('total_count'=> $query->num_rows(), 'items'=> $query->result_array()));
        } else {
            $this->response(array('message' => 'Database error'), 500);
        }
    }

    /**
     * hpzl dictionary
     * 号牌种类字典
     *
     * @return json
     */
    public function hpzldict_get()
    {
        $query = $this->Mcgs->getHpzl();
        $result = array();
        foreach($query->result() as $row) {
            $result[$row->code] = array('name'=>$row->name, 'ps'=>$row->remark, 'hpys'=>$row->color);
        }

        $this->response($result, 200);
    }

    /**
     * hpzl list
     * 号牌种类列表
     * 
     * @return json
     */
    public function hpzl_get()
    {
        $query = $this->Mcgs->getHpzl();
        $result = array();
        foreach($query->result() as $id=>$row) {
            $result[$id] = array('id'=>(int)$row->id, 'code' => $row->code, 'name' => $row->name, 'ps' => $row->remark, 'hpys'=>$row->color);
        }
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        echo json_encode(array('total_count' => $query->num_rows(), 'items' => $result));
    }

    /**
     * csys list
     * 获取车身颜色列表
     * 
     * @return json
     */
    public function csys_get()
    {
        $query = $this->Mcgs->getCsys();
        $result = array();
        foreach($query->result() as $id=>$row) {
            $result[$id] = array('id'=>(int)$row->id, 'code'=>$row->code, 'name'=>$row->name);
        }
        header("HTTP/1.1 200 OK");
        header('Content-Type: application/json');
        echo json_encode(array('total_count' => $query->num_rows(), 'items' => $result));
    }

    /**
     * csys dictionary
     * 获取车身颜色字典
     * 
     * @return json
     */
    public function csysdict_get()
    {
        $query = $this->Mcgs->getCsys();
        $result = array();
        foreach($query->result() as $id=>$row) {
            $result[$row->code] = $row->name;
        }
        
        $this->response($result, 200);
    }

    /**
     * cllx list
     * 获取车身颜色列表
     * 
     * @return json
     */
    public function cllx_get()
    {
        $query = $this->Mcgs->getCllx();
        $result = array();
        foreach($query->result() as $id=>$row) {
            $result[$id] = array('id'=>$id+1, 'code'=>$row->code, 'name'=>$row->name);
        }
      
        $this->response(array('total_count'=>$query->num_rows(), 'items'=>$result), 200);
    }

    /**
     * cllx dictionary
     * 获取车身颜色字典
     * 
     * @return json
     */
    public function cllxdict_get()
    {
        $query = $this->Mcgs->getCllx();
        $result = array();
        foreach($query->result() as $id=>$row) {
            $result[$row->code] = $row->name;
        }
        
        $this->response($result, 200);
    }

}