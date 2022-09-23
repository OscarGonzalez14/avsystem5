<?php  


require_once("../config/conexion.php");
class Consulta extends Conectar{

    public function get_consultas($sucursal){

        $conectar= parent::conexion();
        $suc = "%".$sucursal."%";       
        $sql= "select c.fecha_consulta,c.id_consulta,p.nombres,p.edad,c.sugeridos,c.diagnostico,u.usuario,c.p_evaluado,p.id_paciente from usuarios as u inner join consulta as c on u.id_usuario=c.id_usuario inner join pacientes as p on c.id_paciente=p.id_paciente where p.sucursal like ?;";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$suc);
        $sql->execute();
        return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);         
    }
         
       public function get_detalle_consultas($id_consulta){
        $conectar=parent::conexion();
        parent::set_names();

        $sql="select p.codigo,p.nombres,u.usuario,p.edad,c.id_consulta,c.motivo,c.patologias,c.id_paciente,c.id_usuario,c.fecha_reg,c.oiesfreasl,c.oicilindrosl,c.oiejesl,c.oiprismal,c.oiadicionl,c.odesferasl,c.odcilndrosl,c.odejesl,c.odprismal,c.odadicionl,c.oiesferasa,c.oicolindrosa,c.oiejesa,c.oiprismaa,c.oiadiciona,c.odesferasa,c.odcilindrosa,c.odejesa ,c.dprismaa,c.oddiciona,c.sugeridos,c.diagnostico,c.medicamento,c.observaciones,c.oiesferasf,c.oicolindrosf,c.oiejesf,c.oiprismaf,c.oiadicionf,c.odesferasf,c.odcilindrosf,c.odejesf,c.dprismaf,c.oddicionf,c.prisoicorrige,c.addodcorrige,c.prisodcorrige,c.addoicorrige,c.fecha_consulta,c.patologias,c.odavsclejos,c.odavphlejos,c.odavcclejos,c.odavsccerca,c.odavcccerca,c.oiavesferasf,c.oiavcolindrosf,c.oiavejesf,c.oiavprismaf,c.oiavadicionf,c.dip,c.oddip,c.oidip,c.aood,c.aooi,c.apod,c.opoi,c.ishihara,c.amsler,c.anexos,
c.id_consulta,p_evaluado,c.parentesco_beneficiario,c.telefono_beneficiario from usuarios as u inner join consulta as c on u.id_usuario=c.id_usuario inner join pacientes as p on c.id_paciente=p.id_paciente where id_consulta=? order by c.id_consulta DESC;";


        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_consulta);
        $sql->execute();
        return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

       
            
       }

//método para eliminar un registro
    public function eliminar_consulta($id_consulta){

        $conectar=parent::conexion();
        $sql="delete from consulta where id_consulta=?";

        $sql=$conectar->prepare($sql);
        $sql->bindValue(1,$id_consulta);
        $sql->execute();

        return $resultado=$sql->fetch();
        }
    
