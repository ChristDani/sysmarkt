<?php

require_once("../../model/usuarios.php");
	
$dni = $_POST['dni'];
$clave = sha1($_POST['clave']);

$consultas=new user();
$filas2=$consultas->buscarUser($dni);

if ($filas2 != null) 
{
	foreach($filas2 as $columna) 
	{
		$tdni = $columna[0];
		$tusu = $columna[1];
		$tclave = $columna[2];
		$ttipo = $columna[3];
		$tactivo = $columna[7];
	}
	if(($dni == $tdni) && ($clave == $tclave) && ($tactivo == "1"))
	{
		session_start();
		$_SESSION["dnisysmarkt"] = $tdni;
		$_SESSION["usersysmarkt"] = $tusu;
		$_SESSION["tiposysmarkt"] = $ttipo;
		$_SESSION["Mensajesysmarkt"] = null;
		$consultas->activarEstado($dni);
		header("location:../../index.php?pagina=Dashboard");
	}
	else
	{
		session_start();
		$_SESSION["Mensajesysmarkt"]="<p class='text-danger'>Los datos son incorrectos</p>";
		if (!isset($_SESSION["intentossysmarkt"])) 
		{
			$_SESSION["intentossysmarkt"] = 1;
		}	
		elseif ($_SESSION['intentossysmarkt'] > 0 && $_SESSION["intentossysmarkt"] < 3) 
		{
			$_SESSION["intentossysmarkt"] = $_SESSION["intentossysmarkt"]+1;
		}
		header("location:../../");
	}
}
else
{
	session_start();
	$_SESSION["Mensajesysmarkt"]="<p class='text-danger'>Los datos son incorrectos</p>";
	if (!isset($_SESSION["intentossysmarkt"])) 
	{
		$_SESSION["intentossysmarkt"] = 1;
	}	
	elseif ($_SESSION['intentossysmarkt'] > 0 && $_SESSION["intentossysmarkt"] < 3) 
	{
		$_SESSION["intentossysmarkt"] = $_SESSION["intentossysmarkt"]+1;
	}	
	header("location:../../");
}
?>
