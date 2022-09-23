<?php 
require_once("config/conexion.php");
if(isset($_SESSION["usuario"])){ 
    require_once('header_dos.php');
    date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
?>

 <style type="text/css">
    .dataTables_filter {
   float: right !important;
   width: 100%;
}
.eight h1 {
    color: #003399;
    font-weight: 600;
    text-align:center; 
    text-transform:uppercase;
    font-size:14px; letter-spacing:1px;  
    display: grid;
    grid-template-columns: 1fr auto 1fr;
    grid-template-rows: 16px 0;
    grid-gap: 22px;
  }

  .eight h1:after,.eight h1:before {
   content: "";
   display: block;
   border-bottom: 2px solid #ccc;
   background-color:#f8f8f8; 
  }

</style>

<div class="content-wrapper">
<input type="hidden" name="cat_user" id="cat_user" value="<?php echo $cat_user;?>"/>
    <section class="content" style="border-right:50px">
    <div class="container-fluid">

<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Nueva Factura
</button>
    
<input type="hidden" name="sucursal" id="sucursal" value="<?php echo $_SESSION["sucursal"];?>"/>
<input type="hidden" name="sucursal_usuario" id="sucursal_usuario" value="<?php echo $_SESSION["sucursal_usuario"];?>"/>
<input type="hidden" name="usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"];?>"/>
<?php date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");?>
<input type="hidden" id="fecha" value="<?php echo $hoy;?>">
           
 
 <?php require_once("footer.php"); ?>
 <input type="hidden" id="name_pag" value="ENVIOS A LABORATORIO">

  <!-- The Modal -->
  <div class="modal" id="myModal">
  <div class="modal-dialog" style="max-width: 90%;">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header bg-info" style="padding:5px;color:white; text-align:center">
        <h4 class="modal-title  w-100 text-center position-absolute" id="title-cobros-gen" style='font-size:15px'>FACTURA MANUAL</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

        <div class="form-row">

            <div class="form-group col-md-4">
                <label for="ex3">Cliente</label>
                <input type="search"  class="form-control clear_input" name=""  id="cliente">
            </div>

            <div class="form-group col-md-4">
                <label for="ex3">Dirección</label>
                <input type="search"  class="form-control clear_input" name=""  id="dir">
            </div>

            <div class="form-group col-md-2">
                <label for="ex3">Tel.</label>
                <input type="search"  class="form-control clear_input" name=""  id="tel">
            </div>

            <div class="form-group col-md-2">
                <label for="ex3">Fecha.</label>
                <input type="date"  class="form-control clear_input" name=""  id="fecha_fac">
            </div>
        </div>
        
        <div class="form-row">

            <div class="form-group col-md-2">
                <label for="ex3">Cantidad</label>
                <input type="number"  class="form-control clear_input" name="" placeholder="Cant." required="" id="cantfac">
            </div>

            <div class="form-group col-md-8">
                <label for="ex3">Descripcion</label>
                <input type="search"  class="form-control clear_input" name="" placeholder="Descripcion" required="" id="desc_fact">
            </div>

            <div class="form-group col-md-2">
                <label for="ex3">P. Unit.</label>
                <input type="number"  class="form-control clear_input" name="" placeholder="Precio Unitario." required="" id="p_unit_fact">
            </div>            
        </div>


        <table class="table-striped" width="100%">
        <tr class="bg-primary" style="text-align:center">
            <th colspan="15">Cantidad</th>
            <th colspan="50">Descripcion</th>
            <th colspan="10">P.Unit</th>
            <th colspan="10">Subtotal</th>
            <th colspan="15">Acc.</th>
        </tr>    
        <tbody id="det_manual"></tbody>
        <tfoot><tr>
            <td colspan="75"></td>
            <td colspan="10" style="text-align:center"><b><span id="totales_man" style="border-bottom: double 1px;"></span></b></td>
            <td colspan="15"></td>
        </tr></tfoot>
        </table>
   

        <div class="eight">
            <h1>RETENCIóN</h1>
            <div class="d-flex justify-content-center">
            <input type="number" class="form-control" style="width:110px" placeholder="Retencion" id="retencion">
            </div> 
        </div>    

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-block btn-secondary" onClick="sendDataFact()">IMPRIMIR</button>
      </div>

    </div>
  </div>
