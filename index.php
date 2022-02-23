<?php include('includes/header.php'); ?>

<main class="container">
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
        
        <a href="agregar_dispositivo.php" class="btn btn-success">
          <label>Agregar Dispositivo &nbsp;</label>
          <i class="bi bi-plus-square"></i>
        </a>
      </div>
      <div class="card card-body">
        <form action="index.php" method="POST">
          <label>Seleccionar dispositivo</label>
          <div class="form-group">
            <select name="list_disp" class="form-select bg-light" aria-label="Default select example" required>
              <option selected disabled value="">Seleccione ...</option>
              <option value="Activo">Activo</option>
              <option value="Inactivo">Inactivo</option>
            </select>
          </div><br>
          <input type="submit" name="save_disp" class="btn btn-outline-primary btn-block" value="Aplicar">
        </form>
      </div>
    </div>
    <div class="col-md-9">
      <table class="table table-hover text-center table-striped">
        <thead class="table-dark">
          <tr>
            <th>Dispositivo</th>
            <th>Estado</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Opciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(isset($_POST['list_disp']) && $_POST['list_disp']<>"") {
            $estado = $_POST['list_disp'];
            $query = "SELECT *, dispositivo.id AS id_disp FROM dispositivo WHERE estado='$estado' AND id_usuario=$id_usuario";
          } else {
            $query = "SELECT *, dispositivo.id AS id_disp FROM dispositivo WHERE id_usuario=$id_usuario";
          }
          $result = mysqli_query($conn, $query);
          while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['Nombre']; ?></td>
              <td><?php echo $row['Estado']; ?></td>
              <td><?php echo $row['Latitud']; ?></td>
              <td><?php echo $row['Longitud']; ?></td>
              <td>
                <a href="editar_dispositivo.php?id=<?php echo $row['id_disp']?>" class="btn btn-secondary">
                  <i class="bi bi-pencil-square"></i>
                </a>
                <a href="eliminar.php?id=<?php echo $row['id_disp']?>&tabla=dispositivo" class="btn btn-danger">
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
