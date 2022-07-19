<?php  
//conexion a la base de datos
require_once("../config/conexion.php");


class Bodegas extends Conectar{

public function get_numero_ingreso(){

    $conectar= parent::conexion();
    $sql= "select max(id_ingresos)+1 as n_ingreso from ingresos limit 1;";
    $sql=$conectar->prepare($sql);
    $sql->execute();
    $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    if(is_array($resultado)==true and count($resultado)>0){
      foreach($resultado as $row){
        $correlativo = "I-".$row["n_ingreso"];
    }
    }else{
      $correlativo = "I-1";
    }

    return $correlativo;
  }  
  


public function get_productos_ingresar($numero_compra){
$conectar= parent::conexion();         
/*$sql= "SELECT * FROM `detalle_compras` WHERE `numero_compra`=?;";*/
$sql="select*from detalle_compras as d inner join productos as p on d.id_producto=p.id_producto where numero_compra=?;";
$sql=$conectar->prepare($sql);
$sql->bindValue(1,$numero_compra);
$sql->execute();
return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

public function get_productos_ingresar_bodega($id_producto,$numero_compra){
$conectar = parent::conexion();         
/*$sql= "select*from detalle_compras where id_producto=? and numero_compra=? and cant_ingreso>0;";*/
$sql="select p.id_producto,d.descripcion,p.diseno,p.materiales,d.numero_compra,d.cant_ingreso,d.precio_venta,d.precio_compra from productos as p inner join detalle_compras as d on p.id_producto=d.id_producto  where p.id_producto=? and d.numero_compra=? and cant_ingreso>0;";
$sql=$conectar->prepare($sql);
$sql->bindValue(1,$id_producto);
$sql->bindValue(2,$numero_compra);
$sql->execute();
return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}
////////////////////REGISTRAR INGRESO A BODEGAS//////////////
public function registrar_ingreso_a_bodega(){

  $str = '';
  $detalles = array();
  $detalles = json_decode($_POST['arrayIngresoBodega']); 
  $conectar=parent::conexion();

  foreach ($detalles as $k => $v) {
    $cantidad = $v->cantidad;
    $descripcion = $v->descripcion;
    $id_producto = $v->id_producto;
    $precio_venta =$v->precio_venta;
    //$precio_compra = $v->precio_compra;

    $fecha_ingreso = $_POST["fecha_ingreso"];
    $usuario = $_POST["usuario"];
    $sucursal_i = $_POST["sucursal_i"];
    $numero_compra = $_POST["numero_compra_i"];
    $categoria_ubicacion = $_POST["categoria_ubicacion"];
    $numero_ingreso = $_POST["numero_ingreso"];  

    //////////////////VERIFICA SI EXISTE EL PRODUCTO EN LA BODEGA  para insertar o ACTUALIZAR BODEGA 
  $sql3="select * from existencias where id_producto=? and bodega=? and categoria_ub=? and num_compra=?;";
    $sql3=$conectar->prepare($sql3);
    $sql3->bindValue(1,$id_producto);
    $sql3->bindValue(2,$sucursal_i);
    $sql3->bindValue(3,$categoria_ubicacion);
    $sql3->bindValue(4,$numero_compra);
    $sql3->execute();
    $resultado = $sql3->fetchAll(PDO::FETCH_ASSOC);
      
      if(is_array($resultado)==true and count($resultado)>0){
        foreach($resultado as $b=>$row){
          $re["existencia"] = $row["stock"];
        }
    //la cantidad total es la suma de la cantidad más la cantidad actual
      $cantidad_total = $cantidad + $row["stock"];             
      //si existe el producto entonces actualiza el stock en producto
            
     if(is_array($resultado)==true and count($resultado)>0) {                     
          //actualiza el stock en la tabla producto
        $sql4 = "update existencias set                      
        stock=?
        where 
        id_producto=? and bodega=? and categoria_ub=? and num_compra=?";
      $sql4 = $conectar->prepare($sql4);
      $sql4->bindValue(1,$cantidad_total);
      $sql4->bindValue(2,$id_producto);
      $sql4->bindValue(3,$sucursal_i);
      $sql4->bindValue(4,$categoria_ubicacion);
      $sql4->bindValue(5,$numero_compra);
      $sql4->execute();
      }

    }else{
     $sql="insert into existencias values (null,?,?,?,?,?,?,?,?);";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_producto);
        $sql->bindValue(2,$cantidad);
        $sql->bindValue(3,$sucursal_i);
        $sql->bindValue(4,$categoria_ubicacion);
        $sql->bindValue(5,$fecha_ingreso);
        $sql->bindValue(6,$usuario);
        $sql->bindValue(7,$numero_compra);
        $sql->bindValue(8,$precio_venta);
        //$sql->bindValue(9,$precio_compra);       

        $sql->execute();
    } //cierre la condicional

    ///SE DESCUENTA DEL NUMERO DE COMPRAS EL DETALLE INSERTADO
       $sql5="select * from detalle_compras where id_producto=? and numero_compra=?;";
       $sql5=$conectar->prepare($sql5);
       $sql5->bindValue(1,$id_producto);
       $sql5->bindValue(2,$numero_compra);
       $sql5->execute();
       $resultado2 = $sql5->fetchAll(PDO::FETCH_ASSOC);

       if(is_array($resultado2)==true and count($resultado2)>0){
        foreach($resultado2 as $b=>$row){
          $re["ingreso"] = $row["cant_ingreso"];
        }
      //la cantidad total es la suma de la cantidad más la cantidad actual
        $cantidad_ingreso = $row["cant_ingreso"]-$cantidad;             
      //si existe el producto entonces actualiza el stock en producto
            
      if(is_array($resultado2)==true and count($resultado2)>0) {                     
          //actualiza el stock en la tabla producto
        $sql6 = "update detalle_compras set                      
        cant_ingreso=?
        where 
        id_producto=? and numero_compra=?
      ";
      $sql6 = $conectar->prepare($sql6);
      $sql6->bindValue(1,$cantidad_ingreso);
      $sql6->bindValue(2,$id_producto);
      $sql6->bindValue(3,$numero_compra);
      $sql6->execute();
      }
  }//cerre del condicional

   $sql10="insert into detalle_ingresos values (null,?,?,?,?,?,?,?,?,?);";
   $sql10=$conectar->prepare($sql10);
   $sql10->bindValue(1,$descripcion);
   $sql10->bindValue(2,$cantidad);
   $sql10->bindValue(3,$sucursal_i);
   $sql10->bindValue(4,$categoria_ubicacion);
   //$sql10->bindValue(5,$fecha_ingreso);
   $sql10->bindValue(5,$usuario);
   $sql10->bindValue(6,$fecha_ingreso);
   $sql10->bindValue(7,$numero_compra);
   $sql10->bindValue(8,$precio_venta);
   $sql10->bindValue(9,$numero_ingreso);
   $sql10->execute();

  }//cierre del foreach

 // SELECT `cant_ingreso` from detalle_compras WHERE `cant_ingreso`>0
  //SELECT SUM(`cant_ingreso`) as suma FROM `detalle_compras` WHERE `numero_compra`='ME-1' HAVING suma<0}//cierre del la funcion
  ////////////VERIFICAR LA ITEMS DE COMPRA PARA CAMBIAR EL ESTADO DE LACOMPRA
    $sql7="SELECT cant_ingreso from detalle_compras WHERE cant_ingreso>0  AND numero_compra=?;";
    $sql7=$conectar->prepare($sql7);
    $sql7->bindValue(1,$numero_compra);
    $sql7->execute();
    $resultado_count = $sql7->fetchAll(PDO::FETCH_ASSOC);

    if(is_array($resultado_count)==true and count($resultado_count)>0) {                     
      $sql8 = "update compras set estado=1 where numero_compra=?";
      $sql8 = $conectar->prepare($sql8);
      $sql8->bindValue(1,$numero_compra);
      $sql8->execute();
    }elseif (is_array($resultado_count)==true and count($resultado_count)==0) {
      $sql9 = "update compras set estado=2 where numero_compra=?";
      $sql9 = $conectar->prepare($sql9);
      $sql9->bindValue(1,$numero_compra);
      $sql9->execute();
    } 
//////////////////////REGISTRA DETALLE DE INGRESO
    //$numero_ing='0';
    $sql12="insert into ingresos values (null,?,?,?,?);";
    $sql12=$conectar->prepare($sql12);
    //$sql12->bindValue(1,$id_ingresos);
    $sql12->bindValue(1,$numero_ingreso);
    $sql12->bindValue(2,$usuario);
    $sql12->bindValue(3,$fecha_ingreso);
    $sql12->bindValue(4,$sucursal_i);
    $sql12->execute();
}


///////////////////get reporte ingresos a bodega
public function get_reporte_ingreso_bodega($numero_ingreso){
    $conectar= parent::conexion();         
    $sql= "select*from detalle_ingresos WHERE numero_ingreso=?";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$numero_ingreso);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}

