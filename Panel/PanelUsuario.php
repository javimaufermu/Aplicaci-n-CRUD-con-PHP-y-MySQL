<?php 
    echo "
    <nav class=\" Nav \" >
      <div class=\"FondoNav\"><img src=\"img/cesped.jpg\"></div> 

      <div class=\"Logo\">
        <p>ApliWeb</p>
      </div>

      <div class=\"BarraNavegacion\">      
          <button class=\"btn\" onclick=\"window.location.href='/Autenticacion/cerrar_sesion.php'\">
            <i class=\"fas fa-microchip\"></i>
            <span>Opción 1</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='index.php'\">
            <i class=\"fas fa-history\"></i>
            <span>Opción 2</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='index.php'\">
            <i class=\"fas fa-calendar-check\"></i>
            <span>Opción 3</span>
          </button>
          <button class=\"btn\" onclick=\"window.location.href='index.php'\">
            <i class=\"fas fa-chart-line\"></i>
            <span>Opción 4</span>
          </button>          
      </div> 
      </div> 
    </nav>

    <section class=\"Section\">
      <div class=\"Header\" align=\"right\" >
        <h2>Usuario</h2>";
        $id_usuario=$_SESSION["id"];                        
        echo "<a>".$_SESSION["nombres"]."</a>";
        
        echo "<i class=\"fas fa-power-off\" title=\"Cerrar Sesión\" onclick=\"window.location.href='/Autenticacion/cerrar_sesion.php'\"></i>
      </div>
      
      
    ";
?>