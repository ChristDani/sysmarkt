<?php

	class conexion
	{

		public function conectar()
		{	
			try 
			{
				$servidor = "localhost";
				$usuario = "root";
				$clave = "";
				$base = "argosal"; 

				$con = mysqli_connect("$servidor", "$usuario", "$clave", "$base");
				// $con = new mysqli("$servidor", "$usuario", "$clave", "$base");
				// $con=new PDO("mysql:host=$servidor;dbname=$base;charset=UTF8",$usuario,$clave);
	
				if ($con) 
				{
					return $con;
				}
				// elseif (mysqli_connect_errno()) 
				// {
				// 	// printf("Connect failed: %s\n", mysqli_connect_error());
				// 	exit();
				// }
			} 
			catch (Exception $e) 
			{
				// echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			}		
		}

		public function desconectar()
		{
			// mysqli_close($con);
			// return $con;
			// $con=null;
			// $servidor = "localhost";
			// $usuario = "root";
			// $clave = "";
			// $base = "argosysmarkt"; 

			// $con = new mysqli("$servidor", "$usuario", "$clave", "$base");

			// $con->close();
		}
	}
?>