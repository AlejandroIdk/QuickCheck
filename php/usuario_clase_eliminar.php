<?php
	// Almacenando datos
    $userclass_id_del=limpiar_cadena($_GET['userclass_id_del']);

    // Verificando usuario_clase
    $check_userclass=conexion();
    $check_userclass=$check_userclass->query("SELECT * FROM usuario_clase WHERE userclass_id='$userclass_id_del'");

    if($check_userclass->rowCount()==1){

    	$datos=$check_userclass->fetch();

    	$eliminar_userclass=conexion();
    	$eliminar_userclass=$eliminar_userclass->prepare("DELETE FROM usuario_clase WHERE userclass_id=:id");

    	$eliminar_userclass->execute([":id"=>$userclass_id_del]);

    	if($eliminar_userclass->rowCount()==1){


	        echo '
	            <div class="notification is-info is-light">
	                <strong>¡Inscripcion ELIMINADA!</strong><br>
	                Los datos de la inscripcion se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar la inscripcion, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_userclass=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La inscripcion que intenta eliminar no existe
            </div>
        ';
    }
    $check_userclass=null;