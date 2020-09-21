<?php
Class Anonymous
{
    public function userClass($array){
        return new class($array)
        {
            public $Nome;
            public $Telefone;
            public $Endereco;
            function __construct($array){
                $this->Nome = $array[0];
                $this->Telefone = $array[1];
                $this->Endereco = $array[2];
            }

        };
    }
}


?>