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


.boton{

float: right;

}

</style>


<body>
<?php
       require_once("conexion.php");
$vacio = isset($_POST['variable']) ? $_POST['variable'] : null ;
    $acceso = isset($_POST['variable']) ? $_POST['variable'] : null ;
     session_start();
 if (empty($acceso)) {
 }
 if (isset($_POST["usuario"])) {
     $usuario=$_POST["usuario"];
 }



if (isset($_POST["clave"])) {
    $clave=$_POST["clave"];
}
if (isset($_POST["boton"])) {
    $boton=$_POST["boton"];
    switch ($boton) {
        case "Ingresar":

        if (empty($usuario) && empty($clave)) {
            $vacio="si";
            break;
        }


        $sql="SELECT * FROM usuario WHERE usuario = '$usuario' AND clave = '$clave'";
        $resultado=mysqli_query($cx, $sql);
        $datos=mysqli_fetch_array($resultado);
        $usu=$datos["usuario"];
        $cla=$datos["clave"];


        if ($usuario==$usu and $clave==$cla) {
            $_SESSION["nombre"]=$datos["nombre"];
            $_SESSION["nivel"]=$datos["nivel"];
            $_SESSION["permiso"]="Acceso Permitido"; ?>
			<script>
			alert('ADMINISTADOR');
			window.location="menu.php";
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
	<div class="boton">
	<a href="votar.php"><button  class="btn btn-danger">X</button></a>
    </div>
	<br><br><br><br><br>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1 class="text-center"><font color="white" size="7" face="Algerian">Elecciones 2021 Foco Rojo</font></h1>
    </div>
  </div>


</div>

 <div class="center-block col-md-4 col-xs-8">
<form action="admin.php" role="form" method="post">
  <div class="form-group">
    <label for="Usuario"><font color="white">Usuario</font></label>
    <input type="text" name="usuario" class="form-control" id="usuario"
           placeholder="Usuario">
  </div>
  <div class="form-group">
    <label for="ejemplo_password_1"><font color="white">Contraseña</font></label>
    <input type="password" name="clave" class="form-control" id="ejemplo_password_1"
           placeholder="Contraseña">
  </div>


   <input type ="submit" class="btn btn-primary" name="boton" Value="Ingresar">
							 <input type ="submit"  class="btn btn-danger" name="boton" Value="Cancelar">
</form>
</div>
</div>
 <div align="center">
			<?php

            if ($acceso=="denegado") {
                echo "<h1>Acceso denegado.. Usuario o clave erronea...</h1>";
            }

            if ($vacio=="si") {
                echo "<h1>Debe ingresar Usuario y clave</h1>";
            }

            ?>

	   </div>

<script src="js/jquery-1.11.3.min.js"></script>


<script src="js/bootstrap.js"></script>
</body>
</html>
