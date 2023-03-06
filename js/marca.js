let MinAlert = Swal.mixin({
	toast: true,
	position: 'top-center',
	showConfirmButton: false,
	timer: 1000
  });
function init(){
	//cargar_marca();
}

function guardarMarca(){
	var nom_marca=$("#marca").val();
	
	if(nom_marca !=""){
	$.ajax({
		url:"ajax/marca.php?op=guardar_marca",
		method:"POST",
		data:{nom_marca:nom_marca},
		cache: false,
		dataType: "json",
		success:function(data){
         if (data=='ok') {
	     $("#newMarca").modal("hide");
		 MinAlert.fire({icon: 'success',title: 'Marca creada'}); 
		  cargar_marca_creada(nom_marca)	      
	    }else{
          setTimeout ("Swal.fire('Esta marca ya se encuetra registrada','','error')", 1000);
          return false;
  		}
        }

     });
	}
}


function cargar_marca(){	
	$.ajax({
		url:"ajax/marca.php?op=get_marcas",
      	method:"POST",
      	cache:false,
      	dataType:"json",
      	success:function(info){
			//$("#marca_aros").empty();			
			$("#marca_aros").select2({ 
				data: info,
				sorter: function(data) {
					return data.sort();
				}
			})
        }
	}); 
}


function cargar_marca_creada(marca){
	$.ajax({
		url:"ajax/marca.php?op=get_marcas",
      	method:"POST",
      	cache:false,
      	dataType:"json",
      	success:function(info){
			$("#marca_aros").empty();
			
			$("#marca_aros").select2({ 
				data: info,
				sorter: function(data) {
					return data.sort();
				}
			})
			let $option = $("<option selected></option>").val(marca).text(marca);
			$('#marca_aros').append($option).trigger('change');
        }
	}); 
}

init();