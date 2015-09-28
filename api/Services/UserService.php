<?php 
class UserService {
    
    public function findBy($name = null,$clave=null, $nivel=null, $id=null){
        $connection = getConnection();
        $sql = "SELECT * FROM usuarios where 1=1 ";
        if($name){
            $sql.=" and nombre=\"$name\"";
        }
        if($clave){
            $sql.=" and clave=\"$clave\"";
        }
        if($nivel){
            $sql.=" and nivel=\"$nivel\"";
        }
        
        if($id){
            $sql.=" and id=\"$id\"";
        }
		$stm = $connection->prepare($sql);				 
		$stm->execute();
		$usuarios = $stm->fetchAll(PDO::FETCH_OBJ);		
        if(!$usuarios) { 
            throw new UserNotFoundException('No se encontro al usuario');
        } 
        return $usuarios;		      ;
    
    }
    
    public function login($user, $pass){
        $return = $this->findBy($user, $pass);
        return  !empty($return);
    }
    
}