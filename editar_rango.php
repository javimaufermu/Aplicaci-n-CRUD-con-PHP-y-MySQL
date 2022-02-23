<?php include("conn_db.php"); ?>
<?php include('includes/header.php'); ?>

<?php
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM rango_parametros WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result);
      $temp_min = $row['Temperatura_min'];
      $temp_max = $row['Temperatura_max'];
      $humedad_min = $row['Humedad_min'];
      $humedad_max = $row['Humedad_max'];
      $luz_min = $row['Intensidad_luz_min'];
      $luz_max = $row['Intensidad_luz_max'];
      $hum_amb_min = $row['Humedad_ambiente_min'];
      $hum_amb_max = $row['Humedad_ambiente_max'];
    }
  }
  if(isset($_POST['update_rango'])) {
    $id = $_GET['id'];
    $temp_min = $_POST['temp_min'];
    $temp_max = $_POST['temp_max'];
    $humedad_min = $_POST['humedad_min'];
    $humedad_max = $_POST['humedad_max'];
    $luz_min = $_POST['luz_min'];
    $luz_max = $_POST['luz_max'];
    $hum_amb_min = $_POST['hum_amb_min'];
    $hum_amb_max = $_POST['hum_amb_max'];
    $query = "UPDATE rango_parametros SET temperatura_min=$temp_min, temperatura_max=$temp_max, 
    humedad_min=$humedad_min, humedad_max=$humedad_max, intensidad_luz_min=$luz_min, 
    intensidad_luz_max=$luz_max, humedad_ambiente_min=$hum_amb_min, humedad_ambiente_max=$hum_amb_max WHERE Id='$id'";
    $result = mysqli_query($conn, $query);
    if(!$result) {
      $_SESSION['mss_color'] = 'danger';
      $_SESSION['mensaje'] = 'Error al editar rango';
    } else {
      $_SESSION['mss_color'] = 'success';
      $_SESSION['mensaje'] = 'Rango actualizado';
    }
    header('Location: rango_parametros.php');
  }
?>

<main class="container" p-4>
  <div class="col-md-5 mx-auto">
    <h3 class="text-start">Editar Rango</h3>
    <form action="editar_rango.php?id=<?php echo $_GET['id']; ?>" method="POST">
      <label class="text-dark fw-bold">Temperatura</label><br>
      <div class="input-group mb-3">
        <span class="input-group-text">Mín</span>
        <input name="temp_min" type="text" value="<?php echo $temp_min ?>" class="form-control" required>
        <span class="input-group-text">Máx</span>
        <input name="temp_max" type="text" value="<?php echo $temp_max ?>" class="form-control" required>
      </div>
      <label class="text-dark fw-bold">Humedad</label><br>
      <div class="input-group mb-3">
        <span class="input-group-text">Mín</span>
        <input name="humedad_min" type="text" value="<?php echo $humedad_min ?>" class="form-control" required>
        <span class="input-group-text">Máx</span>
        <input name="humedad_max" type="text" value="<?php echo $humedad_max ?>" class="form-control" required>
      </div>
      <label class="text-dark fw-bold">Intesidad de Luz</label><br>
      <div class="input-group mb-3">
        <span class="input-group-text">Mín</span>
        <input name="luz_min" type="text" value="<?php echo $luz_min ?>" class="form-control" required>
        <span class="input-group-text">Máx</span>
        <input name="luz_max" type="text" value="<?php echo $luz_max ?>" class="form-control" required>
      </div>
      <label class="text-dark fw-bold">Humedad Ambiente</label><br>
      <div class="input-group mb-3">
        <span class="input-group-text">Mín</span>
        <input name="hum_amb_min" type="text" value="<?php echo $hum_amb_min ?>" class="form-control" required>
        <span class="input-group-text">Máx</span>
        <input name="hum_amb_max" type="text" value="<?php echo $hum_amb_max ?>" class="form-control" required>
      </div><br>
      <input type="submit" name="update_rango" class="btn btn-primary btn-block" value="Actualizar Rango">
      <a href="rango_parametros.php" class="btn btn-warning">
        Cancelar
      </a>
    </form>
  </div>
</main>

<?php include('includes/footer.php'); ?>
