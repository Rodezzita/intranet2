<?php 
	$conexion = null;
        $conexionSQL=null;
	function conectar()
	{
		global $conexion;
	        $conexion = mysqli_connect('192.168.0.104', 'root', 'carlos123', 'intranet');
		//$conexion = mysqli_connect('localhost', 'trading', 'a1b2c3d4e5f6', 'trading_intranet');
		mysqli_set_charset($conexion, 'utf8');
	}
        function conectarSQl()
        {
            global $conexionSQL;
            $host="192.168.0.104" ;
            $base="ICG"; 
            $usuario="sa"; 
            $password="Masterkey3033"; 
            //Conexión a SQL 
            $connection_string = "DRIVER={SQL Server};SERVER=$host;DATABASE=$base"; 
            $conexionSQL = odbc_connect($connection_string, $usuario, $password); 

                //Si falla la conexión, se muestra un mensaje de error 
                if ($conexionSQL){ 

                      echo "Connection established.";

                }else{
                    echo "sin Conexion";
                } 
           //odbc_close($conexionSQL);
                $buscar = "SELECT ARTICULOS.DESCRIPCION AS ARTICULO, 
                DEPARTAMENTO.DESCRIPCION AS DEPARTAMENTO, 
                SECCIONES.DESCRIPCION AS SECCION,
                FAMILIAS.DESCRIPCION AS FAMILIA,
                MARCA.DESCRIPCION AS MARCA,
                PRECIOSVENTA.PBRUTO AS PRECIO,
                ARTICULOSLIN.ULTIMOCOSTE AS COSTES,
                ARTICULOS.UNIDADMEDIDA AS UNIDADM
                FROM ARTICULOS 
                LEFT JOIN DEPARTAMENTO on ARTICULOS.DPTO = DEPARTAMENTO.NUMDPTO
                LEFT JOIN SECCIONES ON ARTICULOS.SECCION = SECCIONES.NUMSECCION
                LEFT JOIN FAMILIAS ON ARTICULOS.FAMILIA = FAMILIAS.NUMFAMILIA
                LEFT JOIN MARCA ON ARTICULOS.MARCA = MARCA.CODMARCA
                LEFT JOIN PRECIOSVENTA ON ARTICULOS.CODARTICULO = PRECIOSVENTA.CODARTICULO
                LEFT JOIN ARTICULOSLIN ON ARTICULOS.CODARTICULO = ARTICULOSLIN.CODARTICULO
                WHERE ARTICULOS.DESCATALOGADO='F' AND PRECIOSVENTA.IDTARIFAV='1'"; 
                
                $resultado = odbc_exec($conexionSQL, $buscar); 


                if (!$resultado) 
                {
                    exit("Error en la búsqueda"); 
                }
                else{ //Caso contrario, se imprimen los resultados de la consulta 
                    while (odbc_fetch_row($resultado))
                    { 
                        echo odbc_result($resultado, 'ARTICULO')."<br>"; 
                    } 
                } 

}          
                
        
                    

	function getTodasCategorias()
	{
		global $conexion;
		$respuesta = mysqli_query($conexion, "SELECT * FROM categorias");
		// return $respuesta->fetch_all();
		$respuestas_array = array();
		while ($fila = $respuesta->fetch_row())
		  $respuestas_array[] = $fila;
		return $respuestas_array;		
	}

	function getCategoriasPorUser()
	{
		global $conexion;
		$respuesta = mysqli_query($conexion, "SELECT C.categoria, C.descripcion, C.ruta FROM permisos P INNER JOIN categorias C ON P.ID_Categoria = C.ID_Categoria WHERE usuario =  '".$_SESSION['usuario']."'");		
		// return $respuesta->fetch_all();
		$respuestas_array = array();
		while ($fila = $respuesta->fetch_row())
		  $respuestas_array[] = $fila;
		return $respuestas_array;
	}

	function getCategoriaPorId($id)
	{
		global $conexion;
		$respuesta = mysqli_query($conexion, "SELECT * FROM categorias WHERE ID_Categoria =  ".$id);		
		return mysqli_fetch_row($respuesta);
	}

	function getUsuarios()
	{
		global $conexion;
		$respuesta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE admin<>1");		
		// return $respuesta->fetch_all();
		$respuestas_array = array();
		while ($fila = $respuesta->fetch_row())
		  $respuestas_array[] = $fila;
		return $respuestas_array;		
	}
	
	function validarLogin($usuario, $clave)
	{
		global $conexion;
		$consulta = "SELECT * FROM usuarios WHERE usuario='".$usuario."' AND clave='".$clave."'";
		$respuesta = mysqli_query($conexion, $consulta);
		
		if( $fila = mysqli_fetch_row($respuesta) )
		{
			session_start();
			$_SESSION['usuario'] = $usuario;
			$_SESSION['admin'] = $fila[2];
			return true;
		}
		return false;
	}

	function eliminarPermisos($usuario)
	{
		global $conexion;
		mysqli_query($conexion, "DELETE FROM permisos WHERE usuario='".$usuario."'");		
	}

	function asignarPermisos($usuario, $idCat)
	{
		global $conexion;
		mysqli_query($conexion, "INSERT INTO permisos VALUES('".$usuario."', ".$idCat.")");		
	}

	function tienePermiso($usuario, $idCat)
	{
		global $conexion;
		$result = mysqli_query($conexion, "SELECT COUNT(*) AS total FROM permisos WHERE usuario='".$usuario."' AND ID_Categoria=".$idCat);
		$row = mysqli_fetch_assoc($result);
		$numero = $row['total'];
		return $numero > 0;
	}

	function editarCategoria($id, $nombre, $descripcion, $ruta)
	{
		global $conexion;
		mysqli_query($conexion, "UPDATE categorias SET categoria='".$nombre."', descripcion='".$descripcion."', ruta='".$ruta."' WHERE ID_Categoria = ".$id);
	}

	function haIniciadoSesion()
	{
		session_start();
		return isset( $_SESSION['usuario'] );
	}

	function esAdmin()
	{
		return $_SESSION['admin'];
	}

	function desconectar()
	{
		global $conexion;
		mysqli_close($conexion);
	}



?>