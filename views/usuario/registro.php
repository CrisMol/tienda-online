<H1>Registrarse</H1>

<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
		<strong class="alert_green">Registro Completado Correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
		<strong class="alert_red">Registro Fallido, introduce bien los datos.</strong>
<?php endif; ?>

<?php Utils::deleteSession('register');?>

<form action="<?=base_url?>usuario/save" method="POST">
	<label for="nombre">Nombre:</label>
	<input type="text" name="nombre" required>

	<label for="apellido">Apellidos:</label>
	<input type="text" name="apellido" required>

	<label for="email">Email:</label>
	<input type="email" name="email" required>

	<label for="password">Password:</label>
	<input type="password" name="password" required>

	<input type="submit" name="" value="Registrarse">

</form>