//////////////////inventario general
public function get_stock_categoria($ubicacion){
    $conectar= parent::conexion();
    $sql="select p.desc_producto as descripcion,p.diseno,p.materiales,e.stock,e.bodega,e.categoria_ub,e.usuario,e.fecha_ingreso,e.num_compra,e.precio_venta from productos as p inner join existencias as e on p.id_producto=e.id_producto where e.categoria_ub=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1, $ubicacion);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_productos_traslados($id_producto,$categoria_ub){
    $conectar= parent::conexion();         
    $sql= "select p.desc_producto,e.categoria_ub,e.id_ingreso,e.num_compra,e.precio_venta from productos as p inner join existencias as e on p.id_producto=e.id_producto where e.id_producto=? and categoria_ub=?;";
    $sql=$conectar->prepare($sql);
    $sql->bindValue(1,$id_producto);
    $sql->bindValue(2,$categoria_ub);
    $sql->execute();
    return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  //////////////AGREGA DETALLE TRASLADO
  public function agrega_detalle_traslado(){

    $str = '';
    $detalles_traslado = array();
    $detalles_traslado = json_decode($_POST['arrayTraslado']);

    $conectar=parent::conexion();

    $sucursal = $_POST["sucursal"];
    $usuario = $_POST["usuario"];
    $fecha = $_POST["fecha"];
    $tipo_traslado = $_POST["tipo_traslado"];
    $num_traslado = $_POST["num_traslado"];


    foreach ($detalles_traslado as $k => $v) {
       $cantidad= $v->cantidad;
       $codProd= $v->codProd;
       $descripcion= $v->descripcion;
       $destino= $v->destino;
       $origen= $v->origen;
       $num_compra = $v->num_compra;
       $id_ingreso = $v->id_ingreso;
       $precio_venta =$v->precio_venta;

    $sql="insert into detalle_traslados values(null,?,?,?,?,?,?,?);";
    $sql=$conectar->prepare($sql);

    $sql->bindValue(1,$codProd);
    $sql->bindValue(2,$usuario);
    $sql->bindValue(3,$cantidad);
    $sql->bindValue(4,$origen);
    $sql->bindValue(5,$destino);
    $sql->bindValue(6,$num_traslado);
    $sql->bindValue(7,$fecha);
    $sql->execute();

        ////////////////////ACTUALIZAR STOCK DE existencia
      $sql3="select * from existencias where id_producto=? and bodega=? and categoria_ub=? and num_compra=? and id_ingreso=?;";           
      $sql3=$conectar->prepare($sql3);
      $sql3->bindValue(1,$codProd);
      $sql3->bindValue(2,$sucursal);
      $sql3->bindValue(3,$origen);
      $sql3->bindValue(4,$num_compra);
      $sql3->bindValue(5,$id_ingreso);
      $sql3->execute();

      $resultados = $sql3->fetchAll(PDO::FETCH_ASSOC);

      foreach($resultados as $b=>$row){
      $re["existencia"] = $row["stock"];
    }     
    $sustrae_destino = $row["stock"] - $cantidad;
    //$agrega_origen = $row["stock"] + $cantidad;
    if(is_array($resultados)==true and count($resultados)>0) {                    

    $sql12 = "update existencias set stock=? where id_producto=? and bodega=? and id_ingreso=? and categoria_ub=? and num_compra=?";
      $sql12 = $conectar->prepare($sql12);
      $sql12->bindValue(1,$sustrae_destino);
      $sql12->bindValue(2,$codProd);
      $sql12->bindValue(3,$sucursal);
      $sql12->bindValue(4,$id_ingreso);
      $sql12->bindValue(5,$origen);
      $sql12->bindValue(6,$num_compra);
      $sql12->execute();
             
  }
  ////////////////////agrega item a nueva ubicacion

     $sql="insert into existencias values (null,?,?,?,?,?,?,?,?);";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$codProd);
        $sql->bindValue(2,$cantidad);
        $sql->bindValue(3,$sucursal);
        $sql->bindValue(4,$destino);
        $sql->bindValue(5,$fecha);
        $sql->bindValue(6,$usuario);
        $sql->bindValue(7,$num_compra);
        $sql->bindValue(8,$precio_venta);
        $sql->execute();


    }//////////////////FIN FORACH INGRESO DETALLES
    
    $sql2="insert into traslados values(null,?,?,?,?,?);";

    $sql2=$conectar->prepare($sql2);
    $sql2->bindValue(1,$num_traslado);
    $sql2->bindValue(2,$fecha);
    $sql2->bindValue(3,$tipo_traslado);
    $sql2->bindValue(4,$sucursal);
    $sql2->bindValue(5,$usuario);
    $sql2->execute();
}/////////////fin detalle traslado
//////////////////////////////GT NUMERO TRASLADO
public function get_numero_traslado($sucursal){
  $conectar = parent::conexion();
  $sql= "select num_traslado from traslados where sucursal=? order by id_traslado DESC limit 1;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1, $sucursal);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
}


