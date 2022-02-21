<?php
//Antes que todo hay que incluir la conexión para que esté disponible en la página
include('conexion.php');
include "Autenticacion/SeguridadUsuario.php"; 
$mysqli=$conn;
?>
<!DOCTYPE html>
<html lang="es">
<head>
<link href="Estilo.css" rel="stylesheet" type="text/css"/> 
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	  <script src="https://kit.fontawesome.com/a81368914c.js"></script> 
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskManager CRUD con PHP y MySQL</title>
</head>
<body>
<?php include "Panel/PanelUsuario.php";?> <!-- Esto carga el panel superior e izquierdo del agricultor -->
    <form action="guardar_tarea.php" method="POST">
        <label for="lnombre">Nombre Dispositivo:</label><br>
        <input type="text" id="nombre_disp" name="nombre_disp"><br>
        <label for="llatitud">Latitud</label><br>
        <input type="text" id="latitud" name="latitud"><br>
        <label for="llongitud">Longitud</label><br>
        <input type="text" id="longitud" name="longitud"><br>            
        <button name="bt_guardar_tarea" type="submit" value="Guardar Tarea">Guardar Nuevo Dispositivo</button>
    </form>
    <table border="1" cellpadding="2">
        <thead>
            <tr>
                <th>Temperatura</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Opción</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM parametros LIMIT 5";
                $resultado = mysqli_query($conn, $query);
                while($fila = mysqli_fetch_array($resultado)){?>
                    <tr>
                        <td><?php echo $fila['Temperatura'] ?></td>
                        <td><?php echo $fila['Fecha'] ?></td>
                        <td><?php echo $fila['Hora'] ?></td>
                        <td>
                            <a href="editar_tarea.php?id=<?php echo $fila['Id'] ?>">Editar</a>
                            <a href="eliminar_tarea.php?id=<?php echo $fila['Id'] ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>            
        </tbody>
    </table>
</body>
</html>