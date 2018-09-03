function validateFields(){
	var enviar=1;
	if(!validacionSimple("name",4)){ enviar=0;}
	if(!validarEmail("email")){enviar=0;}
	if(!validacionNumerica("phone",6)){ enviar=0;}
	if(!jQuery("#yes").is(':checked')){enviar=0;} 
		
	if(enviar==1){jQuery('#send').removeClass("disabled");}
	else{
		jQuery('#send').addClass("disabled"); 
		jQuery('#send').click(function(event){
		   event.preventDefault();
		   event.stopPropagation();
		});
	}
	
}
function validateForm(){
	var enviar=1;
	if(!validacionSimple("name",4)){ enviar=0;}
	if(!validarEmail("email")){enviar=0;}
	if(!validacionSimple("phone",5)){ enviar=0;}
	if(!jQuery("#yes").is(':checked')){enviar=0;} 
	
	if(enviar==1){
		jQuery('#send').removeClass("disabled");
		var request=jQuery.ajax({
			url: "/wp-content/themes/adventure-tours/ajax/form.php",
			method:"POST",
			dataType:"html",
			data: jQuery("#form").serialize(),
			beforeSend:function(xhr){
				jQuery("#modal .form").fadeOut().css("display","none");
				jQuery("#preloader").fadeIn();
			}
		});
		
		request.done(function(msg) {
			if(lang=="eng"){if(msg=="success"){window.location.href="/contact-us/thank-you/";}else{window.location.reload();}}
			else{if(msg=="success"){window.location.href="/kontakt/vielen-dank/";}else{window.location.reload();}}
			
			jQuery("#preloader").fadeOut().css("display","none");
			document.getElementById("form").reset();
			jQuery('#modal').modal('toggle');
			
		});
	}
	else{return false;}
}

function setAnswer(){
	
}