public function ingresoIndividual($id_producto,$cantidad_ingreso,$precio_venta,$ubicacion,$usuario,$sucursal,$numero_compra,$numero_ingreso,$costo_u){
  $conectar = parent::conexion();
  date_default_timezone_set('America/El_Salvador'); 
  $hoy = date("d-m-Y H:i:s");
  
  $sql="select stock from existencias where id_producto=? and bodega=? and categoria_ub=? and num_compra=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$id_producto);
  $sql->bindValue(2,$sucursal);
  $sql->bindValue(3,$ubicacion);
  $sql->bindValue(4,$numero_compra);
  $sql->execute();
  $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

  if(is_array($resultado)==true and count($resultado)>0){
    foreach($resultado as $row){
      $stock_prod = $row["stock"];
  }
  }else{
    $stock_prod = 0;
  }

  $nuevo_stock = $stock_prod + $cantidad_ingreso;

  if(is_array($resultado)==true and count($resultado)>0) {                     
   
  $sql4 = "update existencias set stock=? where id_producto=? and bodega=? and categoria_ub=?";
  $sql4 = $conectar->prepare($sql4);
  $sql4->bindValue(1,$nuevo_stock);
  $sql4->bindValue(2,$id_producto);
  $sql4->bindValue(3,$sucursal);
  $sql4->bindValue(4,$ubicacion);
  $sql4->execute();
}else{
$sql="insert into existencias values (null,?,?,?,?,?,?,?,?);";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$id_producto);
  $sql->bindValue(2,$cantidad_ingreso);
  $sql->bindValue(3,$sucursal);
  $sql->bindValue(4,$ubicacion);
  $sql->bindValue(5,$hoy);
  $sql->bindValue(6,$usuario);
  $sql->bindValue(7,$numero_compra);
  $sql->bindValue(8,$precio_venta);
  $sql->execute();
} //cierre la condicional

 $total_compra = $cantidad_ingreso * $costo_u;
 $compra = $this->registraCompra($numero_compra,"-","Andres Vasquez","Contado","Efectivo","12",$hoy,"CCF","12345",$usuario,$total_compra,"1",$sucursal);
 $detCompra = $this->registrarDetalleCompra($numero_compra,"-",$cantidad_ingreso,$costo_u,$precio_venta,$total_compra,"0",$usuario,$id_producto,$hoy,$cantidad_ingreso);
 $ingreso = $this->registrarIngreso($numero_ingreso,$usuario,$hoy,$sucursal);
 $detIngreso = $this->registrarDetalleIngreso($id_producto,$cantidad_ingreso,$sucursal,$ubicacion,$hoy,$usuario,$numero_compra,$costo_u,$precio_venta,$numero_ingreso);

  if($compra = "okCompra" and  $detCompra = "okDetCompra" and  $ingreso = "okIngreso" and $detIngreso = "okDetIngreso"){
      $confirm = "insertOk";
  }else{
      $confirm = "errorInsert";
  }
   $msj = ["mensaje"=>$confirm];
   echo json_encode($msj); 
  }

  public function ingresoGrupal($ubicacion,$usuario,$sucursal,$numero_compra,$numero_ingreso,$totales_compra){
    $conectar = parent::conexion();
    date_default_timezone_set('America/El_Salvador'); 
    $hoy = date("d-m-Y H:i:s");

    $detalles = array();
    $detalles = json_decode($_POST['arrayProdGrupal']); 

    $compra = $this->registraCompra($numero_compra,"-","Andres Vasquez","Contado","Efectivo","12",$hoy,"CCF","12345",$usuario,$totales_compra,"1",$sucursal);
    $ingreso = $this->registrarIngreso($numero_ingreso,$usuario,$hoy,$sucursal);

    foreach($detalles as $k => $v){
      $cantidad_ingreso = $v->cantidad;
      $descripcion = $v->descripcion;
      $id_producto = $v->idProd;
      $precio_venta =$v->pventa;
      $costo_u = $v->costo;


      $sql="select stock from existencias where id_producto=? and bodega=? and categoria_ub=? and num_compra=?;";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1,$id_producto);
      $sql->bindValue(2,$sucursal);
      $sql->bindValue(3,$ubicacion);
      $sql->bindValue(4,$numero_compra);
      $sql->execute();
      $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

      if(is_array($resultado)==true and count($resultado)>0){
        foreach($resultado as $row){
          $stock_prod = $row["stock"];
      }
      }else{
        $stock_prod = 0;
      }
    
      $nuevo_stock = $stock_prod + $cantidad_ingreso;
    
      if(is_array($resultado)==true and count($resultado)>0) {                     
       
      $sql4 = "update existencias set stock=? where id_producto=? and bodega=? and categoria_ub=?";
      $sql4 = $conectar->prepare($sql4);
      $sql4->bindValue(1,$nuevo_stock);
      $sql4->bindValue(2,$id_producto);
      $sql4->bindValue(3,$sucursal);
      $sql4->bindValue(4,$ubicacion);
      $sql4->execute();
    }else{
      $sql="insert into existencias values (null,?,?,?,?,?,?,?,?);";
      $sql=$conectar->prepare($sql);
      $sql->bindValue(1,$id_producto);
      $sql->bindValue(2,$cantidad_ingreso);
      $sql->bindValue(3,$sucursal);
      $sql->bindValue(4,$ubicacion);
      $sql->bindValue(5,$hoy);
      $sql->bindValue(6,$usuario);
      $sql->bindValue(7,$numero_compra);
      $sql->bindValue(8,$precio_venta);
      $sql->execute();
    } //cierre la condicional

    $total_compra = $cantidad_ingreso * $costo_u;
    
    $detCompra = $this->registrarDetalleCompra($numero_compra,"-",$cantidad_ingreso,$costo_u,$precio_venta,$total_compra,"0",$usuario,$id_producto,$hoy,$cantidad_ingreso);

    $detIngreso = $this->registrarDetalleIngreso($id_producto,$cantidad_ingreso,$sucursal,$ubicacion,$hoy,$usuario,$numero_compra,$costo_u,$precio_venta,$numero_ingreso);

    }//FIN FOREACH 
    
    if($compra = "okCompra" and  $detCompra = "okDetCompra" and  $ingreso = "okIngreso" and $detIngreso = "okDetIngreso"){
      $confirm = "insertOk";
  }else{
      $confirm = "errorInsert";
  }
   $msj = ["mensaje"=>$confirm];
   echo json_encode($msj); 
  }

