<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author      studentdeng 
 * @link        <studentdeng.github.com> 
 * @datetime    Jul 31, 2013 
 */
require APPPATH . '/libraries/CUREST_Controller.php';

class Auto_code extends CUREST_Controller
{

    protected $html;
    protected $rewrite;
    protected $name;

    public function controller_get()
    {
        $inputParam = array('table');
        $paramValues = $this->gets($inputParam);
        $table = $paramValues['table'];
        $this->name = $table;

        $this->rewrite = $this->get('rewrite');

        $result = $this->getTableData($table);
        $this->generate_controller_php($result, $table);
    }
    
    public function model_get()
    {
        $inputParam = array('table');
        $paramValues = $this->gets($inputParam);
        $table = $paramValues['table'];
        $this->name = $table;

        $this->rewrite = $this->get('rewrite');

        $result = $this->getTableData($table);
        $this->generate_model_php($result, $table);
    }

    private function getTableData($table)
    {
        $db = $this->load->database('default', TRUE);
        $sql = "DESCRIBE $table";
        $query = $db->query($sql, array());
        $db->close();

        return $query->result_array();
    }

    private function generate_controller_php($result, $name)
    {
        $fileName = $name;
        $modelName = ucfirst($fileName);

        $path = 'application/controllers/api/' . $fileName . '.php';
        if (file_exists($path) && !$this->rewrite)
        {
            echo 'file exists' . "<br>" . $path;
            die();
        }

        $this->php_file_header();
        $this->html .= "require APPPATH . '/libraries/CUREST_Controller.php';\n";
        $this->html .= "class " . $modelName . " extends CUREST_Controller{\n";

        $this->class_construct($modelName . '_model');
        $this->add_method($result);
        $this->list_method($result);

        $this->end_php_file();

        $this->createPhp($path);
    }

    private function generate_model_php($result, $name)
    {
        $fileName = $name;
        $modelName = ucfirst($fileName);

        $path = 'application/models/' . $fileName . '_model.php';
        if (file_exists($path) && !$this->rewrite)
        {
            echo 'file exists' . "<br>" . $path;
            die();
        }
        
        $this->php_file_header();
        $this->html .= "require APPPATH . '/models/CUModel.php';\n";
        $this->html .= "class " . $modelName . "_model extends CUModel{\n";
        
        $this->writeLine('protected $table_name = '."'".$name."'".';');
        
        //create method
        $this->writeLine('public function createData($param = array()){');
        $this->writeLine('$defaultArray = array();');
        $this->writeLine('$data = array_merge($defaultArray, $param);');
        
        $this->writeLine('$db = $this->load->database("default", TRUE);');
        $this->writeLine('$result = $db->insert($this->table_name, $data);');
        $this->writeLine('$db->close();');
        $this->writeLine('return $result;');
        $this->writeLine('}');
        
        $this->end_php_file();
        
        $this->createPhp($path);
    }

    private function writeLine($line)
    {
        $this->html .= $line."\n";
    }


    private function php_file_header()
    {
        $this->html = "<?php\n";
        $this->html .= "defined('BASEPATH') OR exit('No direct script access allowed');\n";
    }

    private function var_field($result)
    {
        //print 
        foreach ($result as $item)
        {
            $value = 'null';
            $this->html .= "public $" . $item['Field'] . ' = ' . $value . ";\n";
        }
    }

    private function class_construct($modelName)
    {
        $this->html .= "public function __construct()\n{\nparent::__construct();";
        $this->html .= '$this->load->model' . "('" . $modelName . "');}\n";
    }

    private function add_method($result)
    {
        foreach ($result as $item)
        {
            $params[] = $item['Field'];
        }
        
        $this->comments($params);

        $arrayContent = null;
        foreach ($result as $item)
        {
            $arrayContent .= "'" . $item['Field'] . "',\n";
        }

        $functionBody = null;
        $functionBody .= '$param = array(' . $arrayContent . ");\n";
        $functionBody .= '$paramValues = $this->posts($param);' . "\n";

        $functionBody .= '$result = $this->' . ucfirst($this->name) . '_model' . '->createData($paramValues);' . "\n";
        $functionBody .= '$this->responseBool($result);' . "\n";

        $this->html .= "public function add_post()" . '{' . $functionBody . "}\n";
    }

    private function list_method($result)
    {
        $this->comments(array('max_id', 'since_id', 'count'));

        $arrayContent = null;
        foreach (array('max_id', 'since_id', 'count') as $item)
        {
            $arrayContent .= "'" . $item . "' => 0,\n";
        }

        $functionBody = null;
        $functionBody .= '$defaultParams = array(' . $arrayContent . ");\n";

        $functionBody .= '$param = $this->gets_defaults($defaultParams);' . "\n";
        $functionBody .= '$since_id = $param[' . "'since_id'" . '];' . "\n";
        $functionBody .= '$max_id = $param[' . "'max_id'" . '];' . "\n";
        $functionBody .= '$count = $param[' . "'count'" . '];' . "\n";

        $functionBody .= '$result = $this->' . ucfirst($this->name) . '_model' . '->filter($since_id, $max_id, $count);' . "\n";
        $functionBody .= '$this->responseDecorateArray($result);' . "\n";

        $this->html .= "public function list_get()" . '{' . $functionBody . "}\n";
    }

    private function comments($array)
    {
        $this->html .= "/**\n";
        $this->html .= "*\n";

        //generate commends
        foreach ($array as $item)
        {
            $this->html .= "*@param type " . $item . "\n";
        }
        $this->html .="*/\n";
    }

    private function end_php_file()
    {
        $this->html .= "}";
    }
    
    private function createPhp($path)
    {
        $b = file_put_contents($path, $this->html);
        chmod($path, 0777);

        if ($b)
        {
            echo 'created at ' . $path;
        }
        else
            echo 'failed';
    }

}