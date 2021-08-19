<?php 

namespace dctest\HelloWorld;

class Index
{
    public function Index(){
        $cmd = @$argv[1];  
        if($cmd == "make"){
            $cmdFunction = @$argv[2]; 
            if($cmdFunction == "module"){
                $moduleName = @$argv[3]; 
                $this->module($moduleName);
            }
        }
    }
    public function module($moduleName = "")
    {
        if($moduleName == ""){
            throw("Invalid module name: Use command php craft make module Module_name ");
        }
        if (!file_exists('application/modules')) {
            mkdir('application/modules', 0777, true);
        }

        $moduleName = ucfirst(strtolower($moduleName));
        $moduleFolderPath = 'application/modules/'.$moduleName;
        $moduleControllerPath = 'application/modules/'.$moduleName."/controllers";
        $moduleModelsPath = 'application/modules/'.$moduleName."/models";
        $moduleViewPath = 'application/modules/'.$moduleName."/views";

        //CREATE MODULES IF NOT EXIST
        if (!file_exists($moduleFolderPath)) {
            mkdir($moduleFolderPath, 0777, true);
        }

        //CREATE MODULE'S CONTROLLER IF NOT EXIST
        if (!file_exists($moduleControllerPath)) {
            mkdir($moduleControllerPath, 0777, true);
        }

        //CREATE MODULE'S MODEL OF NOT EXIST
        if (!file_exists($moduleModelsPath)) {
            mkdir($moduleModelsPath, 0777, true);
        }

        //CREATE MODULE'S VIEW IF NOT EXIST
        if (!file_exists($moduleViewPath)) {
            mkdir($moduleViewPath, 0777, true);
        }
        
        $controllerName = $moduleName.'.php';
        $modelName = $moduleName.'_model.php';
        $viewName = 'index.php';

        if(!is_file($moduleControllerPath.'/'.$controllerName)){
            $contents = $this->controllerData();           // Some simple example content.
            file_put_contents($moduleControllerPath.'/'.$controllerName, $contents);     // Save our content to the file.
        } 
    }
    function controllerData($name = ""){
        $content = "<?php \n ";
        $content .= "defined('BASEPATH') or exit('No direct script access allowed');";
        $content .= "class ".$name." extends CT_Controller";
        $content .= "{";
            $content .= "function __construct()";
            $content .= " {";
                $content .= "parent::__construct(); ";
                $content .= "$this->load->model('".$name."_model'); ";
            $content .= "}";
            $content .= "function index()";
            $content .= " {";
            $content .= "}";
        $content .= "}";
        
    }


}

