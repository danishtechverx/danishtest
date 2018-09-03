<? 
require_once('../../../../wp-load.php');
$action=varpost("action","",10);
if(!$action){ $action=varget("action","",10); }

if($_SERVER['REQUEST_METHOD']=="POST" and $action=="contact"){
	$title=varpost("landing_name","",255);
	$name=varpost("name","",255);
	$email=varpost("email","",255);
	$phone=varpost("phone","",20);
	$number=varpost("number",0,10);
	$country=varpost("country","",255);
	$lang=varpost("lang","",10);
	
	$questions=$_POST['question'];
	$answers=$_POST['answer'];

	$asunto=strtoupper($lang)." Contact form ".$title;
	$mensaje="";
	$mensaje.=
	"<strong>Name: </strong>$name <br />
	<strong>E-mail: </strong>$email <br />
	<strong>Phone: </strong>$phone <br />
	<strong>Country: </strong>$country <br />
	<strong>Nr. of travelers: </strong> $number <br /><br />
	";
	
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

	$de=$name." <contact@mokaller.com>";
	$para="mokallertravel@gmail.com";

	$envio=enviarEmail($asunto,$mensaje,$de,$para);

	if($envio){echo "success";}
	else{echo "error";}
}

?>