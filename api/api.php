<?php
$app->response->setStatus(200);
$app->response()->headers->set('Content-Type', 'application/json');

$app->get("/login", function() use($app)
{	
	//Obtengo los parametros que vienen por get
	//Obtengo los parametros que vienen por todos los verbos http request->parameter('usuario'); 
      $usuario = $app->request->get('usuario');       
      $password = $app->request->get('clave');		 
	try{
		$service = new UserService();
        $result = array("message" => $service->login($usuario,$password));
        $app->response->body(json_encode($result));
    }catch(UserNotFoundExeption $ue) {
        $app->response()->setStatus(200);
        $result = array("message" => $service->login($usuario,$password));
    }catch(Exception $e) {
        $app->response()->setStatus(500);
         $app->response->body($e->getMessage());
    }
});

$app->post("/producto", function() use($app)
{
	 $nombreArticulo = $app->request->post('descripcion');       
     $precio = $app->request->post('precio');		 
     $observacion = $app->request->post('observacion');		 
	try{
		$connection = getConnection();
		$stm = $connection->prepare("INSERT INTO productos() VALUES(?,?,?)");
		$stm->bindParam(1, $nombreArticulo);
		$stm->bindParam(2, $precio);	
		$stm->bindParam(3, $observacion);	
		$stm->execute();
		$productos = $stm->fetchAll();
		 if($productos) {
            $app->response->setStatus(200);
            $app->response()->headers->set('Content-Type', 'application/json');
    		$app->response->body(json_encode($productos));		      
            $connection = null;
        } else {
            throw new Exception('No se pudo agregar el producto');
        } 	
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->get("/clientes/:id", function($id) use($app)
{
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("SELECT * FROM clientes WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$book = $dbh->fetch();
		$connection = null;

		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($book));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->post("/clientes/", function() use($app)
{
	$title = $app->request->post("title");
	$isbn = $app->request->post("isbn");
	$author = $app->request->post("author");

	try{
		$connection = getConnection();
		$dbh = $connection->prepare("INSERT INTO clientes VALUES(null, ?, ?, ?, NOW())");
		$dbh->bindParam(1, $title);
		$dbh->bindParam(2, $isbn);
		$dbh->bindParam(3, $author);
		$dbh->execute();
		$bookId = $connection->lastInsertId();
		$connection = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode($bookId));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->put("/clientes/", function() use($app)
{
	$title = $app->request->put("title");
	$isbn = $app->request->put("isbn");
	$author = $app->request->put("author");
	$id = $app->request->put("id");

	try{
		$connection = getConnection();
		$dbh = $connection->prepare("UPDATE clientes SET title = ?, isbn = ?, author = ?, created_at = NOW() WHERE id = ?");
		$dbh->bindParam(1, $title);
		$dbh->bindParam(2, $isbn);
		$dbh->bindParam(3, $author);
		$dbh->bindParam(4, $id);
		$dbh->execute();
		$connection = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});

$app->delete("/clientes/:id", function($id) use($app)
{
	try{
		$connection = getConnection();
		$dbh = $connection->prepare("DELETE FROM clientes WHERE id = ?");
		$dbh->bindParam(1, $id);
		$dbh->execute();
		$connection = null;
		$app->response->headers->set("Content-type", "application/json");
		$app->response->status(200);
		$app->response->body(json_encode(array("res" => 1)));
	}
	catch(PDOException $e)
	{
		echo "Error: " . $e->getMessage();
	}
});
