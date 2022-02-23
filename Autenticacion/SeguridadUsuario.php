<?php
  session_start();
  if (isset($_SESSION["autenticado"])) {
    if ($_SESSION["autenticado"] != "P5-4ut") {
      header('Location: inicio_sesion.php');  //Mensaje de que no se ha logueado
    }
  } else {
    header('Location: inicio_sesion.php');
  }
?>
