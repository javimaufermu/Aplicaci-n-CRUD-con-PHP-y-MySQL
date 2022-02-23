<?php include("conn_db.php"); ?>
<?php include('includes/header.php'); ?>

<main class="container">
  <div class="row">
    <div class="card card-body bg-light border-dark">
      <h4 class="text-center fw-bold">Nuevo Rango</h4>
      <form class="row g-3 needs-validation" action="agregar_rango.php" method="POST">
        <div class="col-md-3">
          <label class="text-dark fw-bold">Temperatura</label><br>
          <div class="input-group">
            <span class="input-group-text">Mín</span>
            <input name="temp_min" type="number" class="form-control" required>
            <span class="input-group-text">Máx</span>
            <input name="temp_max" type="number" class="form-control" required>
          </div>
        </div>
        <div class="col-md-3">
          <label class="text-dark fw-bold">Humedad</label><br>
          <div class="input-group">
            <span class="input-group-text">Mín</span>
            <input name="humedad_min" type="number" class="form-control" required>
            <span class="input-group-text">Máx</span>
            <input name="humedad_max" type="number" class="form-control" required>
          </div>
        </div>
        <div class="col-md-3">
          <label class="text-dark fw-bold">Intensidad de Luz</label><br>
          <div class="input-group">
            <span class="input-group-text">Mín</span>
            <input name="luz_min" type="number" class="form-control" required>
            <span class="input-group-text">Máx</span>
            <input name="luz_max" type="number" class="form-control" required>
          </div>
        </div>
        <div class="col-md-3">
          <label class="text-dark fw-bold">Humedad Ambiente</label><br>
          <div class="input-group">
            <span class="input-group-text">Mín</span>
            <input name="hum_amb_min" type="number" class="form-control" required>
            <span class="input-group-text">Máx</span>
            <input name="hum_amb_max" type="number" class="form-control" required>
          </div>
        </div>
        <div class="col-md-2">
          <input type="submit" name="save_rango" class="btn btn-outline-primary btn-block" value="Agregar Rango">
        </div>
        <div class="col-md-3">
          <?php 
          if (isset($_SESSION["mensaje"])) {
            if ($_SESSION["mensaje"] != ""){ ?>
              <div class="alert alert-<?php echo $_SESSION['mss_color'];?> alert-dismissible fade show fw-bold" role="alert">
                <span><?php echo $_SESSION['mensaje'];?></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php }
            $_SESSION['mensaje'] = "";
          } ?>
        </div>
      </form>
    </div>
  </div><br>
  <div class="row">
    <table class="table table-bordered border-warning text-center table-striped">
      <thead class="table-primary">
        <tr>
          <th colspan="2">Temperatura</th>
          <th colspan="2">Humedad</th>
          <th colspan="2">Intensidad de Luz</th>
          <th colspan="2">Humedad Ambiente</th>
          <th rowspan="2">Opciones</th>
        </tr>
        <tr>
          <th>Mínima</th>
          <th>Máxima</th>
          <th>Mínima</th>
          <th>Máxima</th>
          <th>Mínima</th>
          <th>Máxima</th>
          <th>Mínima</th>
          <th>Máxima</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if(isset($_POST['list_disp']) && $_POST['list_disp']<>"--") {
          $id = $_POST['list_disp'];
          $query = "SELECT * FROM rango_parametros WHERE id=$id";
        } else {
          $query = "SELECT * FROM rango_parametros";
        }
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['Temperatura_min']; ?></td>
            <td><?php echo $row['Temperatura_max']; ?></td>
            <td><?php echo $row['Humedad_min']; ?></td>
            <td><?php echo $row['Humedad_max']; ?></td>
            <td><?php echo $row['Intensidad_luz_min']; ?></td>
            <td><?php echo $row['Intensidad_luz_max']; ?></td>
            <td><?php echo $row['Humedad_ambiente_min']; ?></td>
            <td><?php echo $row['Humedad_ambiente_max']; ?></td>
            <td>
              <a href="editar_rango.php?id=<?php echo $row['Id']?>" class="btn btn-secondary">
                <i class="bi bi-pencil-square"></i>
              </a>
              <a href="eliminar.php?id=<?php echo $row['Id']?>&tabla=rango_parametros" class="btn btn-danger">
              <i class="bi bi-trash3"></i>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>

<?php include('includes/footer.php'); ?>
