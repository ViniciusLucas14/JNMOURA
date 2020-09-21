<?php
class Conexao{
    function __construct(){
        $this->db = new QueryManager("root","","sistema_agendas");
    }
}

?>