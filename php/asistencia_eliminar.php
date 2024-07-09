<?php
	// Almacenando datos
    $attendance_id_del=limpiar_cadena($_GET['attendance_id_del']);

    // Verificando asistencia
    $check_asistencia=conexion();
    $check_asistencia=$check_asistencia->query("SELECT * FROM asistencia WHERE asistencia_id='$attendance_id_del'");

    if($check_asistencia->rowCount()==1){

    	$datos=$check_asistencia->fetch();

    	$eliminar_asistencia=conexion();
    	$eliminar_asistencia=$eliminar_asistencia->prepare("DELETE FROM asistencia WHERE asistencia_id=:id");

    	$eliminar_asistencia->execute([":id"=>$attendance_id_del]);

    	if($eliminar_asistencia->rowCount()==1){


	        echo '
	            <div class="notification is-info is-light">
	                <strong>¡usuario_clase ELIMINADO!</strong><br>
	                Los datos de asistencia se eliminaron con exito
	            </div>
	        ';
	    }else{
	        echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No se pudo eliminar la asistencia, por favor intente nuevamente
	            </div>
	        ';
	    }
	    $eliminar_asistencia=null;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La asistencia que intenta eliminar no existe
            </div>
        ';
    }
    $check_asistencia=null;