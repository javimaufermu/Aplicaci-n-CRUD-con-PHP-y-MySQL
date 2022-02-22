<?php include("conn_db.php"); ?>

<?php include('includes/header.php'); 
include "Autenticacion/SeguridadUsuario.php";
?>

<main class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card card-body">
        <a href="agregar_dispositivo.php" class="btn btn-success">
          <label>Agregar Dispositivo &nbsp;</label>
          <i class="bi bi-plus-square"></i>
        </a>
      </div>
      <div class="card card-body">
        <form action="index.php" method="POST">
          <label>Seleccionar dispositivo</label>
          <div class="form-group">
            <select name="list_disp" class="form-select" aria-label="Default select example">
              <option selected>--</option>
              <?php
              $id_usuario=$_SESSION["id"];
              $query = "SELECT id, nombre FROM dispositivo WHERE id_usuario=$id_usuario";
              $result = mysqli_query($conn, $query);
              while($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
              }
              ?>
            </select>
          </div>
          <input type="submit" name="save_disp" class="btn btn-success btn-block" value="Aplicar">
        </form>
      </div>
    </div>
    <div class="col-md-9">
      <table class="table table-hover table-striped">
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
          if(isset($_POST['list_disp']) && $_POST['list_disp']<>"--") {
            $id = $_POST['list_disp'];
            $query = "SELECT *, dispositivo.id AS id_disp FROM dispositivo WHERE id=$id AND id_usuario=$id_usuario";
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
    <?php 
    if (isset($_GET["mensaje"]))
    {
    $mensaje = $_GET["mensaje"];
       if ($_GET["mensaje"]!=""){
         if($mensaje % 2 ==0) $color="red";
         else $color="blue";
   ?>
    
    <div style="color:<?php echo $color;?>; padding-top: 15px; font-size: 0.9rem;">
      <span>
      <?php 
      if ($mensaje == 1)
        echo "Dispositivo actualizado";
      if ($mensaje == 2)
        echo "Error al actualizar el dispositivo";
      if ($mensaje == 3)
        echo "Dispositivo agregado";
      if ($mensaje == 4)
        echo "Error al agregar dispositivo";
      ?>
      </span>                         
    </div>
          <?php 
              }
            }
          ?>
  </div>
</main>

<?php include('includes/footer.php'); ?>
