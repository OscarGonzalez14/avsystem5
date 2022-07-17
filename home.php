<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){   
require_once("header_dos.php");
 ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<div class="content-wrapper" style="background-color:white;">
	<div style="display:flex; align-items:center;justify-content: center;margin-top:8%;">
		<img src="images/logo.png" width="60%" >	
	</div>
	
<section style="margin-top:8%; text-align:center; background-color:rgb(232, 232, 232); border-radius:3px;">
<div style="padding:7px;">
	<p><strong>INDICACIONES INICIALES:</strong>
	Toda información a la cual se le brindará acceso queda bajo la responsabilidad del usuario, así tambien, cualquier operación generada dentro del sistema.
	Las operaciones realizadas en el sistema serán almacenadas y resguardadas de manera confidencial.
	Por tanto: No se admitirá el compartir usuarios ni claves de usuario, ya que tendrá una sanción total o parcial según la gravedad de la eventualidad.</P>
</div>
</section>
<?php 
require_once("footer.php");
 ?>
 <script type="text/javascript">

$(document).ready(indicaciones);

	const Toast = Swal.mixin({
    toast: true,
    position: 'center',
    showConfirmButton: false,
    timer: 5000
});

  function indicaciones(){
  	Swal.fire('Asegurese que el sistema se encuentra en modo incognito para un mejor funcionamiento','','info')
}
</script>
</div>



 <?php } else{
echo "Acceso denegado";
  } ?>