public function registraCompra($n_compra,$codigo_proveedor,$proveedor_compra,$tipo_compra,$tipo_pago,$plazo,$fecha,  $tipo_documento,$documento,$usuario,$total_compra,$estado,$sucursal){
  $conectar= parent::conexion();
  $sql2="insert into compras values(null,?,?,?,?,?,?,?,?,?,?,?,?,?);";

  $sql2=$conectar->prepare($sql2);
  $sql2->bindValue(1,$n_compra);
  $sql2->bindValue(2,$codigo_proveedor);
  $sql2->bindValue(3,$proveedor_compra);
  $sql2->bindValue(4,$tipo_compra);
  $sql2->bindValue(5,$tipo_pago);
  $sql2->bindValue(6,$plazo);
  $sql2->bindValue(7,$fecha);    
  $sql2->bindValue(8,$tipo_documento);
  $sql2->bindValue(9,$documento);
  $sql2->bindValue(10,$usuario);
  $sql2->bindValue(11,$total_compra);
  $sql2->bindValue(12,$estado);
  $sql2->bindValue(13,$sucursal);
  $sql2->execute();
  
  if($sql2->rowCount() > 0){
    $response = "okCompra";
  }
   return $response;

}

public function registrarDetalleCompra($n_compra,$descripcion,$cantidad,$precio_compra,$precio_venta,$subtotal,$estado,$usuario,$codProd,$fecha){
  $conectar= parent::conexion();
  $sql="insert into detalle_compras values(null,?,?,?,?,?,?,?,?,?,?,?);";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$n_compra);
  $sql->bindValue(2,$descripcion);
  $sql->bindValue(3,$cantidad);
  $sql->bindValue(4,$precio_compra);
  $sql->bindValue(5,$precio_venta);
  $sql->bindValue(6,$subtotal);
  $sql->bindValue(7,$estado);
  $sql->bindValue(8,$usuario);
  $sql->bindValue(9,$codProd);
  $sql->bindValue(10,$fecha);
  $sql->bindValue(11,$cantidad);
  $sql->execute();
  if($sql->rowCount() > 0){
    $response = "okDetCompra";
  }
   return $response;
}

