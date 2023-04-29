<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">

	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimun-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<meta name="title" content="Tienda Virtual">

	<meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat aspernatur voluptas velit commodi, libero. Nemo, soluta facilis minima tempora at similique tenetur placeat eius">

	<meta name="keyword" content="Lorem ipsum, dolor sit amet consectetur adipisicing elit, Placeat aspernatur voluptas velit commodi, libero Nemo, soluta facilis minima tempora at, similique tenetur placeat eius">

	<title>Tienda Virtual</title>

	<?php  

		$servidor = Ruta::ctrRutaServidor();

		$icono = ControladorPlantilla::ctrEstiloPlantilla();

		echo '<link rel="icon" href="'.$servidor.$icono["icono"].'">';

		/*--====================================
		   MANTENER LA RUTA FIJA DEL PROYECTO
		======================================*/

		$url = Ruta::ctrRuta();

	?>

	<!--=====================================
				   PLUGINS DE CSS
	======================================-->

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plugins/font-awesome.min.css">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed" rel="stylesheet">

	<!--=====================================
		  HOJAS DE ESTILO PERSONALIZADAS
	======================================-->

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/plantilla.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/cabezote.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/slide.css">

	<link rel="stylesheet" href="<?php echo $url; ?>vistas/css/productos.css">

	<!--=====================================
			   PLUGINS DE JAVASCRIPT
	======================================-->

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.min.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/bootstrap.min.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.easing.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plugins/jquery.scrollUp.js"></script>

</head>
<body>

	<?php  

	/*--====================================
					  CABEZOTE
	======================================*/

	include "modulos/cabezote.php";

	/*--====================================
			   CONTENIDO DINÁMICO
	======================================*/

	$rutas = array();
	$ruta = null;
	$infoProducto = null;

	if(isset($_GET["ruta"])){

		$rutas = explode("/", $_GET["ruta"]);

		$item = "ruta";
		$valor = $rutas[0];

		/*--====================================
			   URL AMIGABLES DE CATEGORIAS
		======================================*/

		$rutaCategorias = ControladorProductos::ctrMostrarCategorias($item, $valor);

		if($valor == $rutaCategorias["ruta"]){

			$ruta = $rutas[0];

		}

		/*--====================================
			 URL AMIGABLES DE SUBCATEGORIAS
		======================================*/

		$rutaSubCategorias = ControladorProductos::ctrMostrarSubCategorias($item, $valor);

		foreach ($rutaSubCategorias as $key => $value) {
			
			if($valor == $value["ruta"]){

			$ruta = $rutas[0];

			}

		}

		/*--====================================
			   URL AMIGABLES DE PRODUCTOS
		======================================*/

		$rutaProductos = ControladorProductos::ctrMostrarInfoProducto($item, $valor);

		if($valor == $rutaProductos["ruta"]){

			$infoProducto = $rutas[0];

		}

		/*--====================================
			  LISTA BLANCA DE URL AMIGABLES
		======================================*/

		if($ruta != null || $rutas[0] == "articulos-gratis" || $rutas[0] == "lo-mas-vendido" || $rutas[0] == "lo-mas-visto" ){

			include "modulos/productos.php";

		}elseif ($infoProducto != null) {
			
			include "modulos/infoproducto.php";

		}

		else{

			include "modulos/error404.php";

		}

	}else{

		include "modulos/slide.php";

		include "modulos/destacados.php";

	}

	?>

	<!--=====================================
			  JAVASCRIPT PERSONALIZADO
	======================================-->

	<script src="<?php echo $url; ?>vistas/js/cabezote.js"></script>

	<script src="<?php echo $url; ?>vistas/js/plantilla.js"></script>

	<script src="<?php echo $url; ?>vistas/js/slide.js"></script>

</body>
</html>