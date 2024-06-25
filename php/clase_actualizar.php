<?php
	require_once "main.php";

	// Almacenando id
    $id=limpiar_cadena($_POST['clase_id']);


    // Verificando clases
	$check_clases=conexion();
	$check_clases=$check_clases->query("SELECT * FROM clases WHERE clase_id='$id'");

    if($check_clases->rowCount()<=0){
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La categoría no existe en el sistema
            </div>
        ';
        exit();
    }else{
    	$datos=$check_clases->fetch();
    }
    $check_clases=null;

    // Almacenando datos
    $nombre=limpiar_cadena($_POST['clase_nombre']);
    $ubicacion=limpiar_cadena($_POST['clase_ubicacion']);


    // Verificando campos obligatorios
    if($nombre==""){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No has llenado todos los campos que son obligatorios
            </div>
        ';
        exit();
    }


    // Verificando integridad de los datos
    if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{4,50}",$nombre)){
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El NOMBRE no coincide con el formato solicitado
            </div>
        ';
        exit();
    }

    if($ubicacion!=""){
    	if(verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{5,150}",$ubicacion)){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                La UBICACION no coincide con el formato solicitado
	            </div>
	        ';
	        exit();
	    }
    }


    // Verificando nombre
    if($nombre!=$datos['clase_nombre']){
	    $check_nombre=conexion();
	    $check_nombre=$check_nombre->query("SELECT clase_nombre FROM clases WHERE clase_nombre='$nombre'");
	    if($check_nombre->rowCount()>0){
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                El NOMBRE ingresado ya se encuentra registrado, por favor elija otro
	            </div>
	        ';
	        exit();
	    }
	    $check_nombre=null;
    }


    // Actualizar datos
    $actualizar_clases=conexion();
    $actualizar_clases=$actualizar_clases->prepare("UPDATE clases SET clase_nombre=:nombre,clase_ubicacion=:ubicacion WHERE clase_id=:id");

    $marcadores=[
        ":nombre"=>$nombre,
        ":ubicacion"=>$ubicacion,
        ":id"=>$id
    ];

    if($actualizar_clases->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡clase ACTUALIZADA!</strong><br>
                La categoría se actualizo con exito
            </div>
        ';
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar la categoría, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_clases=null;