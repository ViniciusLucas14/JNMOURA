<?php
class Controllers extends Anonymous
{
    public function __construct() {
        Sessao::star();
        $this->view = new Views();
        $this->loadClassmodels();
    }
    function loadClassmodels(){
        $model = get_class($this).'_model'; //para se obter o nome de uma classe de um controlador
        $path = 'Models/'.$model.'.php';
        if(file_exists($path)){
            require $path;
            $this->model = new $model();
        }
    }
}

?>