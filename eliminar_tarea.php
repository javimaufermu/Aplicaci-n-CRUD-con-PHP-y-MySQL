<?php
include('conexion.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];
    //echo "Eliminando la tarea con id ". $id;
    $query = "DELETE FROM parametros WHERE Id = $id";

    $resultado = mysqli_query($conn, $query);
    if(!$resultado){
        die("Fallo eliminando la tarea");
    }
    header("Location: index.php");
}
?>