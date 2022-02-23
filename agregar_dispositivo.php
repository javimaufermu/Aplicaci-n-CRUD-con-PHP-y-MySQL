<?php include("conn_db.php"); ?>

<?php include('includes/header.php'); ?>

<?php
  if(isset($_POST['save_disp'])) {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $id_rango = $_POST['rango'];
    $query = "INSERT INTO dispositivo(Estado, Nombre, Latitud, Longitud, Id_usuario, Id_rango) VALUES ('$estado', '$nombre', '$latitud', '$longitud', '$id_usuario', '$id_rango')";
    $result = mysqli_query($conn, $query);
    if(!$result) {
      $_SESSION['mss_color'] = 'danger';
      $_SESSION['mensaje'] = 'Error al agregar dispositivo';
    } else {
      $_SESSION['mss_color'] = 'success';
      $_SESSION['mensaje'] = 'Dispositivo agregado';
    }
    header('Location: index.php');
  }
?>

<main class="container" p-4>
  <div class="col-md-5 mx-auto">
    <h3>Nuevo Dispositivo</h3>
    <form action="agregar_dispositivo.php" method="POST">
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nombre:</span>
        <input name="nombre" type="text" class="form-control" id="validationDefault01" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Estado:</span>
        <select name="estado" class="form-select form-select-sm" aria-label=".form-select-sm example" id="validationDefault02" required>
          <option selected disabled value="">Seleccione ...</option>
          <option value="Activo">Activo</option>
          <option value="Inactivo">Inactivo</option>
        </select>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Latitud:</span>
        <input name="latitud" type="number" step="0.00001" class="form-control" id="validationDefault03" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Longitud:</span>
        <input name="longitud" type="number" step="0.00001" class="form-control" id="validationDefault04" required>
      </div>
      <div class="form-group">
        <label for="rango">Rango: </label>
        <select name="rango" class="form-select form-select-sm" aria-label=".form-select-sm example" id="validationDefault05" required>
          <option selected disabled value="">Selecione ...</option>
          <?php
            $query = "SELECT * FROM rango_parametros";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
              echo '<option value="' . $row['Id'] . 
              '">Temp('.$row['Temperatura_min'].' - ' . $row['Temperatura_max'] . '), ' . 
              'Humedad('.$row['Humedad_min'].' - ' . $row['Humedad_max'] . '), ' . 
              'IntLuz('.$row['Intensidad_luz_min'].' - ' . $row['Intensidad_luz_max'] . '), ' . 
              'HumAmbiente('.$row['Humedad_ambiente_min'].' - ' . $row['Humedad_ambiente_max'] . ')</option>';
            }
          ?>
        </select>
      </div><br>
      <input type="submit" name="save_disp" class="btn btn-primary btn-block" value="Agregar Dispositivo">
      <a href="index.php" class="btn btn-warning">
        Cancelar
      </a>
    </form>
  </div>
</main>

<?php include('includes/footer.php'); ?>
