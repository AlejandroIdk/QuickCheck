<div class="container is-fluid mb-6">
	<h1 class="title">Clases</h1>
	<h2 class="subtitle">Actualizar clase</h2>
</div>

<div class="container pb-6 pt-6">
	<?php
		include "./inc/btn_back.php";

		require_once "./php/main.php";

		$id = (isset($_GET['userclass_id_up'])) ? $_GET['userclass_id_up'] : 0;
		$id=limpiar_cadena($id);

		/*== Verificando usuario_clase ==*/
    	$check_usuario_clase=conexion();
    	$check_usuario_clase=$check_usuario_clase->query("SELECT * FROM usuario_clase WHERE userclass_id='$id'");

        if($check_usuario_clase->rowCount()>0){
        	$datos=$check_usuario_clase->fetch();
	?>

	<div class="form-rest mb-6 mt-6"></div>
	
	<form action="./php/usuario_clase_actualizar.php" method="POST" class="FormularioAjax" autocomplete="off" >

		<input type="hidden" name="userclass_id" value="<?php echo $datos['userclass_id']; ?>" required >


		<div class="columns">
		<div class="column">
				<label>Categoría</label><br>
		    	<div class="select is-rounded">
				  	<select name="usuario_clase_clases" >
				    	<?php
    						$clases=conexion();
    						$clases=$clases->query("SELECT * FROM usuario_clase");
    						if($clases->rowCount()>0){
    							$clases=$clases->fetchAll();
    							foreach($clases as $row){
    								if($datos['clase_id']==$row['clase_id']){
    									echo '<option value="'.$row['clase_id'].'" selected="" >'.$row['usuario_identificacion'].' (Actual)</option>';
    								}else{
    									echo '<option value="'.$row['clase_id'].'" >'.$row['usuario_identificacion'].'</option>';
    								}
				    			}
				   			}
				   			$clases=null;
				    	?>
				  	</select>
				</div>
		  	</div>
		  	<div class="column">
				<label>Categoría</label><br>
		    	<div class="select is-rounded">
				  	<select name="usuario_clase_clases" >
				    	<?php
    						$clases=conexion();
    						$clases=$clases->query("SELECT * FROM clases");
    						if($clases->rowCount()>0){
    							$clases=$clases->fetchAll();
    							foreach($clases as $row){
    								if($datos['clase_id']==$row['clase_id']){
    									echo '<option value="'.$row['clase_id'].'" selected="" >'.$row['clase_nombre'].' (Actual)</option>';
    								}else{
    									echo '<option value="'.$row['clase_id'].'" >'.$row['clase_nombre'].'</option>';
    								}
				    			}
				   			}
				   			$clases=null;
				    	?>
				  	</select>
				</div>
		  	</div>
		</div>
		<p class="has-text-centered">
			<button type="submit" class="button is-success is-rounded">Actualizar</button>
		</p>
	</form>
	<?php 
		}else{
			include "./inc/error_alert.php";
		}
		$check_usuario_clase=null;
	?>
</div>