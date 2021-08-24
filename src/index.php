<?php 

namespace dctest\HelloWorld;

class Index
{
    private $cmd; 
    private $cmdFunction; 
    private $moduleName; 
    function __construct($argv)
    {
        $this->cmd = @$argv[1]; //module/install/ etc
        $this->name = @$argv[2];
        $this->moduleName = @$argv[3];
        
        $this->{$this->cmd}();
    }

    public function install(){ 
        $this->{$this->name}; //HMVC/ PROJECT ETC
    }

    public function hmvc(){
        $src = '/public'; // or relative path if so desired 
        $dst = '/full/path/to/dst'; // or relative path if so desired
        $command = 'cp -a ' . $src . ' ' .$dst;
        $shell_result_output = shell_exec(escapeshellcmd($command));
    }
    
    public function module($moduleName = "")
    {
        $moduleName = $this->name;
        if($moduleName == ""){
            throw("Invalid module name: Use command php craft make module Module_name ");
        }
        if (!file_exists('application/modules')) {
            mkdir('application/modules', 0777, true);
        }
        if (!file_exists('application/core')) {
            mkdir('application/core', 0777, true);
        }

        $moduleName = ucfirst(strtolower($moduleName));
        $moduleFolderPath = 'application/modules/'.$moduleName;
        $moduleControllerPath = 'application/modules/'.$moduleName."/controllers";
        $moduleModelsPath = 'application/modules/'.$moduleName."/models";
        $moduleViewPath = 'application/modules/'.$moduleName."/views";
        $CTPath = 'application/core';
        $CTController = "CT_Controller.php";
        $CTModel = "CT_model.php";

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
            $contents = $this->controllerData($moduleName);           // Some simple example content.
            file_put_contents($moduleControllerPath.'/'.$controllerName, $contents);     // Save our content to the file.
        } 
        if(!is_file($moduleModelsPath.'/'.$modelName)){
            $contents = $this->modelData($moduleName);           // Some simple example content.
            file_put_contents($moduleModelsPath.'/'.$modelName, $contents);     // Save our content to the file.
        } 
        if(!is_file($moduleViewPath.'/'.$viewName)){
            $contents = $this->viewData("index");           // Some simple example content.
            file_put_contents($moduleViewPath.'/'.$viewName, $contents);     // Save our content to the file.
        } 
        if(!is_file($CTPath.'/'.$CTController)){
            $contents = $this->CTControllerData($CTController);           // Some simple example content.
            file_put_contents($CTPath.'/'.$CTController, $contents);     // Save our content to the file.
        } 
        if(!is_file($CTPath.'/'.$CTModel)){
            $contents = $this->CTModelData($CTModel);           // Some simple example content.
            file_put_contents($CTPath.'/'.$CTModel, $contents);     // Save our content to the file.
        } 
    }
    function controllerData($name = ""){
        $content = "<?php \n ";
        $content .= "defined('BASEPATH') or exit('No direct script access allowed');  \n ";
        $content .= "class ".$name." extends CT_Controller  \n ";
        $content .= "{  \n ";
            $content .= "function __construct()  \n ";
            $content .= " {  \n ";
                $content .= "parent::__construct();  \n ";
                $content .= "\$this->load->model('".$name."_model');  \n ";
            $content .= "}   \n ";
            $content .= "function index()  \n ";
            $content .= " {  \n ";
            $content .= "}  \n ";
        $content .= "}  \n ";
        return $content;
    }
    function modelData($name = ""){
        $content = "<?php \n ";
        $content .= "defined('BASEPATH') or exit('No direct script access allowed');";
        $content .= "class ".$name."_mode extends CT_Model";
        $content .= "{";
            $content .= "\tfunction __construct()";
            $content .= "\t{";
                $content .= "\t\tparent::__construct(); "; 
            $content .= "\t}"; 
        $content .= "}"; 
        return $content;
    }
    function viewData($name = ""){
        $content = '<!DOCTYPE html> \n ';
        $content = '<html lang="en"> \n '; 
            $content .= '\t<head>';  
                $content .= '\t\t <meta charset="utf-8">';  
                $content .= '\t\t <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">';  
            $content .= '\t</head>'; 
            $content .= '\t<body>';  
            $content .= '\t</body>'; 
        $content .= '</html>'; 
        return $content;
    }
    function CTControllerData($name = ""){
        $content = "<?php \n ";
        $content .= "defined('BASEPATH') or exit('No direct script access allowed');";
        $content .= "class ".$name." extends CI_Controller";
        $content .= "{";
            $content .= "\tfunction __construct()";
            $content .= "\t{";
                $content .= "\t\tparent::__construct(); "; 
            $content .= "\t}"; 
        $content .= "}"; 
        return $content;
    }
    function CTModelData($name = ""){
        $content = "<?php \n ";
        $content .= "defined('BASEPATH') or exit('No direct script access allowed');";
        $content .= "class ".$name." extends CI_Model";
        $content .= "{";
            $content .= "\tfunction __construct()";
            $content .= "\t{";
                $content .= "\t\tparent::__construct(); "; 
            $content .= "\t}"; 
        $content .= "}"; 
        return $content;
    }

}

