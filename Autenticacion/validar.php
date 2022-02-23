<?php
ob_start();

// PROGRAMA DE VALIDACION DE USUARIOS
$login = $_POST["login"];
$passwd = $_POST["passwd"];
$passwd = md5($passwd);

session_start();
include ("../conn_db.php");

$mysqli = $conn;

$sql = "SELECT * from Usuario where Usuario = '$login'";
$result1 = $mysqli->query($sql);
$row1 = $result1->fetch_array(MYSQLI_NUM);
$numero_filas = $result1->num_rows;
if ($row1[7] == 0)
    $numero_filas = 0;


if ($numero_filas > 0){

  $passwdc = $row1[6];
  if ($passwdc == $passwd) {//$passwd_comp para codificada
    $_SESSION["autenticado"]= "P5-4ut";
    $_SESSION["id"]= $row1[0];
    $_SESSION["tipo"]= $row1[1];
    $_SESSION["apellidos"]= $row1[2];
    $_SESSION["nombres"]= $row1[3];  
    $_SESSION["cedula"]= $row1[4];
    
    header("Location: ../index.php");
    
  }else {
    header('Location: ../inicio_sesion.php?mensaje=1'); //Contraseña incorrecta
  }
}else {
  header('Location: ../inicio_sesion.php?mensaje=2'); //Nombre de usuario inexistente o inactivo
}
ob_end_flush();
?>
