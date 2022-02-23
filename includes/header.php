<?php
  include('conn_db.php');
  include ('Autenticacion/SeguridadUsuario.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>APP CRUD PHP Y MYSQL</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  </head>
  <body>
    <nav class="navbar navbar-dark bg-secondary">
      <div class="container">
        <a class="navbar-brand" href="index.php">SISTEMA PROPERSEED</a>
        <a class="navbar-brand" href="rango_parametros.php">Rango de parametros</a>
        <a class="navbar-brand" href="parametros.php">Parámetros</a>
        <a class="navbar-brand" href="alertas.php">Alertas</a>
        <div class="text-end">
          <a class="navbar-brand fw-bold text-dark"><?php echo $_SESSION['nombres']; ?></a>
          <a href="Autenticacion/cerrar_sesion.php" class="btn btn-outline-danger">
            <i class='bi bi-power'></i>
          </a>
        </div>
      </div>
      
    </nav>
    <?php if(isset($_SESSION['id'])) {$id_usuario = $_SESSION['id']; }?>