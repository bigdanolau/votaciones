<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Votación</title>


<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/estilo.css" rel="stylesheet">


</head>


<style>

body{

background: tomato;
/*background-image: url(img/voto.png);*/


background-size: 100%;


}

.contenedor{

border-color: black;
border:20px;
margin-top: 20px;
margin: 50px auto;
border-radius: 10px;
margin-right: 25%;
margin-left: 25%;
width: 50%;
height: 550px;




}

.contenedor:hover{

transition: .8s;
background-color:rgba(0,0,0 ,.2);
box-shadow:inset;


}



</style>

<body>



<?php
      require_once("conexion.php");
    error_reporting(E_ALL ^ E_NOTICE);

     session_start();

if (isset($_GET["token"])) {
    $alumno = base64_decode($_GET["token"]);
    $sql_init="SELECT * FROM alumnos WHERE cedula_alumno = '$alumno'";
    $resultado_init=mysqli_query($cx, $sql_init);
    $datos_init=mysqli_fetch_array($resultado_init);
    $alu_init = $datos_init["cedula_alumno"];
    if ($alumno == $alu_init) {
        $sql="SELECT * FROM alumnos WHERE cedula_alumno = '$alumno' AND voto = '0'";
        $resultado=mysqli_query($cx, $sql);
        $datos=mysqli_fetch_array($resultado);
        $alu=$datos["cedula_alumno"];
        $nombre=$datos["nombre"];
        $voto=$datos["voto"];
        if ($alumno==$alu) {
            $_SESSION["nombre"]=$datos["nombre"];
            $_SESSION["carrera"]=$datos["carrera"];
            $_SESSION["cedula_alumno"]=$datos["cedula_alumno"];
            $_SESSION["permiso"]="Acceso Permitido";
            header("location: menu2.php");
        } else {
            $acceso="denegado";
        }
    } else {
        $acceso="no existe";
    }
} elseif (isset($_POST["boton"])) {
    if (isset($_POST["alumno"])) {
        $alumno=$_POST["alumno"];
    }

    $boton=$_POST["boton"];
    switch ($boton) {
        case "Ingresar":
        if (empty($alumno)) {
            $vacio="si";
            break;
        }

        $sql="SELECT * FROM alumnos WHERE cedula_alumno = '$alumno' AND voto = '0'";
        $resultado=mysqli_query($cx, $sql);
        $datos=mysqli_fetch_array($resultado);
        $alu=$datos["cedula_alumno"];
        $nombre=$datos["nombre"];
       $voto=$datos["voto"];

        if ($alumno==$alu) {
            $_SESSION["nombre"]=$datos["nombre"];
            $_SESSION["carrera"]=$datos["carrera"];
            $_SESSION["cedula_alumno"]=$datos["cedula_alumno"];
            $_SESSION["permiso"]="Acceso Permitido"; ?>
			<script>
			window.location="menu2.php";
			</script>
		<?php
            //header("location: principal.php");
        } else {
            $acceso="denegado";
        }
        break;

    }
}

?>
<div class="contenedor">
	<br><br><br><br><br>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1 class="text-center"><font color="white" size="7" face="Algerian">Elecciones 2021 Foco Rojo</h1></font><br>
    </div>
  </div>



	<center>
 <div class="center-block col-md-8 col-xs-8">
<form action="votar.php" role="form" method="post">
  <div class="form-group">
    <label for="alumno"><font color="white">Tarjeta de identidad del Alumno</font></label>
    <input type="text" name="alumno" class="form-control" id="alumno" placeholder="Identidad del Alumno">
  </div>
  <input type ="submit" class="btn btn-primary" name="boton" Value="Ingresar">
	<input type ="submit"  class="btn btn-danger" name="boton" Value="Cancelar">
</form>
<br>
<br>
<center><a href="admin.php"><button class="btn btn-warning">ADMINISTRADOR</button></a></center>
<br>
 <div align="center">
<?php
  if ($acceso=="denegado") {
      echo "<font size='5' color='white'>".$_SESSION["nombre"]."<br> Usted ya realizo su voto</font>";
  } elseif ($acceso=="no existe") {
      echo "<font size='5' color='white'>No se encontro el alumno en el sistema</font>";
  }
?>
	   </div>
</div>
</center>
</div>
</div>
<script src="js/jquery-1.11.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<center><font color="white" size="7" face="Algerian">VOTACIONES 2021</font></center>
</body>
</html>
