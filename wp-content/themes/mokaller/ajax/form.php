<?php 
require_once('../../../../wp-load.php');
$accion=varpost("accion","",10);
if(!$accion){ $accion=varget("accion","",10); }

if($_SERVER['REQUEST_METHOD']=="POST" and $accion=="contacto"){
	$nombre=varpost("nombre","",255);
	$email=varpost("email","",255);
	$fono=varpost("fono","",20);
	$pasajeros=varpost("pasajeros",0,10);
	$country=varpost("destination","",255);
	$tourn=varpost("tourn","",255);
	$tourid=varpost("tourid","",255);
	$tourdmc=varpost("tourdmc","",255);
	$tourprice=varpost("tourprice","",255);
	$tourduration=varpost("tourduration","",255);
	$tourplaces=varpost("tourplaces","",2000);
	$lang=varpost("lang","",10);
	$landing=varpost("landing_name","",255);
	$adwordscampaign=varpost("awcp","",255);
	$adwordsgroup=varpost("awgr","",255);
	$adwordscoctent=varpost("awct","",255);
	$adwordskeyword=varpost("awkw","",255);
	$consulta=varpost("mensaje","",5000);
	$consulta=nl2br($consulta);
	
	$questions=$_POST['question'];
	$answers=$_POST['answer'];
	if($tourid){
	$asunto=strtoupper($lang)." Contact Tour ".$tourid;
	} else {
	$asunto=strtoupper($lang)." Contact form ".$landing;
	}
	$mensaje="";
	$mensaje.=
	"<strong>Name: </strong>$nombre <br />
	<strong>E-mail: </strong>$email <br />
	<strong>Phone: </strong>$fono <br /><br />
	";
	if($adwordscampaign){
	$mensaje.="
	<strong>AdWords Campaign ID: </strong><br />$adwordscampaign <br /><br />
	";
	}
	if($adwordsgroup){
	$mensaje.="
	<strong>AdWords Group ID: </strong><br />$adwordsgroup <br /><br />
	";
	}
	if($adwordskeyword){
	$mensaje.="
	<strong>AdWords KeyWord: </strong><br />$adwordskeyword <br /><br />
	";
	}
	if($adwordscoctent){
	$mensaje.="
	<strong>AdWords Content: </strong><br />$adwordscoctent <br /><br />
	";
	}
	if($country){
	$mensaje.="
	<strong>Country: </strong><br />$country <br /><br />
	";
	}
	if($tourn){
	$mensaje.="
	<strong>Tour: </strong><br />$tourn <br /><br />
	";
	}
	if($tourid){
	$mensaje.="
	<strong>Tour ID: </strong><br />$tourid <br /><br />
	";
	}
	if($tourdmc){
	$mensaje.="
	<strong>DMC: </strong><br />$tourdmc <br /><br />
	";
	}
	if($tourprice){
	$mensaje.="
	<strong>Price: </strong><br />$tourprice <br /><br />
	";
	}
	if($tourduration){
	$mensaje.="
	<strong>Duration: </strong><br />$tourduration <br /><br />
	";
	}
	if($tourplaces){
	$mensaje.="
	<strong>Visited places: </strong><br />$tourplaces <br /><br />
	";
	}
	$mensaje.="
	<strong>Nr. of travelers: </strong><br /> $pasajeros <br /><br />
	";
	if($consulta){
	$mensaje.="
	<strong>Message: </strong><br />$consulta <br /><br />
	";
	}
	
	if($questions and $answers){
	$mensaje.="<strong>Q&amp;A: </strong><br /><br />";
		$count=0;
		foreach($questions as $q){
			$resp=$answers[$count];
			$mensaje.="<strong>".$q."</strong><br/>";
			$mensaje.=$resp."<br/><br/>";
			$count++;
		}
	}

	$de=$nombre." <contact@mokaller.com>";
	$para="mokallertravel@gmail.com, digiusnet@gmail.com";

	$envio=enviarEmail($asunto,$mensaje,$de,$para);

	if($envio){echo "success";}
	else{echo "error";}
}

?>