<?php
include('conexion.php');
//CAPTURA LOS VALORES QUE TINENE EL ARREGLO GET
if(isset($_GET['id'])){
    $id = $_GET['id'];
    
    $query = "SELECT * FROM parametros WHERE Id = $id";

    $resultado = mysqli_query($conn, $query);
    if(mysqli_num_rows($resultado)==1){
        $fila = mysqli_fetch_array($resultado);
        $titulo = $fila['Temperatura'];
        $descripcion = $fila['Humedad_suelo'];
    }
}
//CAPTURA LOS VALORES QUE TINENE EL ARREGLO POST
if(isset($_POST['bt_actualizar'])){
    $id = $_GET['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $query = "UPDATE parametros SET Temperatura = '$titulo', Humedad_suelo = '$descripcion' WHERE Id = $id";

    mysqli_query($conn, $query);
    header("Location: index.php");
}
?>
<form action="editar_tarea.php?id=<?php echo $_GET['id'] ?>" method="POST">
    <label for="ltitulo">Título:</label><br>
    <input type="text" id="titulo" name="titulo" value="<?php echo $titulo ?>"><br>
    <label for="ldescripcion">Descripción:</label><br>
    <textarea name="descripcion" cols="30" rows="2"><?php echo $descripcion ?></textarea><br>
    <button name="bt_actualizar" type="submit">Actualizar Tarea</button>
</form>