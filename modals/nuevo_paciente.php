  <style>
    #pac_tamano{
      max-width: 85% !important;
      margin: auto;
    }
    #head_pac{
      color: white;
      background: black
    }
    html{ 
    overflow: scroll; 
    -webkit-overflow-scrolling: touch;
  }
</style>      

      <div class="modal fade bd-example-modal-lg" role="dialog" id="newPaciente">
        <div class="modal-dialog" id="pac_tamano">
          <div class="modal-content">
            <div class="modal-header" id="head_pac">
              <h5 class="modal-title">CREAR NUEVO PACIENTE</h5>
              <button type="button" class="close justify-content-between" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group row ">                 

                <div class="col-sm-5 input-field">                  
                  <input class="" id="nombres" name="nombres" type="text"  title='Nombres'> 
                  <label for="nombres">Nombre<span style="color:red">*</span></label>     
                </div>

                <div class="col-sm-2 input-field">                
                  <input class="" id="edad" type="number" name="edad"  title='Edad'>
                  <label for="edad">Edad</label>
                </div>

                <div class="col-sm-2 input-field" style='margin-top:4px' title='Genero'>  
                <select class="" id="genero_p" name="genero_p">
                  <option value="">Seleccionar..</option>
                  <option value="M">Masculino</option>
                  <option value="F">Femenino</option>
                  </select>
                  <label for="genero_p">Género</label>
                </div>
                
                <div class="col-sm-3 input-field">
                  <input class="" id="telefono" type="text" name="telefono" required pattern='^[0-9]+' title='Telefono'>
                  <label for="telefono">Teléfono<span>*</span></label>
                </div> 

                <div class="col-sm-5 input-field">
                <select class="" id="departamento" name="departamento" onchange='get_municipios(this.value)' title='Departamento'>
                 <option value="">Seleccionar...</option>
                  <option value="San Salvador">San Salvador</option>
                  <option value="La Libertad">La Libertad</option>
                  <option value="Santa Ana">Santa Ana</option>
                  <option value="San Miguel">San Miguel</option>
                  <option value="Sonsonate">Sonsonate</option>
                  <option value="Usulutan">Usulutan</option>
                  <option value="Ahuachapan">Ahuachapan</option>
                  <option value="La Union">La Unión</option>
                  <option value="La Paz">La Paz</option>
                  <option value="Chalatenango">Chalatenango</option>
                  <option value="Cuscatlan">Cuscatlan</option>
                  <option value="Morazan">Morazan</option>
                  <option value="San Vicente">San Vicente</option>
                  <option value="Cabanas">Cabanas</option>
                 </select>
                 <label for="departamento">Departamento</label>
                </div>

                <div class="col-sm-7 input-field select2-primary" style='margin-top:5px !important'>                  
                  <select name="" id="munic_pac" class="select2 next-input form-control clear_orden_i oblig_form_manual" required="" tabindex="-1" multiple="" data-dropdown-css-class="select2-primary" aria-hidden="true" placeholder='Municipio'>
                 </select>
                </div>

                <button class="btn btn-primary btn-block" onClick="save_paciente();" id="save_paciente"><span class="glyphicon glyphicon-save-file" aria-hidden="true"></span>Guardar</button>
               <!--  <button class="btn btn-primary btn-block" onClick="save_paciente();" id="edit_paci">Editar</button>   -->
              </div>
              
            </div>
            <input id="id_paciente" type="hidden">
  
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
      <script>


/***************MUNICIPIOS ***************/

