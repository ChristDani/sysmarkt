<?php

	class conexion
	{

		public function conectar()
		{	
			// try 
			// {
				$servidor = "localhost";
				$usuario = "root";
				$clave = "";
				$base = "argosal"; 

				$con = mysqli_connect("$servidor", "$usuario", "$clave", "$base");
	
				if ($con) 
				{
					return $con;
				}
			// } 
			// catch (Exception $e) 
			// {
			// 	// echo 'Excepción capturada: ',  $e->getMessage(), "\n";
			// }		
		}

		public function desconectar($con)
		{
			mysqli_close($con);
		}
	}
?>