</div>
  
</div>

 <script type="text/javascript" src="js/bootbox.min.js"></script>
 <script>
var items_factura = [];
function EnterEvent() {
    
if (event.keyCode == 13) {
  let cantidad = document.getElementById("cantfac").value;
  let desc= document.getElementById("desc_fact").value;
  let punit = document.getElementById("p_unit_fact").value; 

  if(cantidad !="" && desc !="" && punit !=""){
    let item = {
        cantidad:cantidad,
        desc:desc,
        punit:punit,
        subt: 0
    }
    items_factura.push(item);
    document.getElementById("cantfac").value="";
    document.getElementById("desc_fact").value="";
    document.getElementById("p_unit_fact").value="";
    $('#cantfac').focus();
    listar_items_man();
  }else{
    alert("Debe completar los detalles del item");
  }
}

}//Fin enter event

function listar_items_man(){
$('#det_manual').html('');
let filas = "";
var totales = 0;
for(var i=0; i<items_factura.length; i++){
    let subt = parseFloat(items_factura[i].cantidad)*parseFloat(items_factura[i].punit);
    let subtotal = subt.toFixed(2);
    items_factura[i].subt = subtotal;
    filas = filas + "<tr id='fila"+i+"'>"+
    "<td style='text-align:center;' colspan='15'>"+items_factura[i].cantidad+"</td>"+
    "</td><td style='text-align:center;' colspan='50'>"+items_factura[i].desc+"</td>"+
    "</td><td style='text-align:center;' colspan='10'>$"+parseFloat(items_factura[i].punit).toFixed(2)+"</td>"+
    "</td><td style='text-align:center;' colspan='10'>$"+parseFloat(subtotal).toFixed(2)+"</td>"+
    "<td style='text-align:center' colspan='15'><i class='nav-icon fas fa-times-circle' onClick='eliminarFila("+i+");' style='color:red'></i></td>"+
    "</tr>"

}
$('#det_manual').html(filas);
let total_manual = items_factura.reduce((sum, value) => ( sum + parseFloat(value.subt)), 0);
console.log(total_manual)
$('#totales_man').html("$"+total_manual);
}

function eliminarFila(index) {
  $("#fila" + index).remove();
  drop_index(index);
}

function drop_index(position_element){
  items_factura.splice(position_element, 1);
  //recalcular(position_element);
  listar_items_man();

}

function sendDataFact(){
    //let contribuyente = $("input[type='radio'][name='contribuyente']:checked").val();
    let tam_array = items_factura.length;
    if(tam_array<1){alert("Agregar productos"); return false;}
    let telefono = $("#tel").val();
    let direccion = $("#dir").val();
    let retencion = $("#retencion").val();
    let fecha = $("#fecha_fac").val()
    if(retencion=="" || fecha==""){
        alert("Monto retencion es obligatorio"); return false;
    }
    
    let paciente = document.getElementById("cliente").value;
    data = Object.values(items_factura);
    //[window.location = ('imp_factura_manual.php?info='+ JSON.stringify(data));
    window.open('imp_factura_manual.php?info='+ JSON.stringify(data)+"&cliente="+paciente+"&direccion="+direccion+"&telefono="+telefono+"&retencion="+retencion+"&fecha="+fecha, '_blank');
    location.reload();
}

window.onkeydown = EnterEvent;  
 </script>

    <!-- MODAL DEPOSITO A CAJA CHICA -->
  
 <?php } else{
echo "Acceso no permitido";
header("Location:index.php");
        exit();
  } ?>