public function registrarIngreso($numero_ingreso,$usuario,$hoy,$sucursal){
  $conectar= parent::conexion();
  $sql12="insert into ingresos values (null,?,?,?,?);";
  $sql12=$conectar->prepare($sql12);
  $sql12->bindValue(1,$numero_ingreso);
  $sql12->bindValue(2,$usuario);
  $sql12->bindValue(3,$hoy);
  $sql12->bindValue(4,$sucursal);
  $sql12->execute();

  if($sql12->rowCount() > 0){
    $response = "okIngreso";
  }
   return $response;
  
}

public function registrarDetalleIngreso($id_producto,$cantidad_ingreso,$sucursal,$ubicacion,$hoy,$usuario,$numero_compra,$precio_compra,$precio_venta,$numero_ingreso){
  $conectar= parent::conexion();

  $sql = "select*from productos where id_producto=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$id_producto);
  $sql->execute();
  $result =$sql->fetchAll(PDO::FETCH_ASSOC);

  foreach($result as $r){
    $descripcion = $r["marca"]." * ".$r["modelo"]." * ".$r["color"]." * ".$r["medidas"];
  }

  $sql10 = "insert into detalle_ingresos values (null,?,?,?,?,?,?,?,?,?);";
  $sql10 = $conectar->prepare($sql10);
  $sql10->bindValue(1,$descripcion);
  $sql10->bindValue(2,$cantidad_ingreso);
  $sql10->bindValue(3,$sucursal);
  $sql10->bindValue(4,$ubicacion);
  $sql10->bindValue(5,$usuario);
  $sql10->bindValue(6,$hoy);
  $sql10->bindValue(7,$numero_compra);
  $sql10->bindValue(8,$precio_venta);
  $sql10->bindValue(9,$numero_ingreso);
  $sql10->execute();

  if($sql10->rowCount() > 0){
    $response = "okDetIngreso";
  }  
  return $response;
}


