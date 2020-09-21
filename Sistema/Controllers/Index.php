<?php
class Index extends Controllers //extends = classe filho do Controllers.php
{
    public function __construct() {
       parent::__construct();
    }
    public function index(){
        $user = isset($_SESSION["User"]) ?? null;
        if (null != $user) {
            header("Location:".URL."Principal/principal");
        } else {
            $this->view->render($this,"index");
        }
    
    }
    public function loginUser(){
        if(isset($_POST["email"]) && isset($_POST["password"])){
            $data =  $this->model->loginUser($_POST["email"], $_POST["password"] );

            if (is_array($data)) {
                echo json_encode($data);
            } else {
                echo $data;
            }
            
        }
    }
}

?>