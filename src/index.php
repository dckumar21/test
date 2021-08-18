<?php 

namespace dctest\HelloWorld;

class Index
{
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
            $contents = 'This is a test!';           // Some simple example content.
            file_put_contents($moduleControllerPath.'/'.$controllerName, $contents);     // Save our content to the file.
        } 
    }
    function controllerData(){
        $content = "<?php \n ";
        $content = "defined('BASEPATH') or exit('No direct script access allowed');";
        $content = "class Admin extends CT_Controller";
        $content = "{";
        $content = "function __construct()";
        $content = " {";
        $content = "parent::__construct(); ";
        $content = "$this->load->model('Admin_model'); ";
        $content = "}";
        
    }


}