public function editar_consultas($mot_consulta,$patologias_c,$id_consulta_e,$oiesfreasl_e,$oicilindrosl_e,$oiejesl_e,$oiprismal_e,$oiadicionl_e,$odesferasl_e,$odcilndrosl_e,$odejesl_e,$odprismal_e,$odadicionl_e,$oiesferasa_e,$oicolindrosa_e,$oiejesa_e,$oiprismaa_e,$oiadiciona_e,$odesferasa_e,$odcilindrosa_e,$odejesa_e,$dprismaa_e,$oddiciona_e,$odavsclejos_e,$odavphlejos_e,$odavcclejos_e,$odavsccerca_e,$odavcccerca_e,$oiavesferasf_e,$oiavcolindrosf_e,$oiavejesf_e,$oiavprismaf_e,$oiavadicionf_e,$odesferasf_e,$odcilindrosf_e,$odejesf_e,$dprismaf_e,$prisodcorrige_e,$oddicionf_e,$addodcorrige_e,$oiesferasf_e,$oicolindrosf_e,$oiejesf_e,$oiprismaf_e,$prisoicorrige_e,$oiadicionf_e,$addoicorrige_e,$oddip_e,$oidip_e,$aood_e,$aooi_e,$apod_e,$opoi_e,$ishihara_e,$amsler_e,$anexos_e,$sugeridos_e,$diagnostico_e,$medicamento_e,$observaciones_e){
  $conectar=parent::conexion();
  parent::set_names();

  $sql="update consulta set 

    motivo=?,
    patologias=?,
    
    oiesfreasl=?,
    oicilindrosl=?,
    oiejesl=?,
    oiprismal=?,
    oiadicionl=?,
    odesferasl=?,
    odcilndrosl=?,
    odejesl=?,
    odprismal=?,
    odadicionl=?,

    oiesferasa=?,
    oicolindrosa=?,
    oiejesa=?,
    oiprismaa=?,
    oiadiciona=?,
    odesferasa=?,
    odcilindrosa=?,
    odejesa=?,
    dprismaa=?,
    oddiciona=?,

    odavsclejos=?,
    odavphlejos=?,
    odavcclejos=?,
    odavsccerca=?,
    odavcccerca=?,
    oiavesferasf=?,
    oiavcolindrosf=?,
    oiavejesf=?,
    oiavprismaf=?,
    oiavadicionf=?,

    odesferasf=?,
    odcilindrosf=?,
    odejesf=?,
    dprismaf=?,
    prisodcorrige=?,
    oddicionf=?,
    addodcorrige=?,
    oiesferasf=?,
    oicolindrosf=?,
    oiejesf=?,
    oiprismaf=?,
    prisoicorrige=?,
    oiadicionf=?,
    addoicorrige=?,

    oddip=?,
    oidip=?,
    aood=?,
    aooi=?,
    apod=?,
    opoi=?,

    ishihara=?,
    amsler=?,
    anexos=?,
    sugeridos=?,
    diagnostico=?,
    medicamento=?,
    observaciones=?
    
    where 
    id_consulta=?";

    $sql=$conectar->prepare($sql);

    $sql->bindValue(1, $_POST["mot_consulta"]);
    $sql->bindValue(2, $_POST["patologias_c"]);

    $sql->bindValue(3, $_POST["oiesfreasl_e"]);
    $sql->bindValue(4, $_POST["oicilindrosl_e"]);
    $sql->bindValue(5, $_POST["oiejesl_e"]);
    $sql->bindValue(6, $_POST["oiprismal_e"]);
    $sql->bindValue(7, $_POST["oiadicionl_e"]);
    $sql->bindValue(8, $_POST["odesferasl_e"]);
    $sql->bindValue(9, $_POST["odcilndrosl_e"]);
    $sql->bindValue(10, $_POST["odejesl_e"]);
    $sql->bindValue(11, $_POST["odprismal_e"]);
    $sql->bindValue(12, $_POST["odadicionl_e"]);

    $sql->bindValue(13, $_POST["oiesferasa_e"]);
    $sql->bindValue(14, $_POST["oicolindrosa_e"]);
    $sql->bindValue(15, $_POST["oiejesa_e"]);
    $sql->bindValue(16, $_POST["oiprismaa_e"]);
    $sql->bindValue(17, $_POST["oiadiciona_e"]);
    $sql->bindValue(18, $_POST["odesferasa_e"]);
    $sql->bindValue(19, $_POST["odcilindrosa_e"]);
    $sql->bindValue(20, $_POST["odejesa_e"]);
    $sql->bindValue(21, $_POST["dprismaa_e"]);
    $sql->bindValue(22, $_POST["oddiciona_e"]);

    $sql->bindValue(23, $_POST["odavsclejos_e"]);
    $sql->bindValue(24, $_POST["odavphlejos_e"]);
    $sql->bindValue(25, $_POST["odavcclejos_e"]);
    $sql->bindValue(26, $_POST["odavsccerca_e"]);
    $sql->bindValue(27, $_POST["odavcccerca_e"]);
    $sql->bindValue(28, $_POST["oiavesferasf_e"]);
    $sql->bindValue(29, $_POST["oiavcolindrosf_e"]);
    $sql->bindValue(30, $_POST["oiavejesf_e"]);
    $sql->bindValue(31, $_POST["oiavprismaf_e"]);
    $sql->bindValue(32, $_POST["oiavadicionf_e"]);

    $sql->bindValue(33, $_POST["odesferasf_e"]);
    $sql->bindValue(34, $_POST["odcilindrosf_e"]);
    $sql->bindValue(35, $_POST["odejesf_e"]);
    $sql->bindValue(36, $_POST["dprismaf_e"]);
    $sql->bindValue(37, $_POST["prisodcorrige_e"]);
    $sql->bindValue(38, $_POST["oddicionf_e"]);
    $sql->bindValue(39, $_POST["addodcorrige_e"]);
    $sql->bindValue(40, $_POST["oiesferasf_e"]);
    $sql->bindValue(41, $_POST["oicolindrosf_e"]);
    $sql->bindValue(42, $_POST["oiejesf_e"]);
    $sql->bindValue(43, $_POST["oiprismaf_e"]);
    $sql->bindValue(44, $_POST["prisoicorrige_e"]);
    $sql->bindValue(45, $_POST["oiadicionf_e"]);
    $sql->bindValue(46, $_POST["addoicorrige_e"]);

    $sql->bindValue(47, $_POST["oddip_e"]);
    $sql->bindValue(48, $_POST["oidip_e"]);
    $sql->bindValue(49, $_POST["aood_e"]);
    $sql->bindValue(50, $_POST["aooi_e"]);
    $sql->bindValue(51, $_POST["apod_e"]);
    $sql->bindValue(52, $_POST["opoi_e"]);

    $sql->bindValue(53, $_POST["ishihara_e"]);
    $sql->bindValue(54, $_POST["amsler_e"]);
    $sql->bindValue(55, $_POST["anexos_e"]);
    $sql->bindValue(56, $_POST["sugeridos_e"]);
    $sql->bindValue(57, $_POST["diagnostico_e"]);
    $sql->bindValue(58, $_POST["medicamento_e"]);
    $sql->bindValue(59, $_POST["observaciones_e"]);

    $sql->bindValue(60, $_POST["id_consulta_e"]);

    $sql->execute();


}


