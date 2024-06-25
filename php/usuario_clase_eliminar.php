<?php
	// Almacenando datos
    $product_id_del=limpiar_cadena($_GET['product_id_del']);

    // Verificando usuario_clase
    $check_usuario_clase=conexion();
    $check_usuario_clase=$check_usuario_clase->query("SELECT * FROM usuario_clase WHERE userclass_id='$product_id_del'");

    if($check_usuario_clase->rowCount()==1){

    	$datos=$check_usuario_clase->fetch();

    	$eliminar_usuario_clase=conexion();
    	$eliminar_usuario_clase=$eliminar_usuario_clase->prepare("DELETE FROM usuario_clase WHERE userclass_id=:id");

    	$eliminar_usuario_clase->execute([":id"=>$product_id_del]);

    	if($eliminar_usuario_clase->rowCount()==1){


	        echo '
	            <div class="notification is-info is-light">
	                <strong>¡usuario_clase ELIMINADO!</strong><br>
	                Los datos del usuario_clase se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar el usuario_clase, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_usuario_clase=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                El usuario_clase que intenta eliminar no existe
            </div>
        ';
    }
    $check_usuario_clase=null;