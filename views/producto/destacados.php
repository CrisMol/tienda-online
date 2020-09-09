<h1>Algunos de nuestros productos</h1>

	<?php while($produc = $productos->fetch_object()) :?>
		<div class="product">
			<a href="<?=base_url?>/producto/ver&id=<?=$produc->id?>">
				<?php if($produc->imagen != null):?>	
					<img src="<?=base_url?>uploads/images/<?=$produc->imagen?>">
				<?php else: ?>
					<img src="<?=base_url?>assets/img/camiseta.png">
				<?php endif; ?>
				<h2><?=$produc->nombre?></h2>
			</a>
			<p><?=$produc->precio?></p>
			<a href="<?=base_url?>carrito/add&id=<?=$produc->id?>" class="button">Comprar</a>
		</div>
	<?php endwhile;?>