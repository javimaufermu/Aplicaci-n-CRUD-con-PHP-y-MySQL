<?php
include("conexion.php");
include "Autenticacion/SeguridadUsuario.php"; 
//verifica si llegó a la página presionando el botón guardar

if(isset($_POST['bt_guardar_tarea'])){
    //Captura el título y la descrpción enviados por el método POST
    $nombre = $_POST['nombre_disp'];
    $latitud = $_POST['latitud'];
    $longitud = $_POST['longitud'];
    $id_usuario = $_SESSION["id"];
    $estado = "Activo";
    $id_rango = 1;    
    
    //Realiza la inserción del nuevo dato (nótese el udo de \' para poder colocar las comillas simples necesarias en la sentencia SQL)    
    $query = 'INSERT INTO dispositivo (Estado, Nombre, Latitud, Longitud, Id_usuario, Id_rango) VALUES
    (\''.$estado.'\',\''.$nombre.'\',\''.$latitud.'\',\''.$longitud.'\',\''.$id_usuario.'\',\''.$id_rango.'\')';

    //Ejecuta la consulta
    mysqli_query($conn, $query);
   
    //Con este comando retorna a la página pricipal y muestra los datos actualizados de la nueva tarea
    header("Location: index.php");
}

?>