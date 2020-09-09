<?php require_once 'models/categoria.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Tienda de Camisetas</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/styles.css">
</head>
<body>
	<div id="container">
	<!--Cabecera-->
	<header id="header">
		<div id="logo">
			<img src="<?=base_url?>assets/img/camiseta.png" alt="camiseta logo">
			<a href="index.php">
				<h1>Tienda de camisetas</h1>
			</a>
		</div>
	</header>
	<!--menu-->
	<nav id="menu">
		<ul>
			<li>
				<a href="<?=base_url?>">Inicio</a>
			</li>
			<?php
				$categoria = new Categoria();
				$categorias = $categoria->getAll();
				while($cat = $categorias->fetch_object()) :
			?>
			<li>
				<a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
			</li>
		<?php endwhile; ?>
		</ul>
	</nav>

	<div id="content">