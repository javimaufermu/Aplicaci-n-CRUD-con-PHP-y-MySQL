<?php
  include("conn_db.php");
  session_start();

  if(isset($_GET['id']) && isset($_GET['tabla'])) {
    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $query = "DELETE FROM $tabla WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if(!$result) {
      $_SESSION['mss_color'] = 'warning';
      $_SESSION['mensaje'] = 'Querry failed';
      header('Location: index.php');
    } else {
      $_SESSION['mss_color'] = 'danger';
      if ($tabla == "dispositivo") {
        $_SESSION['mensaje'] = 'Dispositivo eliminado';
        echo $_SESSION['mensaje'];
        header('Location: index.php');
      } else if ($tabla == "rango_parametros") {
        $_SESSION['mensaje'] = 'Rango eliminado';
        header('Location: rango_parametros.php');
      } else if ($tabla == "parametros") {
        $_SESSION['mensaje'] = 'Parámetro eliminado';
        header('Location: parametros.php');
      } else if ($tabla == "alerta") {
        $_SESSION['mensaje'] = 'Alerta eliminada';
        header('Location: alertas.php');
      }
    }
  }
?>