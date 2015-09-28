<?php
$app->response->setStatus(200);
$app->response()->headers->set('Content-Type', 'application/json; charset=utf-8');

//=================================================================
$app->get("/usuario", function() use($app){	
	//Obtengo los parametros que vienen por get	
      $usuario = $app->request()->get('usuario');       
      $password = $app->request()->get('clave');		 
	try{

		$service = new UserService();
        $result = array("message" => $service->findBy($usuario,$password));                
        $app->response->body(json_encode($result));

    }catch(UserNotFoundExeption $ue) {

        $app->response()->setStatus(200);
        $result = array("message" => $service->login($usuario,$password));
        $app->response->body(json_encode($result));

    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

$app->delete("/usuario/", function() use($app){
	$usuario = $app->request->delete('usuario');       
	try{
	
		$service = new UserService();
		$result = array("message" => $service->delete($usuario));				
		$app->response->body(json_encode($result));
		
	}catch(UserNotFoundExeption $ue){
		$app->response()->setStatus(200);
        $result = array("message" => $service->delete($usuario));
        $app->response->body(json_encode($result));
	}catch(Exception $e){
 		$app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
	}

});

$app->get("/usuarios", function() use($app){		
	try{
		$service = new UserService();
        $result = array("message" => $service->getAll());                
        $app->response->body(json_encode($result));

    }catch(UserNotFoundExeption $ue) {

        $app->response()->setStatus(200);          
        $app->response->body(json_encode($ue->getMessage()));
    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

$app->post("/usuario/", function() use($app){		
       $nombre = $app->request->post('nombre');       
       $clave = $app->request->post('clave');		 
       $nivel = $app->request->post('nivel');		 
	try{
		$service = new UserService();
        $result = array("message" => $service->insert($nombre,$clave,$nivel));                
        print_r($result);
        $app->response->body(json_encode($result));

    }catch(UserNotFoundExeption $ue) {

        $app->response()->setStatus(200);
        $result = array("message" => $service->login($usuario,$password));
        $app->response->body(json_encode($result));

    }catch(PDOException $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

$app->put("/usuario/", function() use($app){		
	   $usuario = $app->request->put('usuario');       
       $nombre = $app->request->put('nombre');       
       $clave = $app->request->put('clave');		 
       $nivel = $app->request->put('nivel');		 
	try{
		$service = new UserService();
        $result = array("message" => $service->update($usuario,$nombre,$clave,$nivel));                
        print_r($result);
        $app->response->body(json_encode($result));

    }catch(UserNotFoundExeption $ue) {

        $app->response()->setStatus(200);
        $result = array("message" => $service->login($usuario,$password));
        $app->response->body(json_encode($result));

    }catch(PDOException $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

//=================================================================
//Articulos
$app->get("/articulos", function() use($app){		
	try{
		$service = new ArticulosService();
        $result = array("message" => $service->getAll());                                   
        $app->response->body(json_encode($result));		              
    }catch(ArticuloNotFoundExeption $ae) {
        $app->response()->setStatus(200);          
        $app->response->body(json_encode($ae->getMessage()));
    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

$app->delete("/articulo/", function() use($app){
    $articuloBorrado = $app->request->delete('articulo');       
    try{
    
        $service = new ArticulosService();
        $result = array("message" => $service->delete($articuloBorrado));               
        $app->response->body(json_encode($result));
        
    }catch(ArticuloNotFoundExeption $ae){
        $app->response()->setStatus(200);
        $result = array("message" => $service->delete($articuloBorrado));
        $app->response->body(json_encode($result));
    }catch(Exception $e){
        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }

});

$app->put("/articulo/", function() use($app){        
       $tipo = $app->request->put('tipo');       
       $descripcion = $app->request->put('descripcion');       
       $parcela = $app->request->put('parcela');        
       $precio = $app->request->put('precio');        
       $observacion = $app->request->put('observacion');        
       $articulo = $app->request->put('articulo');        
    try{
        $service = new ArticulosService();
        $result = array("message" => $service->update($articulo,$tipo,$descripcion,$parcela,$precio,$observacion));                
        print_r($result);
        $app->response->body(json_encode($result));

    }catch(ArticuloNotFoundExeption $ae) {

        $app->response()->setStatus(200);
        $result = array("message" => $service->login($usuario,$password));
        $app->response->body(json_encode($result));

    }catch(PDOException $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});


//=================================================================
//Clientes
$app->get("/clientes", function() use($app){		
	try{
		$service = new ClientesService();
        $result = array("message" => $service->getAll());                   
        $app->response->body(json_encode($result));		              
    }catch(ClienteNotFoundExeption $clie) {

        $app->response()->setStatus(200);          
        $app->response->body(json_encode($clie->getMessage()));
    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
}); 
$app->post("/cliente/", function() use($app){       
       $localidad = $app->request->post('localidad');       
       $descripcion = $app->request->post('descripcion');       
       $telefono = $app->request->post('telefono');        
       $documento = $app->request->post('documento');        
       $alta = $app->request->post('alta');        
       $observacion = $app->request->post('observacion');        
    try{
        $service = new ClientesService();
        $result = array("message" => $service->insert($localidad,$descripcion,$telefono,$documento,$alta,$observacion));                
        print_r($result);
        $app->response->body(json_encode($result));

    }catch(ClienteNotFoundExeption $cli) {

        $app->response()->setStatus(200);
        $result = array("message" => $service->login($usuario,$password));
        $app->response->body(json_encode($result));

    }catch(PDOException $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

//=================================================================
//Ventas
$app->get("/ventas", function() use($app){		
	try{
		$service = new VentasService();
        $result = array("message" => $service->getAll());                   
        $app->response->body(json_encode($result));		              
    }catch(VentaNotFoundExeption $ve) {

        $app->response()->setStatus(200);          
        $app->response->body(json_encode($ve->getMessage()));
    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

$app->post("/venta/", function() use($app){         
       $cliente = $app->request->post('cliente');       
       $usuario = $app->request->post('usuario');       
       $alta = $app->request->post('alta');      
       $descripcion = $app->request->post('descripcion');       

    try{
        $service = new VentasService();
        $result = array("message" => $service->insert($cliente, $usuario, $alta, $descripcion));                   
        print_r($result);
        $app->response->body(json_encode($result));            

    }catch(VentaNotFoundExeption $ve) {

        $app->response()->setStatus(200);          
        $app->response->body(json_encode($ve->getMessage()));

    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));

    }
});

//=================================================================
//Consultas
$app->get("/consultas", function() use($app){		
	try{
		$service = new ConsultasService();
        $result = array("message" => $service->getAll());                   
        $app->response->body(json_encode($result));		              
    }catch(ConsultaNotFoundExeption $ce) {

        $app->response()->setStatus(200);          
        $app->response->body(json_encode($ce->getMessage()));
    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

$app->post("/consulta/", function() use($app){		   
       $descripcion = $app->request->post('descripcion');       
       $direccion = $app->request->post('direccion');       
       $telefono = $app->request->post('telefono');		 
       $email = $app->request->post('email');
       $observacion = $app->request->post('observacion');		
       $alta = $app->request->post('alta');
	try{
		$service = new ConsultasService();
        $result = array("message" => $service->insert($descripcion, $direccion, $telefono, $email, $observacion, $alta));                   
        print_r($result);
        $app->response->body(json_encode($result));            
    }catch(ConsultaNotFoundExeption $ce) {
        $app->response()->setStatus(200);          
        $app->response->body(json_encode($ce->getMessage()));
    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

//=================================================================
//Compras
$app->get("/compras", function() use($app){		
	try{
		$service = new ComprasService();
        $result = array("message" => $service->getAll());                   
        $app->response->body(json_encode($result));		              
    }catch(CompraNotFoundExeption $ce) {

        $app->response()->setStatus(200);          
        $app->response->body(json_encode($ce->getMessage()));
    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

$app->post("/compra/", function() use($app){         
       $proveedor = $app->request->post('cliente');       
       $usuario = $app->request->post('usuario');       
       $alta = $app->request->post('alta');              

    try{
        $service = new ComprasService();
        $result = array("message" => $service->insert($proveedor, $usuario, $alta));                   
        print_r($result);
        $app->response->body(json_encode($result));            

    }catch(CompraNotFoundExeption $ce) {

        $app->response()->setStatus(200);          
        $app->response->body(json_encode($ce->getMessage()));

    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
        
    }
});

//=================================================================
//Movimientos
$app->get("/movimientos", function() use($app){     
    try{
        $service = new MovimientosService();
        $result = array("message" => $service->getAll());                   
        $app->response->body(json_encode($result));                   
    }catch(MovimientoNotFoundException $me) {
        $app->response()->setStatus(200);          
        $app->response->body(json_encode($me->getMessage()));
    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});

$app->post("/movimiento/", function() use($app){         
       $concepto = $app->request->post('concepto');       
       $usuario = $app->request->post('usuario');       
       $alta = $app->request->post('alta');      
       $importe = $app->request->post('importe');
       $descripcion = $app->request->post('descripcion');       
    try{
        $service = new MovimientosService();
        $result = array("message" => $service->insert($concepto, $usuario, $alta, $importe, $descripcion));                   
        print_r($result);
        $app->response->body(json_encode($result));            
    }catch(MovimientoNotFoundException $me) {
        $app->response()->setStatus(200);          
        $app->response->body(json_encode($ce->getMessage()));
    }catch(Exception $e) {

        $app->response()->setStatus(500);        
        $app->response->body(json_encode($e->getMessage()));
    }
});