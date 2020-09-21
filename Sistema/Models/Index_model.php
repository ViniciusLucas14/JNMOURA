<?php
 class Index_model extends Conexao  //mesmo nome do arquivo
 {
 
    function __construct(){
           parent::__construct();
    }
    function loginUser($email, $password){
            $where = " WHERE Email = :Email"; //: = PARAMETRO
            $param = array('Email' => $email);
            $response = $this->db->select1("*", 'usuarios', $where, $param);

            if (is_array($response)) {
                   $response = $response['results'];
                   if (password_verify($password, $response["Senha"])) //primeiro valor digitado pelo usuario e o segundo valor é oq está na coluna
                   {
                           $data = array(
                                   "idUsuario" => $response["idUsuario"],
                                   "Nome" => $response["Nome"],
                                   "Email" => $response["Email"],
                                   "Senha" => $response["Senha"],
                           );
                           Sessao::setSession("User",$data);
                           return $data;
                   } else {
                          $data = array(
                                  "idUsuario" => 0,
                          );
                          return $data;
                   }
                   
            } else {
                return $response;
            }
    }


}
?>