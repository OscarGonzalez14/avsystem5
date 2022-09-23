<?php
require_once('header.php');
?>

<div class="content-wrapper">
  <div class="content" id="listar_usuarios">

    <div class="header" style="padding:7px;">
      <section class="content">
        <h2 class="card-title" align="center" style="padding:7px;"><strong> LISTADO DE USUARIOS </strong></h2>
        <div>
         <ul class="breadcrumb float-sm-right" style="background-color:transparent;padding:0px;">
         <li class="breadcrumb-item"><a href="ventas.php">Regresar</a></li>
         <li class="breadcrumb-item active">Usuarios</li>
         </ul>
        </div>
        </section>
    </div><br>
    <div class="card-body p-0" style="margin:7px">
      <table id="lista_usuarios" width="100%" class = "table-hover">
        <thead style="background:#034f84;color:white;text-align: center;">
          <tr>
          <th>Código de empleo</th>
          <th>Nombre</th>
          <th>Usuario</th>
          <th>Cargo</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Dirección</th>
          </tr>
        </thead>
        <tbody style="text-align:center">                                  
        </tbody>
      </table>
    </div>
 
  </div>
</div>