public function getStockBdCentral(){

  $conectar= parent::conexion();
  $sql= "select e.id_producto,e.id_ingreso,p.marca,p.modelo,p.color,p.medidas,p.diseno,p.materiales,e.stock,e.num_compra,e.precio_venta  from productos as p inner join existencias as e on p.id_producto=e.id_producto where e.bodega='Bodega Central' order by e.id_ingreso DESC;";
  $sql=$conectar->prepare($sql);
  $sql->execute();
  return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

}


public function distribuirArosSucursal($id_producto,$cantidad,$numero_compra,$usuario,$sucursal,$precio_venta){
  $conectar = parent::conexion();
  date_default_timezone_set('America/El_Salvador'); 
  $hoy = date("d-m-Y H:i:s");
  
  $sql="select stock from existencias where id_producto=? and bodega=? and categoria_ub=? and num_compra=?;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$id_producto);
  $sql->bindValue(2,$sucursal);
  $sql->bindValue(3,$sucursal);
  $sql->bindValue(4,$numero_compra);
  $sql->execute();
  $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

  if(is_array($resultado)==true and count($resultado)>0){
    foreach($resultado as $row){
      $stock_prod = $row["stock"];
  }
  }else{
    $stock_prod = 0;
  }

  $nuevo_stock = $stock_prod + $cantidad;

  if(is_array($resultado)==true and count($resultado)>0) {                     
   
  $sql4 = "update existencias set stock=? where id_producto=? and bodega=? and categoria_ub=?";
  $sql4 = $conectar->prepare($sql4);
  $sql4->bindValue(1,$nuevo_stock);
  $sql4->bindValue(2,$id_producto);
  $sql4->bindValue(3,$sucursal);
  $sql4->bindValue(4,$sucursal);
  $sql4->execute();
}else{
  $sql="insert into existencias values (null,?,?,?,?,?,?,?,?);";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$id_producto);
  $sql->bindValue(2,$cantidad);
  $sql->bindValue(3,$sucursal);
  $sql->bindValue(4,$sucursal);
  $sql->bindValue(5,$hoy);
  $sql->bindValue(6,$usuario);
  $sql->bindValue(7,$numero_compra);
  $sql->bindValue(8,$precio_venta);
  $sql->execute();
} //cierre la condicional

