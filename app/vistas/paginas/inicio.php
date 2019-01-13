<?php require RUTA_APP . '/vistas/inc/header.php'; ?>

<p><?php echo $datos['titulo']; ?></p>

<ul>
	<?php foreach ($datos['articulos'] as $articulo): ?> 
		<li><?php echo $articulo->titulo; ?></li>
	<?php endforeach;?> 
</ul>	
<!--
El contenido esta entre el header y el footer que vienen a ser lo que se repite de una pagina
-->
<?php require RUTA_APP . '/vistas/inc/footer.php'; ?>