<h1>Detalle del pedido</h1>

<?php if(isset($pedido)):?>
	<?php if(isset($_SESSION['admin'])):?>
		<h3>Cambiar estado del pedido:</h3>
		<form action="<?=base_url?>pedido/estado" method="POST">
			<input type="hidden" name="pedido-id" value="<?=$pedido->id?>">
			<select name="estado">
				<option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '';?>>Pendiente</option>
				<option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : '';?>>Preparación</option>
				<option value="ready" <?=$pedido->estado == "ready" ? 'selected' : '';?>>Preparado para enviar</option>
				<option value="sender" <?=$pedido->estado == "sender" ? 'selected' : '';?>>Enviado</option>
			</select>
			<input type="submit" name="" value="cambiar-estado">
		</form>
		<br>
	<?php endif; ?>

	<h3>Datos del usuario: </h3><br>
		Nombre: <?=$usuario->nombre?></br>
		Apellido: <?=$usuario->apellido?></br>
		Correo: <?=$usuario->email?></br>
		<br>
	<h3>Detalles del envió:</h3></br>
		Provincia: <?=$pedido->provincia?></br>
		Ciudad: <?=$pedido->localidad?></br>
		Dirección: <?=$pedido->direccion?></br>
		<br>
		<h3>Datos del pedido: </h3></br>
			Estado: <?=Utils::showStatus($pedido->estado)?></br>
			Número de pedidos: <?=$pedido->id?></br>
			Total a pagar: <?=$pedido->coste?>$</br>
			Productos: </br>
			<br>
			<table>
				<tr>
					<th>Imagen</th>
					<th>Nombre</th>
					<th>Precio</th>
					<th>Unidades</th>
				</tr>
				<?php while($producto = $productos->fetch_object()) :?>
				<tr>
					<td>
						<?php if($producto->imagen != null):?>	
							<img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="img_carrito">
						<?php else: ?>
							<img src="<?=base_url?>assets/img/camiseta.png" class="img_carrito">
						<?php endif; ?>
					</td>
					<td>
						<a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>	
					</td>
					<td><?=$producto->precio?></td>
					<td><?=$producto->unidades?></td>
				</tr>
			<?php endwhile; ?>
			</table>
	<?php endif; ?>