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
margin-right: 20%;
margin-left: 20%;
width: 60%;
height: 500px;




}

.contenedor:hover{

transition: .8s;
background-color:rgba(0,0,0 ,.2);
box-shadow:inset;


}



</style>

<body>
  <nav class="navbar navbar-default">
  <div class="container-fluid">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
     </div>

    <div class="collapse navbar-collapse" id="defaultNavbar1">
<div class="menu1 col-md-7 col-md-offset-3">
      <ul class="nav navbar-nav">
        <li class="active">
        <li><a href="alumnos.php">Agregar Alumno</a></li>
      <li><a href="candidato.php">Agregar Candidato</a></li>
        <li><a href="resultados.php">Resultados</a></li>
          <li><a href="votar.php">Votación</a></li>
      </ul>

  </div>
    </div>

  </div>

</nav>

<?php
   require_once("conexion.php");


        error_reporting(E_ALL ^ E_NOTICE);
$vacio = isset($_POST['variable']) ? $_POST['variable'] : null ;
    $acceso = isset($_POST['variable']) ? $_POST['variable'] : null ;
     session_start();
        $cedula=$_SESSION["cedula_alumno"];

 if (empty($acceso)) {
 }
  if (isset($_POST["id_carreras"])) {
      $id_carreras=$_POST["id_carreras"];
  } else {
      $id_carreras="";
  }
  if (isset($_POST["municipios"])) {
      $municipio=$_POST["municipios"];
  } else {
      $municipio="";
  }

if (isset($_POST["parroquias"])) {
    $parroquias=$_POST["parroquias"];
} else {
    $parroquias="";
}
       if (isset($_POST["nombre"])) {
           $nombre=$_POST["nombre"];
       } else {
           $nombre="";
       }

if (isset($_POST["cedula"])) {
    $cedula=$_POST["cedula"];
} else {
    $cedula="";
}
 if (isset($_POST["alumno"])) {
     $alumno=$_POST["alumno"];
 }
     if (isset($_POST["cod_candidato"])) {
         $cod_candidato=$_POST["cod_candidato"];
     }
     if (isset($_POST["cedula_alumno"])) {
         $alu=$_POST["cedula_alumno"];
     }


if (isset($_POST["boton"])) {
    $boton=$_POST["boton"];
    switch ($boton) {

        case "guardar":
             if (empty($municipio)) {
                 ?>

			<script>
			alert('Ingrese  el grado');
			</script>
			<?php

            break;
             }
            if (empty($cedula)) {
                ?>

			<script>
			alert('Ingrese su tarjeta de identidad');
			</script>
			<?php

            break;
            }
    if (! is_numeric($cedula)) {
        ?>

			<script>
			alert('Por favor colocar solo tarjeta de identidad');
			</script>
			<?php

            break;
    }
                        if (empty($nombre)) {
                            ?>

			<script>
			alert('ingrese Nombre y apellido');
			</script>
			<?php

            break;
                        }



        $sql="insert into alumnos (cedula_alumno,nombre,carrera,cod_candidato,voto) values ('$cedula','$nombre','$municipio','0','0') ";
        $resultado=mysqli_query($cx, $sql);
       if ($resultado) {
           $acceso="aprobado"; ?>


			<?php
       }
        $cedula="";
        $usuario="";
        $nombre="";
        $clave="";
        $nivel="";
    $clavev="";
        break;

  }
}

?>

<div class="contenedor">

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1 class="text-center"><font color="white" size="7" face="Algerian">Registro de alumnos</font></h1>
    </div>
  </div>

</div>

 <div class="center-block col-md-4 col-xs-8">

<form name ="acceso" action="alumnos.php" role="form" method="post">
  <div class="form-group">


<fieldset>
							<legend><em><strong><font color="white" >Selecione el grado</font></strong></em></legend>
						<?php

                            $sql="select * from carreras";
                            $resultado=mysqli_query($cx, $sql);
                            $num_reg=mysqli_num_rows($resultado);
                        ?>
							<select name="municipios" onchange="submit();">

							<option value="" >Selecione el grado</option>
							<?php
                                for ($i=0;$i<$num_reg;$i++) {
                                    $reg=mysqli_fetch_array($resultado);
                                    $codigomun=$reg["carreras"];
                                    $carreras=$reg["carreras"]; ?>
								<option value="<?php echo $codigomun; ?>"<?php if ($municipio==$codigomun) {
                                        echo "selected='selected'";
                                    } ?>><?php echo $carreras; ?></option>

							<?php
                                }

                            ?>
						</select>
					</fieldset>

					<br>
  <div class="form-group">
    <label for="Usuario"><font color="white" size="4">Tarjeta de identidad</font></label>
    <input type="text" name="cedula" class="form-control" id="cedula" placeholder="">
  </div>
  <div class="form-group">
    <label for="ejemplo_password_1"><font color="white" size="4"><center>Nombre y apellido</center></font></label>
    <input type="text" name="nombre" class="form-control" id="nombre"  placeholder="">
  </div>

<?php

    ?>
<br> <input type ="submit" class="btn btn-primary" name="boton" Value="guardar">


							 <input type ="submit"  class="btn btn-danger" name="boton" Value="Cancelar">
</form>
<?php
            if ($acceso=="aprobado") {
                echo '<script>alert("Alumno guardado correctamente")</script> ';
            }
    ?>

</div>
</div>

<script src="js/jquery-1.11.3.min.js"></script>

<script src="js/bootstrap.js"></script>
</body>
</html>