if($sql->rowCount() > 0 or $sql4->rowCount() > 0){

  $sql="select stock from existencias where id_producto=? and bodega='Bodega Central' and categoria_ub='bodega-cental' and num_compra=?;";
  $sql2=$conectar->prepare($sql);
  $sql2->bindValue(1,$id_producto);
  $sql2->bindValue(2,$numero_compra);
  $sql2->execute();
  $resultado2 = $sql2->fetchAll(PDO::FETCH_ASSOC);

  if(is_array($resultado2)==true and count($resultado2)>0){
    foreach($resultado2 as $r){
      $stock_producto = $r["stock"];
  }
}
  
  $stock_act = $stock_producto - $cantidad;

  $sql5 = "update existencias set stock=? where id_producto=? and bodega='Bodega Central' and categoria_ub='bodega-cental' and num_compra=?;";
  $sql5 = $conectar->prepare($sql5);
  $sql5->bindValue(1,$stock_act);
  $sql5->bindValue(2,$id_producto);
  $sql5->bindValue(3,$numero_compra);
  $sql5->execute();

}

if($sql2->rowCount() > 0 and $sql5->rowCount() > 0){
  $msj = ["mensaje"=>'registroOk'];
  echo json_encode($msj);
}else{
  $msj = ["mensaje"=>'registroError'];
  echo json_encode($msj);
}



}

}