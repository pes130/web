<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    // Pintamos el elemento de formulario con name = nombre
    if(isset($_POST['nombre'])) {
            $nombre=$_POST["nombre"];
    }

    // Pintamos el elemento de formulario con name = genero_accion
    if(isset($_POST['genero_accion'])) {
            $accion=$_POST["genero_accion"];
    }

    // Pintamos el elemento de formulario con name = genero_comedia
    if(isset($_POST['genero_comedia'])) {
            $comedia=$_POST["genero_comedia"];
    }

    // Pintamos el elemento de formulario con name = genero_suspense
    if(isset($_POST['genero_suspense'])) {
            $suspense=$_POST["genero_suspense"];
    }

    // Pintamos el elemento de formulario con name = comer_palomitas
    if(isset($_POST['comer_palomitas'])) {
            $palomitas=$_POST["comer_palomitas"];
    }

    // Pintamos el elemento de formulario con name = pelicula_favorita
    if(isset($_POST['pelicula_favorita'])) {
            $pelicula_favorita=$_POST["pelicula_favorita"];
    }

    // Pintamos el elemento de formulario con name = cine_favorito
    if(isset($_POST['cine_favorito'])) {
            $cine_favorito=$_POST["cine_favorito"];
    }

    // Pintamos el elemento de formulario con name = sitio_favorito
    if(isset($_POST['sitio_favorito'])) {
            $sitio_favorito=$_POST["sitio_favorito"];
    }
    if(isset($_FILES['foto']['name']) && $_FILES['foto']['name']!=""){
        $dir_subida = '/var/www/html/uploads/';
        $fichero_subido = $dir_subida . basename($_FILES['foto']['name']);
        move_uploaded_file($_FILES['foto']['tmp_name'], $fichero_subido);
        $imagen = "/uploads/". basename($_FILES['foto']['name']);
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
    <head>
        <title>Formularios básicos</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF8"/>
        <meta name="author" content="pablo"/>
        <style>
            
        </style>
    </head>
    <body>
        <h1>Variables recibidas</h1>
        <h2>Datos personales</h2>
        <ul>    
            <li><strong>Nombre</strong>: <?php echo "$nombre;" ?></li>
            <?php if(isset($imagen)) {?>
                <li><img src='<?php echo "$imagen";?>' height="150" alt="Imagen del usuario"/></li>
            <?php } ?>
        </ul>
        <h2>Preguntas de cine</h2>
        <ul>
            <li><strong>Géneros de cine favoritos</strong>
                <ul>
                    <?php if(isset($accion)) {echo "<li>Acción</li>";} ?>
                    <?php if(isset($comedia)) {echo "<li>Comedia</li>";} ?>
                    <?php if(isset($suspense)) {echo "<li>Suspense</li>";} ?>
                </ul>
            </li>
            <li><strong>¿Te gusta comer palomitas en el cine?: <?php echo "$palomitas" ?></strong></li>
            <li><strong>Película favorita:</strong>
                <pre><?php echo "$pelicula_favorita" ?></pre>
            </li>
            <li><strong>Cine favorito: </strong><?php echo "$cine_favorito" ?></li>
            <li><strong>Sitio favorito: </strong><?php echo "$sitio_favorito" ?></li>

        </ul>
    </body>
</html>