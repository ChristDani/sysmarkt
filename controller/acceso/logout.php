<?php
	require_once "../../model/usuarios.php";
	session_start();
	session_destroy();

	$dni = $_GET['dni'];

	$model = new user();
	$model->desactivarEstado($dni);
	
	header("location:../../");
?>