<?php include("conn_db.php"); ?>
<?php include('includes/header.php'); ?>

<main class="container" p4>
  <div class="row">
    <div class="col-md-3">
    <?php 
      if (isset($_SESSION["mensaje"])) {
        if ($_SESSION["mensaje"] != ""){ ?>
          <div class="alert alert-<?php echo $_SESSION['mss_color'];?> alert-dismissible fade show" role="alert">
            <span><?php echo $_SESSION['mensaje'];?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php }
        $_SESSION['mensaje'] = "";
      } ?>
      <div class="card card-body bg-light">
        <form action="parametros.php" method="POST">
          <label>Seleccionar dispositivo</label>
          <div class="form-group">
            <select name="list_disp" class="form-select" aria-label="Default select example" required>
              <option selected disabled value="">Selecione ...</option>
              <?php 
                $query = "SELECT DISTINCT dispositivo.id, nombre FROM dispositivo INNER JOIN parametros ON dispositivo.id=id_dispositivo WHERE id_usuario=$id_usuario";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
                }
              ?>
            </select><br>
            <select name="n_par" class="form-select" aria-label="Default select example">
              <option selected value="">Todo</option>
              <option value="50">100</option>
              <option value="50">50</option>
              <option value="20">20</option>
              <option value="10">10</option>
            </select>
          </div><br>
          <input type="submit" name="save_disp" class="btn btn-outline-primary btn-block" value="Aplicar">
        </form>
      </div>
    </div>
    <div class="col-md-9">
      <table class="table table-info table-striped text-center">
        <thead class="table-secondary">
          <tr>
            <th>Dispositivo</th>
            <th>Temperatura</th>
            <th>Humedad Suelo</th>
            <th>Humedad Ambiente</th>
            <th>Precipitaciones</th>
            <th>Intensidad Luz Solar</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th><i class="far fa-trash-alt"></i></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(isset($_POST['list_disp']) && isset($_POST['n_par'])) {
            $id = $_POST['list_disp'];
            $n_par = $_POST['n_par'];
            if ($n_par <> "") {
              $query = "SELECT * FROM parametros INNER JOIN dispositivo ON id_dispositivo=dispositivo.id WHERE dispositivo.id=$id AND id_usuario=$id_usuario LIMIT $n_par";
            } else {
              $query = "SELECT * FROM parametros INNER JOIN dispositivo ON id_dispositivo=dispositivo.id WHERE dispositivo.id=$id AND id_usuario=$id_usuario";
            }
          } else {
            $query = "SELECT * FROM parametros INNER JOIN dispositivo ON id_dispositivo=dispositivo.id WHERE id_usuario=$id_usuario";
          }
          $result = mysqli_query($conn, $query);
          while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['Nombre']; ?></td>
              <td><?php echo $row['Temperatura']; ?></td>
              <td><?php echo $row['Humedad_suelo']; ?></td>
              <td><?php echo $row['Humedad_ambiente']; ?></td>
              <td><?php echo $row['Precipitaciones']; ?></td>
              <td><?php echo $row['Intensidad_luz_solar']; ?></td>
              <td><?php echo $row['Fecha']; ?></td>
              <td><?php echo $row['Hora']; ?></td>
              <td>
                <a href="eliminar.php?id=<?php echo $row['Id']?>&tabla=parametros" class="btn btn-danger">
                  <i class="bi bi-trash3"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include('includes/footer.php'); ?>
