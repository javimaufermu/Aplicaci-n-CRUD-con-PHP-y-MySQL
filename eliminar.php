<?php
  include("conn_db.php");

  if(isset($_GET['id']) && isset($_GET['tabla'])) {
    $id = $_GET['id'];
    $tabla = $_GET['tabla'];
    $query = "DELETE FROM $tabla WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    if(!$result) {
      die("Query Failed.");
    }/*
    $_SESSION['message'] = 'Task Removed Successfully';
    $_SESSION['message_type'] = 'danger';
    */
    header('Location: index.php');
  }
?>