public function agrega_consulta(){

$conectar=parent::conexion();
parent::set_names();

date_default_timezone_set('America/El_Salvador'); $hoy = date("d-m-Y H:i:s");
$motivo = $_POST["motivo"];
$patologias = $_POST["patologias"];
$id_paciente = $_POST["codigop"];
$id_usuario = $_POST["id_usuario"];
$fecha_reg = "";
$oiesfreasl = $_POST["oiesfreasl"];
$oicilindrosl = $_POST["oicilindrosl"];
$oiejesl = $_POST["oiejesl"];
$oiprismal = $_POST["oiprismal"];
$oiadicionl = $_POST["oiadicionl"];
$odesferasl = $_POST["odesferasl"];
$odcilndrosl = $_POST["odcilndrosl"];
$odejesl = $_POST["odejesl"];
$odprismal = $_POST["odprismal"];
$odadicionl = $_POST["odadicionl"];
$oiesferasa = $_POST["oiesferasa"];
$oicolindrosa = $_POST["oicolindrosa"];
$oiejesa  =$_POST["oiejesa"];
$oiprismaa = $_POST["oiprismaa"];
$oiadiciona = $_POST["oiadiciona"];
$odesferasa = $_POST["odesferasa"];
$odcilindrosa  =$_POST["odcilindrosa"];
$odejesa = $_POST["odejesa"];
$dprismaa = $_POST["dprismaa"];
$oddiciona = $_POST["oddiciona"];
$sugeridos = "";
$diagnostico = $_POST["diagnostico"];
$medicamento = $_POST["medicamento"];
$observaciones = $_POST["observaciones"];
$oiesferasf = $_POST["oiesferasf"];
$oicolindrosf = $_POST["oicolindrosf"];
$oiejesf = $_POST["oiejesf"];
$oiprismaf = $_POST["oiprismaf"];
$oiadicionf = $_POST["oiadicionf"];
$odesferasf = $_POST["odesferasf"];
$odcilindrosf = $_POST["odcilindrosf"];
$odejesf = $_POST["odejesf"];
$dprismaf = $_POST["dprismaf"];
$oddicionf  = $_POST["oddicionf"];
$odavsclejos = "";
$odavphlejos = "";
$odavcclejos= "";
$odavsccerca = "";
$oiavcolindrosf = "";
$oiavesferasf = "";
$oiavejesf = "";
$oiavprismaf = "";
$oiavadicionf = "";
$prisoicorrige = "";
$addodcorrige = "";
$prisodcorrige = "";
$addoicorrige ="";
$addoicorrige ="";
$ishihara ="";
$amsler = "";
$anexos = "";
$dip = $_POST["dip"];
$oddip = $_POST["oddip"];
$oidip = $_POST["oidip"];
$aood = $_POST["aood"];
$aooi = $_POST["aooi"];
$apod = $_POST["apod"];
$opoi = $_POST["opoi"];
$fecha_consulta = $hoy;
$p_evaluado = $_POST["p_evaluado"];
$parentesco_evaluado = $_POST["parentesco_evaluado"];
$tel_evaluado = $_POST["tel_evaluado"];


$sql="insert into consulta VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";
$sql=$conectar->prepare($sql);
$sql->bindValue(1,$motivo);
$sql->bindValue(2,$patologias);
$sql->bindValue(3,$id_paciente);
$sql->bindValue(4,$id_usuario);
$sql->bindValue(5,$fecha_reg);
$sql->bindValue(6,$oiesfreasl);
$sql->bindValue(7,$oicilindrosl);
$sql->bindValue(8,$oiejesl);
$sql->bindValue(9,$oiprismal);
$sql->bindValue(10,$oiadicionl);
$sql->bindValue(11,$odesferasl);
$sql->bindValue(12,$odcilndrosl);
$sql->bindValue(13,$odejesl);
$sql->bindValue(14,$odprismal);
$sql->bindValue(15,$odadicionl);
$sql->bindValue(16,$oiesferasa);
$sql->bindValue(17,$oicolindrosa);
$sql->bindValue(18,$oiejesa);
$sql->bindValue(19,$oiprismaa);
$sql->bindValue(20,$oiadiciona);
$sql->bindValue(21,$odesferasa);
$sql->bindValue(22,$odcilindrosa);
$sql->bindValue(23,$odejesa);
$sql->bindValue(24,$dprismaa);
$sql->bindValue(25,$oddiciona);
$sql->bindValue(26,$sugeridos);
$sql->bindValue(27,$diagnostico);
$sql->bindValue(28,$medicamento);
$sql->bindValue(29,$observaciones);
$sql->bindValue(30,$oiesferasf);
$sql->bindValue(31,$oicolindrosf);
$sql->bindValue(32,$oiejesf);
$sql->bindValue(33,$oiprismaf);
$sql->bindValue(34,$oiadicionf);
$sql->bindValue(35,$odesferasf);
$sql->bindValue(36,$odcilindrosf);
$sql->bindValue(37,$odejesf);
$sql->bindValue(38,$dprismaf);
$sql->bindValue(39,$oddicionf);
$sql->bindValue(40,$odavsclejos);
$sql->bindValue(41,$odavphlejos);
$sql->bindValue(42,$odavcclejos);
$sql->bindValue(43,$odavsccerca);
$sql->bindValue(44,$oiavcolindrosf);
$sql->bindValue(45,$oiavesferasf);
$sql->bindValue(46,$oiavejesf);
$sql->bindValue(47,$oiavprismaf);
$sql->bindValue(48,$oiavadicionf);
$sql->bindValue(49,$prisoicorrige);
$sql->bindValue(50,$addodcorrige);
$sql->bindValue(51,$prisodcorrige);
$sql->bindValue(52,$addoicorrige);
$sql->bindValue(53,$addoicorrige);
$sql->bindValue(54,$ishihara);
$sql->bindValue(55,$amsler);
$sql->bindValue(56,$anexos);
$sql->bindValue(57,$dip);
$sql->bindValue(58,$oddip);
$sql->bindValue(59,$oidip);
$sql->bindValue(60,$aood);
$sql->bindValue(61,$aooi);
$sql->bindValue(62,$apod);
$sql->bindValue(63,$opoi);
$sql->bindValue(64,$fecha_consulta);
$sql->bindValue(65,$p_evaluado);
$sql->bindValue(66,$parentesco_evaluado);
$sql->bindValue(67,$tel_evaluado);
$sql->execute();

}

public function get_ultima_venta($id_paciente){
  $conectar=parent::conexion();
  parent::set_names();
  $sql="select*from ventas where id_paciente=? order by id_ventas desc limit 1;";
  $sql=$conectar->prepare($sql);
  $sql->bindValue(1,$id_paciente);
  $sql->execute();
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
}

public function buscar_venta_consulta($id_paciente,$numero_venta){
  $conectar= parent::conexion();
  parent::set_names();
  $sql="select*from detalle_ventas where id_paciente=? and numero_venta=?;";
  $sql = $conectar->prepare($sql);
  $sql->bindValue(1,$id_paciente);
  $sql->bindValue(2,$numero_venta);
  $sql->execute();
  //return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

}





}

?>
