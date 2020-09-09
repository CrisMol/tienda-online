<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Tienda de Camisetas</title>
	<link rel="stylesheet" type="text/css" href="assets/css/styles.css">
</head>
<body>
	<div id="container">
	<!--Cabecera-->
	<header id="header">
		<div id="logo">
			<img src="assets/img/camiseta.png" alt="camiseta logo">
			<a href="index.php">
				<h1>Tienda de camisetas</h1>
			</a>
		</div>
	</header>
	<!--menu-->
	<nav id="menu">
		<ul>
			<li>
				<a href="#">Inicio</a>
			</li>
			<li>
				<a href="#">Categoria</a>
			</li>
			<li>
				<a href="#">Categoria 1</a>
			</li>
		</ul>
	</nav>

	<div id="content">
		<!--barra lateral-->
		<aside id="lateral">
			<div id="login" class="block_aside">
				<h3>Entrar a la Web</h3>
				<form action="" method="POST">
					<label for="email">Email</label>
					<input type="email" name="email">
					<label for="password">Contraseña</label>
					<input type="password" name="password">
					<input type="submit" name="" value="Enviar">
				</form>

				<ul>
					<li><a href="">Mis pedidos</a></li>
					<li><a href="">Gestionar Pedidos</a></li>
					<li><a href="">Gestionar Categorías</a></li>
				</ul>

			</div>
		</aside>
		<!--contenido central-->
		<div id="central">
			<h1>Productos Destacados</h1>
			<div class="product">
				<img src="assets/img/camiseta.png">
				<h2>Camiseta Azul Ancha</h2>
				<p>30$</p>
				<a href="" class="button">Comprar</a>
			</div>
			<div class="product">
				<img src="assets/img/camiseta.png">
				<h2>Camiseta Azul Ancha</h2>
				<p>30$</p>
				<a href="" class="button">Comprar</a>
			</div>
			<div class="product">
				<img src="assets/img/camiseta.png">
				<h2>Camiseta Azul Ancha</h2>
				<p>30$</p>
				<a href="" class="button">Comprar</a>
			</div>
		</div>
	</div>

	<footer id="footer">
		<p>Desarrollado por Cristian Molina &copy; <?=date('Y');?></p>
	</footer>
	</div>
</body>
</html>