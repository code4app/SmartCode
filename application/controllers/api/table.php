<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author      studentdeng 
 * @link        <studentdeng.github.com> 
 * @datetime    Aug 7, 2013 
 */
require APPPATH . '/libraries/CUREST_Controller.php';

class Table extends CUREST_Controller
{
    /**
     * 处理php数据库自动生成参数
     */
    public function index_get()
    {
        $inputParam = array('database_name', 'database_table');
        $paramValues = $this->gets($inputParam);
        $database_name = $paramValues['database_name'];
        $database_table = $paramValues['database_table'];
        
        $conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

        $sql = "DESCRIBE $database_table";
        mysql_select_db($database_name, $conn);
        $res = mysql_query($sql);

        $result = array();
        while ($row = mysql_fetch_array($res))
        {
            $item = $row;
            $result[] = $item;
        }
        
        $this->load->helper('url');
		$this->load->view('table_view', array('data' => $result));
    }
    
    /**
     * php函数参数
     */
    public function param_post()
    {
        $inputParam = array('params', 'php_param_method');
        $paramValues = $this->posts($inputParam);
        
        $paramsString = $paramValues['params'];
        
        $params = explode(';', $paramsString);
        $httpMethod = $paramValues['php_param_method'];
        
        $paramsData = array();
        foreach ($params as $item)
        {
            $object = array();
            $object['Field'] = $item;
            
            $paramsData[$item] = $object;
        }
        
        $this->load->helper('url');
		$this->load->view('php_params_view', 
                array('params'=>$paramsData, 'medhod'=>$httpMethod)
        );
    }

    /**
     * 根据数据库实例名字查找所有的数据库表名称
     * 
     * @param string $database_name 数据库实例名
     * 
     * 
     * @param string $database_name2 dumy
     * 
     * 
     * @link http://www.baidu.com
     */
    public function list_get()
    {
        $inputParam = array('database_name');
        $paramValues = $this->gets($inputParam);
        $database_name = $paramValues['database_name'];

        $conn = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

        $sql = "show tables";
        mysql_select_db($database_name, $conn);
        $res = mysql_query($sql);

        $result = array();
        while ($row = mysql_fetch_array($res))
        {
            $result[] = $row[0];
        }
        
        $this->responseArray($result);
    }
}