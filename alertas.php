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
        <form action="alertas.php" method="POST">
          <label for="list_var">Seleccionar Variable</label>
          <div class="form-group">
            <select name="list_var" class="form-select" aria-label="Default select example" required>
              <option selected disabled value="">Selecione ...</option>
              <?php 
                $query = "SELECT DISTINCT variable FROM dispositivo INNER JOIN alerta ON id_dispositivo=dispositivo.id WHERE id_usuario=$id_usuario";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['variable'] . '">' . $row['variable'] . '</option>';
                }
              ?>
            </select><br>
            <select name="n_var" class="form-select" aria-label="Default select example">
              <option selected value="">Todo</option>
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
      <table class="table table-success table-striped text-center">
        <thead class="table-warning">
          <tr>
            <th>Dispositivo</th>
            <th>Variable</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Mín</th>
            <th>Máx</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(isset($_POST['list_var']) && isset($_POST['n_var'])) {
            $variable = $_POST['list_var'];
            $n_var = $_POST['n_var'];
            if ($n_var <> "") {
              $query = "SELECT *, alerta.id AS id_alerta FROM alerta INNER JOIN dispositivo ON id_dispositivo=dispositivo.id WHERE variable='$variable' AND id_usuario=$id_usuario LIMIT $n_var";
            } else {
              $query = "SELECT *, alerta.id AS id_alerta FROM alerta INNER JOIN dispositivo ON id_dispositivo=dispositivo.id WHERE variable='$variable' AND id_usuario=$id_usuario";
            }
          } else {
            $query = "SELECT *, alerta.id AS id_alerta FROM alerta INNER JOIN dispositivo ON id_dispositivo=dispositivo.id WHERE id_usuario=$id_usuario";
          }
          $result = mysqli_query($conn, $query);
          while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['Nombre']; ?></td>
              <td><?php echo $row['Variable']; ?></td>
              <td><?php echo $row['Tipo']; ?></td>
              <td><?php echo $row['Valor']; ?></td>
              <td><?php echo $row['Minimo']; ?></td>
              <td><?php echo $row['Maximo']; ?></td>
              <td><?php echo $row['Fecha']; ?></td>
              <td><?php echo $row['Hora']; ?></td>
              <td>
                <a href="eliminar.php?id=<?php echo $row['id_alerta']?>&tabla=alerta" class="btn btn-danger">
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
