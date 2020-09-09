<?php if(isset($pro)) :?>
	<h1><?=$pro->nombre?></h1>
	<div class="detail-product" id="detail-product">
		<div class="image">
			<?php if($pro->imagen != null):?>	
				<img src="<?=base_url?>uploads/images/<?=$pro->imagen?>">
			<?php else: ?>
				<img src="<?=base_url?>assets/img/camiseta.png">
			<?php endif; ?>
		</div>
		<div class="data" id="data">
			<p class="description"><?=$pro->descripcion?></p>
			<p class="price"><?=$pro->precio?>$</p>
			<a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class="button">Comprar</a>
		</div>
	</div>
<?php else: ?>
	<h1>El producto no existe</h1>
<?php endif; ?>