<?php 
class UserService {
    
    public function getAll(){
        $connection = getConnection();
        $sql = "SELECT * FROM usuarios";    
        $stm = $connection->prepare($sql);               
        $stm->execute();
        $usuarios = $stm->fetchAll(PDO::FETCH_OBJ);    
        $connection = null; 
        if(!$usuarios) { 
            throw new UserNotFoundException('No se encontro al usuario');
        } 
        return $usuarios;             
    }

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
		$usuario = $stm->fetch(PDO::FETCH_OBJ);		 
        $connection = null;       
        if(!$usuario) { 
            throw new UserNotFoundException('No se encontro al usuario');
        } 
        return $usuario;
    
    }
    public function delete($usuario = null){              
        $connection = getConnection();
        $stm = $connection->prepare("DELETE FROM usuarios WHERE usuario=\"$usuario\"");                
        $count = $stm->execute();        
        print_r($count);    
        if(!$count) { 
            throw new UserNotFoundException('No se encontro el usuario a eliminar');
        } 
        return $count;   
    }

    public function insert($nombre=null,$clave=null,$nivel=null){       
        $connection = getConnection();             
        $stm = $connection->prepare("INSERT INTO usuarios(nombre,clave,nivel)VALUES(\"$nombre\",\"$clave\",\"$nivel\")");        
        $count = $stm->execute();        
        print_r($count);    
        if(!$count) { 
            throw new UserNotFoundException('Error al insertar el usuario');
        } 
        return $count;   
    }

    public function update($usuario=null,$nombre=null,$clave=null,$nivel=null){
        $connection = getConnection();        
        $stm = $connection->prepare("UPDATE usuarios SET nombre = ?, clave = ?, nivel = ? WHERE usuario = ?");
        $stm->bindParam(1, $nombre);
        $stm->bindParam(2, $clave);
        $stm->bindParam(3, $nivel);
        $stm->bindParam(4, $usuario);                       
        $stm->execute();
        $usuario = $stm->rowCount();
        if(!$usuario) { 
            throw new UserNotFoundException('No se encontro el usuario a actualizar');
        } 
        return $usuario;   
    }

    public function login($user, $pass){
        $return = $this->findBy($user, $pass);
        return  !empty($return);
    } 
} 

class ArticulosService {
    
    public function getAll(){
        $connection = getConnection();
        $sql = "SELECT * FROM articulos";    
        $stm = $connection->prepare($sql);               
        $stm->execute();
        $articulos = $stm->fetchAll(PDO::FETCH_ASSOC);
        print_r($articulos);    
        $connection = null; 
        if(!$articulos) { 
            throw new ArticuloNotFoundException('No se encontro el articulo');
        } 
        return $articulos;             
    }

   public function delete($articulo = null){              
        $connection = getConnection();
        $stm = $connection->prepare("DELETE FROM articulos WHERE articulo=\"$articulo\"");                
        $count = $stm->execute();        
        print_r($count);    
        if(!$count) { 
            throw new ArticuloNotFoundException('No se encontro el articulo a eliminar');
        } 
        return $count;   
    }

    public function insert($tipo,$descripcion,$parcela,$precio,$observacion){       
        $connection = getConnection();             
        $stm = $connection->prepare("INSERT INTO articulos(tipo,descripcion,parcela,precio,observacion)VALUES(\"$tipo\",\"$descripcion\",\"$parcela\",\"$precio\",\"$observacion\")");        
        $count = $stm->execute();        
        print_r($count);    
        if(!$count) { 
            throw new ArticuloNotFoundException('Error al insertar un articulo');
        } 
        return $count;   
    }

    public function update($articulo,$tipo,$descripcion,$parcela,$precio,$observacion){
        $connection = getConnection();        
        $stm = $connection->prepare("UPDATE articulos SET tipo = ?, descripcion = ?, parcela = ?, precio = ?, observacion = ? WHERE articulo = ?");
        $stm->bindParam(1, $tipo);
        $stm->bindParam(2, $descripcion);
        $stm->bindParam(3, $parcela);
        $stm->bindParam(4, $precio);                       
        $stm->bindParam(5, $observacion);    
        $stm->bindParam(6, $articulo);    
        $stm->execute();
        $articuloModificado = $stm->rowCount();
        if(!$articuloModificado) { 
            throw new ArticuloNotFoundException('No se encontro el articulo a modificar');
        } 
        return $articuloModificado;   
    }
    
} 

class ComprasService{
     public function getAll(){
        $connection = getConnection();
        $sql = "SELECT * FROM compras";    
        $stm = $connection->prepare($sql);               
        $stm->execute();
        $compras = $stm->fetchAll(PDO::FETCH_ASSOC);
        print_r($compras);    
        $connection = null; 
        if(!$compras) { 
            throw new CompraNotFoundException('No se encontro las compras solicitadas');
        } 
        return $compras;             
    }

      public function insert($proveedor, $usuario, $alta){                
        $connection = getConnection();
        $stm = $connection->prepare("INSERT INTO compras (proveedor,usuario,alta)VALUES(\"$proveedor\",\"$usuario\",\"$alta\")");
        $count = $stm->execute();        
        print_r($count);    
         if(!$count) { 
            throw new MovimientoNotFoundException('No se pudo ingresar la compra');
        } 
        return $count;       
    }

}

