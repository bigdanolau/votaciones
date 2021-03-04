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
        <li><a href="alumnos.php">Cargar  Alumnos</a></li>
      <li><a href="candidato.php">Cargar candidato</a></li>
        <li><a href="resultados.php">Resultados</a></li>
          <li><a href="index.php">Votación</a></li>
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
     $carrera=$_SESSION["carrera"];
 if (empty($acceso)) {
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

if (isset($_POST["cedula_candidato"])) {
    $cedula_candidato=$_POST["cedula_candidato"];
} else {
    $cedula_candidato="";
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
        case "votar":


        $sql="update alumnos set voto='1', cod_candidato='$municipio' where cedula_Alumno='$cedula'";
        $resultado=mysqli_query($cx, $sql);
        $nr=mysqli_affected_rows($resultado);
            echo $nr;
        if ($nr >= 1) {
            ?>
			<script>
				alert ('');
			</script>
		<?php
        echo $alu;
        }


        break;

}
}

?>
<div class="contenedor">

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <h1 class="text-center"><font color="white" size="7" face="Algerian">RESULTADO DE VOTACIONES</font></h1>
    </div>
  </div>

</div>

 <div class="center-block col-md-8 col-xs-8">

<form name ="acceso" action="resultados.php" role="form" method="post">
  <div class="form-group">


 <fieldset>
							<legend><em><strong><font color="white" >Resultado de las votaciones</font></strong></em></legend>
						<?php

                            $sql="select * from carreras";
                            $resultado=mysqli_query($cx, $sql);
                            $num_reg=mysqli_num_rows($resultado);
                        ?>
							<select name="municipios" onchange="submit();">
							<option value="" >Seleccione Su Carrera  a  buscar </option>
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

<table class="table table-hover table-striped text-center"border="1" cellspacing=1 cellpadding=2 style="font-size: 8pt">
<thead>
<tr>
<td><font face="verdana"><b>Identidad del candidato</b></font></td>
<td><font face="verdana"><b>Nombre</b></font></td>
<td><font face="verdana"><b>Grado</b></font></td>
<td><font face="verdana"><b>Votos</b></font></td>
</tr>
    </thead>
<div class="tabla">
<?php


  $sql = "SELECT * from votos where carrera ='$municipio' ORDER BY votos DESC ";
$resultado=mysqli_query($cx, $sql);
  $numero = 0;
  while ($row = mysqli_fetch_array($resultado)) {
      echo "<tr><td width=\"80%\"><font face=\"verdana\">" .
        $row["cod_candidato"] . "</font></td>";
      echo "<td width=\"80%\"><font face=\"verdana\">" .
        $row["nombre"] . "</font></td>";
      echo "<td width=\"80%\"><font face=\"verdana\">" .
        $row["carrera"] . "</font></td>";
      echo "<td width=\"80%\"><font face=\"verdana\">" .
        $row["votos"]. "</font></td></tr>";
      $numero++;
  }


  mysqli_free_result($resultado);
  mysqli_close($cx);
?>
</table>


</form>




</div>
</div>
</div>

<script src="js/jquery-1.11.3.min.js"></script>

<script src="js/bootstrap.js"></script>
</body>
</html>
