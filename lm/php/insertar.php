<?php
	require_once("globales.php");
	$postData = file_get_contents('php://input');

	if(!$persona = simplexml_load_string($postData)){
		echo "Error al recibir datos XML por POST";
	} else {
		print_r($persona);		
	    echo 'Nombre: '.$persona->nombre.'<br>';
	    echo 'Apellidos: '.$persona->apellidos.'<br>';
	    echo 'Teléfono: '.$persona->telefono.'<br>';
   		$db->exec('BEGIN');
		$db->query('INSERT INTO "personas" ("nombre", "apellidos", "telefono")
	    	VALUES ("$persona->nombre", "$persona->apellidos", "$persona->telefono")');
		$db->exec('COMMIT');
	}
?>
