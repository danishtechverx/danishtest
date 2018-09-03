function validacionSimple(id,min_digitos){
	var ok=1;
	var casilla=jQuery("#"+id);
	
	if(min_digitos!=""){
		if(casilla.val().length<min_digitos){ ok=0; }
	}
	else{
		if(casilla.val().length<1){ ok=0; }
	}
	
	return ok;
}

function validacionAlfabetica(id,min_digitos){
	var ok=1;
	var patron=/[^a-zA-Z \-'áéíóúÁÉÍÓÚñÑäëïöüÄËÏÖÜâêîôûÂÊÎÔÛ]/;
	var casilla=jQuery("#"+id);
	txt=casilla.val();
	
	if(min_digitos!=""){
		if(casilla.val().length<min_digitos){ ok=0; }
	}
	if(casilla.val().length<1){ ok=0; }
	if(patron.test(txt)){ ok=0; }
	return ok;
}

function validacionNumerica(id,min_digitos){
	var ok=1;
	var patron=/\D/;
	var casilla=jQuery("#"+id);
	
	if(min_digitos!=""){
		if(casilla.val().length<min_digitos){ ok=0; }
	}
	if(casilla.val().length<1){ ok=0; }
	if(patron.test(casilla.val())){ ok=0; }
	
	return ok;
}

function validarEmail(id){
	var casilla=jQuery("#"+id);
	var ok=1;
	var es_email=/^(.+\@.+\..+)$/;
	if(!es_email.test(casilla.val())){ ok=0; }
	
	return ok;
}

function validarSelect(id){
	var ok=1;
	var casilla=jQuery("#"+id);
	if(casilla.val()=="" || casilla.val()==0){ ok=0; }

	return ok;
}

function validarCheckbox(id){
	var ok=1;
	var casilla=jQuery("#"+id);
	
	if(casilla.is(':checked')){ ok=0; }

	return ok;
}

function validarRadio(nombre){
	var ok=0;
	radios=jQuery('input[name='+nombre+']');
	
	for(var i=0;i<radios.length;i++){
		if(radios[i].checked){ ok=1; }
	}
	
	if(ok==1){return true}
	if(ok==0){return false}
	return true
	
}

/* LIMITAR CARACTERES ****/
function maximo(e,obj,num){
	k = (document.all) ? e.keyCode : e.which;
	if(k==0 || k==8 || k==13) return true;
	else{ return obj.val().length<num; }
}

function soloUsername(e){
	k = (document.all) ? e.keyCode : e.which;
	if(k==0 || k==8 || k==13) return true;
	var patron = /\w/;
	return patron.test(String.fromCharCode(k));
}

function soloPassword(e){
	k = (document.all) ? e.keyCode : e.which;
	if(k==0 || k==8 || k==13) return true;
	var patron = /\w/;
	return patron.test(String.fromCharCode(k));
}

function soloRut(e){
	k = (document.all) ? e.keyCode : e.which;
	if(k==0 || k==8 || k==13) return true;
	var patron = /[kK0-9]/;
	return patron.test(String.fromCharCode(k));
}

function soloEmail(e){
	k = (document.all) ? e.keyCode : e.which;
	if(k==0 || k==8 || k==13) return true;
	var patron = /[a-zA-Z\@\.\-\_0-9]/;
	return patron.test(String.fromCharCode(k));
}

function soloTelefono(e){
	k = (document.all) ? e.keyCode : e.which;
	if(k==0 || k==8 || k==13) return true;
	var patron=/[0-9\s\-\)\(]/;
	return patron.test(String.fromCharCode(k));
}

function soloNumeros(e){
	k = (document.all) ? e.keyCode : e.which;
	if(k==0 || k==8 || k==13) return true;
	var patron = /\d/;
	return patron.test(String.fromCharCode(k));
}

function soloTexto(e){
	k = (document.all) ? e.keyCode : e.which;
	if(k==0 || k==8 || k==13) return true;
	var patron=/[a-zA-Z \-'áéíóúÁÉÍÓÚñÑäëïöüÄËÏÖÜâêîôûÂÊÎÔÛ]/;
	return patron.test(String.fromCharCode(k));
}

function soloPrecio(e){
	k = (document.all) ? e.keyCode : e.which;
	if(k==0 || k==8 || k==13) return true;
	var patron = /[0-9\.,]/;
	return patron.test(String.fromCharCode(k));
}
/*************************/

/* AUTOMATIZAR AL INICIO */
jQuery(document).ready(automatizar);
function automatizar(){
	jQuery('.form-control').each(function(){	
		if(jQuery(this).hasClass('solo_email')){
			jQuery(this).keypress(function(event){
				return soloEmail(event);
			});
		}
		if(jQuery(this).hasClass('solo_numeros')){
			jQuery(this).keypress(function(event){
				return soloNumeros(event);
			});
		}
	});
}
/*************************/