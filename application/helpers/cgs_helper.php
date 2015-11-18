<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * cgs publishing system
 *
 * @package		helpers
 * @subpackage	Helpers
 * @category	Helpers
 * @author      Fire
 * @link
 */


// ------------------------------------------------------------------------


/**
 * h_convertUrlQuery
 *
 * url 参数转换成数组
 *
 * @access	public
 * @param	string
 * @return	array
 */

if ( ! function_exists('h_convertUrlQuery'))
{
    function h_convertUrlQuery($query)
    {
        $queryParts = explode('&', $query);

        $params = array();

        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = @$item[1];
        }
        
        return $params;
    }
}

/**
 * h_convertParam
 *
 * q 参数转换成数组
 *
 * @access  public
 * @param   string
 * @return  array
 */

if ( ! function_exists('h_convertParam'))
{
    function h_convertParam($q)
    {
        $queryParts = explode('+', $q);

        $params = array();
        foreach ($queryParts as $id=>$param) {
            if ($id == 0) {
                $params['q'] = $param;
            } else {
                $item = explode(':', $param);
                $params[$item[0]] = @$item[1];
            }
        }
        
        return $params;
    }
}

/**
 * h_convert_param
 *
 * q 参数转换成数组
 *
 * @access  public
 * @param   string
 * @return  array
 */

if ( ! function_exists('h_convert_param'))
{
    function h_convert_param($q)
    {
        $queryParts = explode('+', $q);

        $params = array();
        foreach ($queryParts as $id=>$param) {
            if ($id == 0) {
                $params['q'] = $param;
            } else {
                $key = strstr($param, ':', true);
                if ($key) {
                    $val = substr(strstr($param, ':'), 1);
                    $params[$key] = $val;
                }
            }
        }
        return $params;
    }
}

/**
 * h_convert_url_query
 *
 * url 参数转换成数组
 *
 * @access  public
 * @param   string
 * @return  array
 */

if ( ! function_exists('h_convert_url_query'))
{
    function h_convert_url_query($query)
    {
        $queryParts = explode('&', $query);

        $params = array();

        foreach ($queryParts as $param) {
            $item = explode('=', $param);
            $params[$item[0]] = @$item[1];
        }
        return $params;
    }
}