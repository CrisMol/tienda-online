<h1>Gestion de Productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">Crear Productos</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'):?>
	<strong class="alert_green">Producto creado Correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'):?>
	<strong class="alert_red">No se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto')?>

<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'):?>
	<strong class="alert_green">Producto se ha Borrado Correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'):?>
	<strong class="alert_red">No se ha borrado </strong>
<?php endif; ?>
<?php Utils::deleteSession('delete')?>

<table border="1">
	<tr>
		<th>Id</th>
		<th>Nombre</th>
		<th>Descripcion</th>
		<th>Precio</th>
		<th>Stock</th>
		<th>Oferta</th>
		<th>Imagen</th>
		<th>Acciones</th>
	</tr>
<?php while($produc = $productos->fetch_object()) :?>
	<tr>
		<td><?=$produc->id;?></td>
		<td><?=$produc->nombre;?></td>
		<td><?=$produc->descripcion;?></td>
		<td><?=$produc->precio;?></td>
		<td><?=$produc->stock;?></td>
		<td><?=$produc->fecha;?></td>
		<td><?=$produc->imagen;?></td>
		<td>
			<a href="<?=base_url?>producto/editar&id=<?=$produc->id?>" class="button button-gestion">Editar</a>
			<a href="<?=base_url?>producto/eliminar&id=<?=$produc->id?>" class="button button-gestion button-red">Eliminar</a>
		</td>
	</tr>
<?php endwhile; ?>
</table>