var ahuachapan = ["Ahuachapán", "Apaneca", "Atiquizaya", "Concepción de Ataco", "El Refugio", "Guaymango", "Jujutla", "San Francisco Menéndez", "San Lorenzo", "San Pedro Puxtla", "Tacuba", "Turín"];
var cabanas = ["Cinquera", "Dolores (Villa Doleres)", "Guacotecti", "Ilobasco", "Jutiapa", "San Isidro", "Sensuntepeque", "Tejutepeque", "Victoria"];
var chalatenango = ["Agua Caliente", "Arcatao", "Azacualpa", "Chalatenango", "Citalá", "Comalapa", "Concepción Quezaltepeque", "Dulce Nombre de María", "El Carrizal", "El Paraíso", "La Laguna", "La Palma", "La Reina", "Las Vueltas", "Nombre de Jesús", "Nueva Concepción", "Nueva Trinidad", "Ojos de Agua", "Potonico", "San Antonio de la Cruz", "San Antonio Los Ranchos", "San Fernando", "San Francisco Lempa", "San Francisco Morazán", "San Ignacio", "San Isidro Labrador", "San José Cancasque (Cancasque)", "San José Las Flores", "San Luis del Carmen", "San Miguel de Mercedes", "San Rafael", "Santa Rita", "Tejutla"];
var cuscatlan = ["Candelaria", "Cojutepeque", "El Carmen", "El Rosario", "Monte San Juan", "Oratorio de Concepción", "San Bartolomé Perulapía", "San Cristóbal", "San José Guayabal", "San Pedro Perulapán", "San Rafael Cedros", "San Ramón", "Santa Cruz Analquito", "Santa Cruz Michapa", "Suchitoto", "Tenancingo"];
var morazan = ["Arambala", "Cacaopera", "Chilanga", "Corinto", "Delicias de Concepción", "El Divisadero", "El Rosario", "Gualococti", "Guatajiagua", "Joateca", "Jocoaitique", "Jocoro", "Lolotiquillo", "Meanguera", "Osicala", "Perquín", "San Carlos", "San Fernando", "San Francisco Gotera", "San Isidro", "San Simón", "Sensembra", "Sociedad", "Torola", "Yamabal", "Yoloaiquín"];
var lalibertad = ["Antiguo Cuscatlán", "Chiltiupán", "Ciudad Arce", "Colón", "Comasagua", "Huizúcar", "Jayaque", "Jicalapa", "La Libertad", "Santa Tecla (Nueva San Salvador)", "Nuevo Cuscatlán", "San Juan Opico", "Quezaltepeque", "Sacacoyo", "San José Villanueva", "San Matías", "San Pablo Tacachico", "Talnique", "Tamanique", "Teotepeque", "Tepecoyo", "Zaragoza"];
var lapaz = ["Cuyultitán", "El Rosario (Rosario de La Paz)", "Jerusalén", "Mercedes La Ceiba", "Olocuilta", "Paraíso de Osorio", "San Antonio Masahuat", "San Emigdio", "San Francisco Chinameca", "San Juan Nonualco", "San Juan Talpa", "San Juan Tepezontes", "San Luis La Herradura", "San Luis Talpa", "San Miguel Tepezontes", "San Pedro Masahuat", "San Pedro Nonualco", "San Rafael Obrajuelo", "Santa María Ostuma", "Santiago Nonualco", "Tapalhuaca", "Zacatecoluca"];
var launion = ["Anamorós", "Bolívar", "Concepción de Oriente", "Conchagua", "El Carmen", "El Sauce", "Intipucá", "La Unión", "Lilisque", "Meanguera del Golfo", "Nueva Esparta", "Pasaquina", "Polorós", "San Alejo", "San José", "Santa Rosa de Lima", "Yayantique", "Yucuaiquín"];
var sanmiguel = ["Carolina", "Chapeltique", "Chinameca", "Chirilagua", "Ciudad Barrios", "Comacarán", "El Tránsito", "Lolotique", "Moncagua", "Nueva Guadalupe", "Nuevo Edén de San Juan", "Quelepa", "San Antonio del Mosco", "San Gerardo", "San Jorge", "San Luis de la Reina", "San Miguel", "San Rafael Oriente", "Sesori", "Uluazapa"];
var sansalvador = ["Aguilares", "Apopa", "Ayutuxtepeque", "Ciuddad Delgado", "Cuscatancingo", "El Paisnal", "Guazapa", "Ilopango", "Mejicanos", "Nejapa", "Panchimalco", "Rosario de Mora", "San Marcos", "San Martín", "San Salvador", "Santiago Texacuangos", "Santo Tomás", "Soyapango", "Tonacatepeque"];
var sanvicente = ["Apastepeque", "Guadalupe", "San Cayetano Istepeque", "San Esteban Catarina", "San Ildefonso", "San Lorenzo", "San Sebastián", "San Vicente", "Santa Clara", "Santo Domingo", "Tecoluca", "Tepetitán", "Verapaz"];
var santaana = ["Candelaria de la Frontera", "Chalchuapa", "Coatepeque", "El Congo", "El Porvenir", "Masahuat", "Metapán", "San Antonio Pajonal", "San Sebastián Salitrillo", "Santa Ana", "Santa Rosa Guachipilín", "Santiago de la Frontera", "Texistepeque"];
var sonsonate = ["Acajutla", "Armenia", "Caluco", "Cuisnahuat", "Izalco", "Juayúa", "Nahuizalco", "Nahulingo", "Salcoatitán", "San Antonio del Monte", "San Julián", "Santa Catarina Masahuat", "Santa Isabel Ishuatán", "Santo Domingo de Guzmán", "Sonsonate", "Sonzacate"];
var usulutan = ["Alegría", "Berlín", "California", "Concepción Batres", "El Triunfo", "Ereguayquín", "Estanzuelas", "Jiquilisco", "Jucuapa", "Jucuarán", "Mercedes Umaña", "Nueva Granada", "Ozatlán", "Puerto El Triunfo", "San Agustín", "San Buenaventura", "San Dionisio", "San Francisco Javier", "Santa Elena", "Santa María", "Santiago de María", "Tecapán", "Usulután"];
function get_municipios(depto) {
  $("#munic_pac").empty()
 
  if (depto == "San Salvador") {
    $("#munic_pac").select2({ data: sansalvador })
  } else if (depto == "La Libertad") {
    $("#munic_pac").select2({ data: lalibertad })
  } else if (depto == "Santa Ana") {
    $("#munic_pac").select2({ data: santaana })
  } else if (depto == "San Miguel") {
    $("#munic_pac").select2({ data: sanmiguel })
  } else if (depto == "Sonsonate") {
    $("#munic_pac").select2({ data: sonsonate })
  } else if (depto == "Usulutan") {
    $("#munic_pac").select2({ data: usulutan })
  } else if (depto == "Ahuachapan") {
    $("#munic_pac").select2({ data: ahuachapan })
  } else if (depto == "La Union") {
    $("#munic_pac").select2({ data: launion })
  } else if (depto == "La Paz") {
    $("#munic_pac").select2({ data: lapaz })
  } else if (depto == "Chalatenango") {
    $("#munic_pac").select2({ data: chalatenango })
  } else if (depto == "Cuscatlan") {
    $("#munic_pac").select2({ data: cuscatlan })
  } else if (depto == "Morazan") {
    $("#munic_pac").select2({ data: morazan })
  } else if (depto == "San Vicente") {
    $("#munic_pac").select2({ data: sanvicente })
  } else if (depto == "Cabanas") {
    $("#munic_pac").select2({ data: cabanas })
  }

  $("#munic_pac").select2({
    placeholder: "Seleccionar municipio",
    allowClear: true
  });
  $("#munic_pac").select2({
    maximumSelectionLength: 1
  });
}

</script>