<?php
  // PROGRAMA DE FINALIZACION DE SESION
  session_start();
  $_SESSION = array();
  session_destroy();        
  ob_start();
  header('Location: ../inicio_sesion.php');
  ob_end_flush();
?>
