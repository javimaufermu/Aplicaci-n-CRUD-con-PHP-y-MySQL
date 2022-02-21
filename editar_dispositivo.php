<?php include("conn_db.php"); ?>

<?php include('includes/header.php'); ?>

<?php
  if (isset($_GET['id'])) {
    $id=$_GET['id'];
    $query = "SELECT * FROM dispositivo WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) == 1) {
      $row = mysqli_fetch_array($result);
      $nombre = $row['Nombre'];
      $estado = $row['Estado'];
      $latitud = $row['Latitud'];
      $longitud = $row['Longitud'];
      $id_rango = $row['Id_rango'];
    }
  }
  if(isset($_POST['save_disp'])) {
    $nombre = $_POST['nombre'];
    $estado = $_POST['estado'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $id_rango = $_POST['rango'];
    $query = "UPDATE dispositivo SET Estado='$estado', Nombre='$nombre', Latitud='$latitud', Longitud='$longitud', Id_rango='$id_rango')";
    $result = mysqli_query($conn, $query);
    echo "dato enviado";
    if(!$result) { die("Query Failed."); }
    header('Location: index.php');
  }
?>

<main class="container" p-4>
  <div class="col-md-5 mx-auto">
    <h3>Editar Dispositivo</h3>
    <form action="agregar_dispositivo.php?id=<?php echo $_GET['id']; ?>" method="POST">
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nombre:</span>
        <input name="nombre" type="text" value="<?php echo $nombre ?>" class="form-control" id="validationDefault01" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Estado:</span>
        <select name="estado" class="form-select form-select-sm" aria-label=".form-select-sm example" id="validationDefault02" required>
          <option selected disabled value="">Seleccione ...</option>
          <?php 
            if($estado == "Activo") {
              echo '<option value="Activo" selected>Activo</option>';
              echo '<option value="Inactivo">Inactivo</option>';
            } else {
              echo '<option value="Activo">Activo</option>';
              echo '<option value="Inactivo" selected>Inactivo</option>';
            }
          ?>
        </select>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Latitud:</span>
        <input name="latitud" type="number" step="0.000001" value="<?php echo $latitud ?>" class="form-control" id="validationDefault03" required>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Longitud:</span>
        <input name="longitud" type="number" step="0.000001" value="<?php echo $longitud ?>" class="form-control" id="validationDefault04" required>
      </div>
      <div class="form-group">
        <label for="rango">Rango: </label>
        <select name="rango" class="form-select form-select-sm" aria-label=".form-select-sm example" id="validationDefault05" required>
          <option selected disabled value="">Selecione ...</option>
          <?php
            $query = "SELECT * FROM rango_parametros";
            $result = mysqli_query($conn, $query);
            while($row = mysqli_fetch_assoc($result)) {
              if ($row['Id'] == $id_rango) {
                echo '<option value="' . $row['Id'] . 
                '" selected>Temp('.$row['Temperatura_min'].' - ' . $row['Temperatura_max'] . '), ' . 
                'Humedad('.$row['Humedad_min'].' - ' . $row['Humedad_max'] . '), ' . 
                'IntLuz('.$row['Intensidad_luz_min'].' - ' . $row['Intensidad_luz_max'] . '), ' . 
                'HumAmbiente('.$row['Humedad_ambiente_min'].' - ' . $row['Humedad_ambiente_max'] . ')</option>';
              } else {
                echo '<option value="' . $row['Id'] . 
                '">Temp('.$row['Temperatura_min'].' - ' . $row['Temperatura_max'] . '), ' . 
                'Humedad('.$row['Humedad_min'].' - ' . $row['Humedad_max'] . '), ' . 
                'IntLuz('.$row['Intensidad_luz_min'].' - ' . $row['Intensidad_luz_max'] . '), ' . 
                'HumAmbiente('.$row['Humedad_ambiente_min'].' - ' . $row['Humedad_ambiente_max'] . ')</option>';
              }
            }
          ?>
        </select>
      </div><br>
      <input type="submit" name="update_disp" class="btn btn-primary btn-block" value="Actualizar Dispositivo">
      <a href="index.php" class="btn btn-warning">
        Cancelar
      </a>
    </form>
  </div>
</main>

<?php include('includes/footer.php'); ?>
