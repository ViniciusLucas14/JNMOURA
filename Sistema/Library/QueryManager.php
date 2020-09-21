<?php
class QueryManager{ 
    private $pdo;
    function __construct($USER, $PASS, $DB){
        try{
            $this->pdo = new PDO('mysql:host=localhost;dbname=' .$DB.';SET CHARACTER SET utf8', $USER, $PASS, 
            [
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION
            ]
            );
        }catch (PDOException $e){
            print "ERRO: " . $e->getMessage();
            die();
        }
        
    }
    function select2($attr,$table,$where,$param){
        try{
            $where = $where ?? "";
    
            $query = "SELECT ".$attr." FROM ".$table.$where;
            $sth = $this->pdo->prepare($query);
            $sth->execute($param); //CONTEM UM ARRAY
            $response = $sth->fetchAll(PDO::FETCH_ASSOC);
            return array("results" => $response);
        }catch (PDOException $e){
            return $e -> getMessage();  
        }
        $pdo = null;
    } 
    function select1($attr,$table,$where,$param){
        try{
            $where = $where ?? "";
    
            $query = "SELECT ".$attr." FROM ".$table.$where;
            $sth = $this->pdo->prepare($query);
            $sth->execute($param); //CONTEM UM ARRAY
            $response = $sth->fetch(PDO::FETCH_ASSOC);
            return array("results" => $response);
        }catch (PDOException $e){
            return $e -> getMessage();  
        }
        $pdo = null;
    }
    function insert($table,$param,$value){
        try{
            $query = "INSERT INTO ".$table.$value;
            $sth = $this->pdo->prepare($query);
            $sth->execute((array)$param);
            return true;
        }catch(PDOExeception $e){
            return $e->getMessage();
        }
    }
    function update($table,$param,$value,$where){
        try{
            $query = "UPDATE ".$table." SET ".$value.$where;
            $sth = $this->pdo->prepare($query);
            $sth->execute((array)$param);
            return true;
        }catch(PDOExeception $e){
            return $e->getMessage();
        }
    }

    function delete($table,$where,$param){
        try{
            $query = "DELETE FROM ".$table.$where;
            $sth = $this->pdo->prepare($query);
            $sth->execute($param);
            return true;
        }catch(PDOExeception $e){
            return $e->getMessage();
        }
    }
}
?>