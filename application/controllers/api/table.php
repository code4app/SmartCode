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
    
    public function generate_get()
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
            $result[] = $row;
        }
        
        //$this->responseArray($result);
        
        $this->responseSuccess('hello\nasdf');
    }



}