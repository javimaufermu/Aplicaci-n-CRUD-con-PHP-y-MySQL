<?php
  include("conn_db.php");
  session_start();

  if (isset($_POST['save_rango'])) {
    $temp_min = $_POST['temp_min'];
    $temp_max = $_POST['temp_max'];
    $humedad_min = $_POST['humedad_min'];
    $humedad_max = $_POST['humedad_max'];
    $luz_min = $_POST['luz_min'];
    $luz_max = $_POST['luz_max'];
    $hum_amb_min = $_POST['hum_amb_min'];
    $hum_amb_max = $_POST['hum_amb_max'];
    $query = "INSERT INTO rango_parametros
    (temperatura_max, temperatura_min, humedad_max, humedad_min, intensidad_luz_max, intensidad_luz_min, humedad_ambiente_max, humedad_ambiente_min)
    VALUES ($temp_max, $temp_min, $humedad_max, $humedad_min, $luz_max, $luz_min, $hum_amb_max, $hum_amb_min)";
    $result = mysqli_query($conn, $query);
    if(!$result) {
      $_SESSION['mss_color'] = 'warning';
      $_SESSION['mensaje'] = 'Error al eliminar rango';
    } else {
      $_SESSION['mss_color'] = 'success';
      $_SESSION['mensaje'] = 'Rango agregado';
    }
    header('Location: rango_parametros.php');
  }
?>
