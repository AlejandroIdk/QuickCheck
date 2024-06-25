<?php
    $clase_id_del=limpiar_cadena($_GET['clase_id_del']);

    $check_clases=conexion();
    $check_clases=$check_clases->query("SELECT clase_id FROM clases WHERE clase_id='$clase_id_del'");
    
    if($check_clases->rowCount()==1){

    	$check_usuario_clase=conexion();
    	$check_usuario_clase=$check_usuario_clase->query("SELECT clase_id FROM usuario_clase WHERE clase_id='$clase_id_del' LIMIT 1");

    	if($check_usuario_clase->rowCount()<=0){

    		$eliminar_clases=conexion();
	    	$eliminar_clases=$eliminar_clases->prepare("DELETE FROM clases WHERE clase_id=:id");

	    	$eliminar_clases->execute([":id"=>$clase_id_del]);

	    	if($eliminar_clases->rowCount()==1){
		        echo '
		            <div class="notification is-info is-light">
		                <strong>¡clases ELIMINADA!</strong><br>
		                Los datos de la categoría se eliminaron con exito
		            </div>
		        ';
		    }else{
		        echo '
		            <div class="notification is-danger is-light">
		                <strong>¡Ocurrio un error inesperado!</strong><br>
		                No se pudo eliminar la categoría, por favor intente nuevamente
		            </div>
		        ';
		    }
		    $eliminar_clases=null;
    	}else{
    		echo '
	            <div class="notification is-danger is-light">
	                <strong>¡Ocurrio un error inesperado!</strong><br>
	                No podemos eliminar la categoría ya que tiene usuario_clase asociados
	            </div>
	        ';
    	}
    	$check_usuario_clase=null;
    }else{
    	echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                La clases que intenta eliminar no existe
            </div>
        ';
    }
    $check_clases=null;