class ClientesService{
     public function getAll(){
        $connection = getConnection();
        // $sql = "SELECT * FROM clientes";    
        $sql = "call lista_clientes()";
        $stm = $connection->prepare($sql);               
        $stm->execute();
        $clientes = $stm->fetchAll(PDO::FETCH_ASSOC);
        print_r($clientes);    
        $connection = null; 
        if(!$clientes) { 
            throw new ClienteNotFoundException('No se encontro el cliente solicitado');
        } 
        return $clientes;             
    }
       public function delete($cliente = null){              
        $connection = getConnection();
        $stm = $connection->prepare("DELETE FROM clientes WHERE cliente=\"$cliente\"");                
        $count = $stm->execute();        
        print_r($count);    
        if(!$count) { 
            throw new ClienteNotFoundException('No se encontro el cliente a eliminar');
        } 
        return $count;   
    }
     
    public function insert($localidad=null,$descripcion=null,$telefono=null,$documento=null,$alta=null,$observacion=null){       
        $connection = getConnection();             
        $stm = $connection->prepare("INSERT INTO clientes(localidad,descripcion,telefono,documento,alta,observacion)VALUES(\"$localidad\",\"$descripcion\",\"$telefono\",\"$documento\",\"$alta\",\"$observacion\")");        
        $count = $stm->execute();        
        print_r($count);    
        if(!$count) { 
            throw new ClienteNotFoundException('Error al insertar el cliente');
        } 
        return $count;   
    }

    public function update($cliente=null,$localidad=null,$descripcion=null,$telefono=null,$documento=null,$alta=null,$observacion=null){
        $connection = getConnection();        
        $stm = $connection->prepare("UPDATE clientes SET localidad = ?, descripcion = ?, telefono = ? , documento = ?, alta = ?  observacion = ? WHERE cliete = ?");
        $stm->bindParam(1, $localidad);
        $stm->bindParam(2, $descripcion);
        $stm->bindParam(3, $telefono);
        $stm->bindParam(4, $documento);                       
        $stm->bindParam(5, $alta);         
        $stm->bindParam(6, $observacion);         
        $stm->bindParam(7, $cliente);  
        $stm->execute();
        $cliente = $stm->rowCount();
        if(!$cliente) { 
            throw new ClienteNotFoundException('No se encontro el cliente a modificar');
        } 
        return $cliente;   
    }
}

class VentasService{
     public function getAll(){
        $connection = getConnection();
        $sql = "SELECT * FROM ventas";    
        $stm = $connection->prepare($sql);               
        $stm->execute();
        $ventas = $stm->fetchAll(PDO::FETCH_ASSOC);
        print_r($ventas);    
        $connection = null; 
        if(!$ventas) { 
            throw new VentaNotFoundException('No se encontro las ventas solicitadas');
        } 
        return $ventas;             
    }
     public function insert($cliente, $usuario, $alta, $descripcion){                
        $connection = getConnection();
        $stm = $connection->prepare("INSERT INTO ventas (cliente,usuario,alta,descripcion)VALUES(\"$cliente\",\"$usuario\",\"$alta\",\"$descripcion\")");
        $count = $stm->execute();        
        print_r($count);    
         if(!$count) { 
            throw new VentaNotFoundException('No se pudo ingresar las ventas');
        } 
        return $count;       
    }
}

class ConsultasService{
     public function getAll(){
        $connection = getConnection();
        $sql = "SELECT * FROM consultas";    
        $stm = $connection->prepare($sql);               
        $stm->execute();
        $consultas = $stm->fetchAll(PDO::FETCH_ASSOC);
        print_r($consultas);    
        $connection = null; 
        if(!$consultas) { 
            throw new ConsultaNotFoundException('No se encontro la consulta solicitada');
        } 
        return $consultas;             
    }
     public function insert($descripcion, $direccion, $telefono, $email, $observacion, $alta){                
        $connection = getConnection();
        $stm = $connection->prepare("INSERT INTO consultas(descripcion,direccion,telefono,email,observacion,alta)VALUES(\"$descripcion\",\"$direccion\",\"$telefono\",\"$email\",\"$observacion\",\"$alta\")");
        $count = $stm->execute();        
        print_r($count);    
         if(!$count) { 
            throw new ConsultaNotFoundException('No se pudo mandar su consulta');
        } 
        return $count;       
    }

}

class MovimientosService{
     public function getAll(){
        $connection = getConnection();
        $sql = "SELECT * FROM movimientos";    
        $stm = $connection->prepare($sql);               
        $stm->execute();
        $movimientos = $stm->fetchAll(PDO::FETCH_ASSOC);
        print_r($movimientos);    
        $connection = null; 
        if(!$movimientos) { 
            throw new MovimientoNotFoundException('No se encontraron los movimientos');
        } 
        return $movimientos;             
    }
     public function insert($concepto, $usuario, $alta, $importe, $descripcion){                
        $connection = getConnection();
        $stm = $connection->prepare("INSERT INTO movimientos (concepto,usuario,alta,importe,descripcion)VALUES(\"$concepto\",\"$usuario\",\"$alta\",\"$importe\",\"$descripcion\")");
        $count = $stm->execute();        
        print_r($count);    
         if(!$count) { 
            throw new MovimientoNotFoundException('No se pudo ingresar el movimiento');
        } 
        return $count;       
    }
} 
?>
