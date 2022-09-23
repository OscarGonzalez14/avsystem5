<?php
include '../config/conn.php';

$id_paciente = $_POST["codigop"];
$motivo = $_POST["motivo"];
$patologias = $_POST["patologias"];
$id_usuario = $_POST["id_usuario"];
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
$fecha_consulta = $_POST["fecha_consulta"];

$p_evaluado = $_POST["p_evaluado"];
$parentesco_evaluado = $_POST["parentesco_evaluado"];
$tel_evaluado = $_POST["tel_evaluado"];


$conexion = new Conexion();
$cnn = $conexion->getConexion();

$sql = "INSERT INTO consulta (motivo,patologias,id_paciente,id_usuario,oiesfreasl,oicilindrosl,oiejesl,oiprismal,oiadicionl,odesferasl,odcilndrosl,odejesl,odprismal,odadicionl,oiesferasa,oicolindrosa,oiejesa,oiprismaa,oiadiciona,odesferasa,odcilindrosa,odejesa,dprismaa,oddiciona,sugeridos,diagnostico,medicamento,observaciones,oiesferasf,oicolindrosf,oiejesf,oiprismaf,oiadicionf,odesferasf,odcilindrosf,odejesf,dprismaf,oddicionf,odavsclejos,odavphlejos,odavcclejos,odavsccerca,odavcccerca,oiavesferasf,oiavcolindrosf,oiavejesf,oiavprismaf,oiavadicionf,prisoicorrige,addodcorrige,prisodcorrige,addoicorrige,ishihara,amsler,anexos,dip,oddip,oidip,aood,aooi,apod,opoi,fecha_consulta,p_evaluado,parentesco_beneficiario,telefono_beneficiario) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

$statement = $cnn->prepare( $sql );
	//Enlazar los parámetros de la consulta con los valores del formulario

$statement->bindParam(1,$motivo, PDO::PARAM_STR );
$statement->bindParam(2,$patologias, PDO::PARAM_STR);
$statement->bindParam(3,$id_paciente, PDO::PARAM_INT); 
$statement->bindParam(4,$id_usuario, PDO::PARAM_INT);
$statement->bindParam(5,$oiesfreasl, PDO::PARAM_STR );    
$statement->bindParam(6,$oicilindrosl,PDO::PARAM_STR );   
$statement->bindParam(7,$oiejesl, PDO::PARAM_STR );       
$statement->bindParam(8,$oiprismal, PDO::PARAM_STR );     
$statement->bindParam(9,$oiadicionl, PDO::PARAM_STR );    
$statement->bindParam(10,$odesferasl, PDO::PARAM_STR );    
$statement->bindParam(11,$odcilndrosl, PDO::PARAM_STR );   
$statement->bindParam(12,$odejesl, PDO::PARAM_STR );       
$statement->bindParam(13,$odprismal, PDO::PARAM_STR );     
$statement->bindParam(14,$odadicionl,PDO::PARAM_STR );     
$statement->bindParam(15,$oiesferasa, PDO::PARAM_STR );    
$statement->bindParam(16,$oicolindrosa,PDO::PARAM_STR );   
$statement->bindParam(17,$oiejesa, PDO::PARAM_STR );       
$statement->bindParam(18,$oiprismaa,  PDO::PARAM_STR );    
$statement->bindParam(19,$oiadiciona,PDO::PARAM_STR );     
$statement->bindParam(20,$odesferasa ,PDO::PARAM_STR );   
$statement->bindParam(21,$odcilindrosa, PDO::PARAM_STR );  
$statement->bindParam(22,$odejesa,   PDO::PARAM_STR );     
$statement->bindParam(23,$dprismaa, PDO::PARAM_STR );      
$statement->bindParam(24,$oddiciona, PDO::PARAM_STR );     
$statement->bindParam(25,$sugeridos, PDO::PARAM_STR );    
$statement->bindParam(26,$diagnostico,PDO::PARAM_STR );    
$statement->bindParam(27,$medicamento, PDO::PARAM_STR );   
$statement->bindParam(28,$observaciones,PDO::PARAM_STR );
$statement->bindParam(29,$oiesferasf,PDO::PARAM_STR );
$statement->bindParam(30,$oicolindrosf,PDO::PARAM_STR );
$statement->bindParam(31,$oiejesf,PDO::PARAM_STR );
$statement->bindParam(32,$oiprismaf,PDO::PARAM_STR );
$statement->bindParam(33,$oiadicionf,PDO::PARAM_STR );
$statement->bindParam(34,$odesferasf,PDO::PARAM_STR );
$statement->bindParam(35,$odcilindrosf,PDO::PARAM_STR );
$statement->bindParam(36,$odejesf,PDO::PARAM_STR );
$statement->bindParam(37,$dprismaf,PDO::PARAM_STR );
$statement->bindParam(38,$oddicionf,PDO::PARAM_STR );
$statement->bindParam(39,$odavsclejos,PDO::PARAM_STR );
$statement->bindParam(40,$odavphlejos,PDO::PARAM_STR );
$statement->bindParam(41,$odavcclejos,PDO::PARAM_STR );
$statement->bindParam(42,$odavsccerca,PDO::PARAM_STR );
$statement->bindParam(43,$oiavcolindrosf,PDO::PARAM_STR );
$statement->bindParam(44,$oiavesferasf,PDO::PARAM_STR );
$statement->bindParam(45,$oiavejesf,PDO::PARAM_STR );
$statement->bindParam(46,$oiavprismaf,PDO::PARAM_STR );
$statement->bindParam(47,$oiavadicionf,PDO::PARAM_STR );
$statement->bindParam(48,$prisoicorrige,PDO::PARAM_STR );
$statement->bindParam(49,$addodcorrige,PDO::PARAM_STR );
$statement->bindParam(50,$prisodcorrige,PDO::PARAM_STR );
$statement->bindParam(51,$addoicorrige,PDO::PARAM_STR );
$statement->bindParam(52,$addoicorrige,PDO::PARAM_STR );
$statement->bindParam(53,$ishihara,PDO::PARAM_STR );
$statement->bindParam(54,$amsler,PDO::PARAM_STR );
$statement->bindParam(55,$anexos,PDO::PARAM_STR );

$statement->bindParam(56,$dip,PDO::PARAM_STR );
$statement->bindParam(57,$oddip,PDO::PARAM_STR );
$statement->bindParam(58,$oidip,PDO::PARAM_STR );
$statement->bindParam(59,$aood,PDO::PARAM_STR );
$statement->bindParam(60,$aooi,PDO::PARAM_STR );
$statement->bindParam(61,$apod,PDO::PARAM_STR );
$statement->bindParam(62,$opoi,PDO::PARAM_STR );
$statement->bindParam(63,$fecha_consulta,PDO::PARAM_STR );

$statement->bindParam(64,$p_evaluado,PDO::PARAM_STR );
$statement->bindParam(65,$parentesco_evaluado,PDO::PARAM_STR );
$statement->bindParam(66,$tel_evaluado,PDO::PARAM_STR );






echo $statement->execute() ? header('Location: ../pacientes.php')
:"Consulta Registrado Exitosamente"  ;


	//vaciar memoria
	$statement->closeCursor();
	$conexion = null;