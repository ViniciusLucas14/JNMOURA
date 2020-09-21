<?php
class Usuarios_model extends Conexao
{
    function __construct(){
        parent::__construct();
    }
    public function registerUser1($user){
            $where = " WHERE Telefone = :Telefone";
            $response = $this->db->select2("*",'agendas',$where,array('Telefone' => $user ->Telefone));
            if (is_array($response)) {
                $response = $response['results'];
                if (0 == count($response)) {
                        $value = " (Nome, Telefone, Endereco)VALUES
                                   (:Nome, :Telefone, :Endereco)";
                        $data = $this->db->insert("agendas",$user,$value);
                        if(is_bool($data)){
                            return 0;
                         }else{
                             return $data;
                         }
                            
                    } else {
                        return 1;
                    }
                    
                    } else {
                        return $response;
                    }
            
        }
        function getUsers($filter){
            $where = " WHERE Nome LIKE :Nome OR Telefone LIKE :Telefone OR Endereco LIKE :Endereco";
            $array = array (
                'Nome' =>  '%'.$filter.'%',
                'Telefone' =>  '%'.$filter.'%',
                'Endereco' =>  '%'.$filter.'%'
            );
            $columns = "idAgenda, Nome, Telefone, Endereco";
            return $this->db->select2($columns,"agendas",$where, $array);
            
        }
        function editUser($user, $idAgenda){
            $where = " WHERE Telefone = :Telefone";
            $response = $this->db->select2("*",'agendas',$where,array('Telefone' => $user->Telefone));
            if(is_array($response)){
                $response = $response['results'];
                $value = "Nome = :Nome, Telefone= :Telefone, Endereco = :Endereco";
                $where = " Where idAgenda = ".$idAgenda;
                if(0 == count($response)){
                  $data = $this->db->update("agendas",$user,$value,$where);
                    if(is_bool($data)){
                        return 0;
                    }else{
                        return $data;
                    }
                }else{
                    if($response[0]['idAgenda']==$idAgenda){
                        $data = $this->db->update("agendas",$user,$value,$where);
                    if(is_bool($data)){
                        return 0;
                    }else{
                        return $data;
                    }
                }
            }
            }
        }
        function getUser($idAgenda){
            $where = " WHERE idAgenda = :idAgenda";
            $response = $this->db->select2("*",'agendas',$where,array('idAgenda' => $idAgenda));
            if (is_array($response)) {
                return $response = $response['results'];
            }else{
                return $response;
            }
        }
        function deleteUser($idUsuario){
            $where = " WHERE idAgenda = :idAgenda";
            $data = $this->db->delete('agendas',$where,array('idAgenda' => $idAgenda));
            if (is_bool($data)) {
                return 0;
            } else {
                return $data;
            }
            
        }
    }

?>