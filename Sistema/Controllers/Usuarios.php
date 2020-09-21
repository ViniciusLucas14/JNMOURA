<?php
class Usuarios extends Controllers
{
    function __construct()
    {
        parent::__construct();
    }   

    public function usuarios(){
        if (null != Sessao::getSession("User")) {
            $this->view->render($this, "usuarios");
        } else {
            header("Location:".URL);
        }
    }
    public function registerUser1(){
        $array = array(
            $_POST["nome"],
            $_POST["telefone"],
            $_POST["endereco"],
        );

        $data =  $this->model->registerUser1($this->userClass($array));
         if($data == 1){
             echo "Telefone já cadastrado";
         }else{
             echo $data;
         }
    }
    public function getUsers(){
        $count = 0;
        $dataFilter = null;
        $data = $this->model->getUsers($_POST["filter"]);
        if (is_array($data)) {
            $array = $data["results"];
            foreach ($array as $key =>$value){
                $dataUser = json_encode($array[$count]);
                $dataFilter .= "<tr>" .
                "<td>".$value["Nome"]."</td>".
                "<td>".$value["Telefone"]."</td>".
                "<td>".$value["Endereco"]."</td>".
                "<td>".
                "<a href='#modal1' onclick='dataUser(".$dataUser . ")' class='btn modal-trigger'>Edit</a> ".
                "<a href='#modal2' onclick='deleteUser(".$dataUser.")' class='btn red lighten-1 modal-trigger'>Delete</a>".
                "</td>".
            "</tr>";
            $count++;
            }
            echo $dataFilter;
        } else {
            echo $data;
        }
        
    }
    public function editUser(){
        $response = $this->model->getUser($_POST["idAgenda"]);
        if (is_array($response)){
            $array = array(
                $_POST["nome"], $_POST["telefone"],$_POST["endereco"]
            );
            echo $this->model->editUser($this->userClass($array),$_POST["idAgenda"]);
        }else{
            echo $response;
        }
       
    }
    public function deleteUser(){
        echo $this->model->deleteUser($_POST["idAgenda"]);
    }
    public function destroySession(){
        Sessao::destroy();
        header("Location:".URL);
    }
}

?>