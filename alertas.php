<?php include("conn_db.php"); ?>

<?php include('includes/header.php'); ?>

<main class="container" p4>
  <div class="row">
    <div class="col-md-3">
      <div class="card card-body">
        <form action="alertas.php" method="POST">
          <label>Seleccionar Variable</label>
          <div class="form-group">
            <select name="list_var" class="form-select" aria-label="Default select example">
              <option selected disabled value="">Selecione ...</option>
              <?php 
                $query = "SELECT DISTINCT variable FROM dispositivo INNER JOIN alerta ON id_dispositivo=dispositivo.id";
                $result = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($result)) {
                  echo '<option value="' . $row['variable'] . '">' . $row['variable'] . '</option>';
                }
              ?>
            </select>
          </div>
          <input type="submit" name="save_disp" class="btn btn-success btn-block" value="Aplicar">
        </form>
      </div>
    </div>
    <div class="col-md-9">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Dispositivo</th>
            <th>Variable</th>
            <th>Tipo</th>
            <th>Valor</th>
            <th>Máx</th>
            <th>Mín</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(isset($_POST['list_var']) && $_POST['list_var']<>"") {
            $variable = $_POST['list_var'];
            $query = "SELECT *, alerta.id AS id_alerta FROM alerta INNER JOIN dispositivo ON id_dispositivo=dispositivo.id WHERE variable='$variable'";
          } else {
            $query = "SELECT *, alerta.id AS id_alerta FROM alerta INNER JOIN dispositivo ON id_dispositivo=dispositivo.id";
          }
          $result = mysqli_query($conn, $query);
          while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
              <td><?php echo $row['Nombre']; ?></td>
              <td><?php echo $row['Variable']; ?></td>
              <td><?php echo $row['Tipo']; ?></td>
              <td><?php echo $row['Valor']; ?></td>
              <td><?php echo $row['Maximo']; ?></td>
              <td><?php echo $row['Minimo']; ?></td>
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
