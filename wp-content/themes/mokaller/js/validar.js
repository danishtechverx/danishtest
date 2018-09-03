function validacionSimple(id,min_digitos){
	var ok=1;
	var casilla=$("#"+id);
	
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
	var casilla=$("#"+id);
	txt=casilla.val();
	
	if(min_digitos!=""){
		if(casilla.val().length<min_digitos){ ok=0; }
	}
	if(casilla.val().length<1){ ok=0; }
	if(patron.test(txt)){ ok=0; }
	return ok;
}

function validarFecha(id){
	var ok=0;
	var patron=/^\d{1,2}\/\d{1,2}\/\d{4}$/;
	var casilla=$("#"+id);

	if(patron.test(casilla.val())){ ok=1; }
	return ok;
}


function validacionNumerica(id,min_digitos){
	var ok=1;
	var patron=/\D/;
	var casilla=$("#"+id);
	
	if(min_digitos!=""){
		if(casilla.val().length<min_digitos){ ok=0; }
	}
	if(casilla.val().length<1){ ok=0; }
	if(patron.test(casilla.val())){ ok=0; }
	
	return ok;
}

function validarEmail(id){
	var casilla=$("#"+id);
	var ok=1;
	var es_email=/^(.+\@.+\..+)$/;
	if(!es_email.test(casilla.val())){ ok=0; }
	
	return ok;
}

function validarRutCompleto(rut){
	var ok=0;
	var rut=$("#"+rut).val();
	if(rut.substr(rut.length-1,1)!="K" && rut.substr(rut.length-1,1)!="k"){
		var dv=rut.substr(rut.length-1,1);
		rut=rut.substr(0,rut.length-1);
	}
	else{ dv="K"; }
	rut=rut.replace(/\D/g,"");

	var largo=rut.length;
	var suma=0;
	var mult=2;
	largo--;
	
	while(largo>=0){
		suma=suma+(rut.charAt(largo)*mult);
		if(mult>6){ mult=2; }
		else { mult++; }
		largo--;
	}

	var resto=suma%11;
	var digito=11-resto;
	
	if(digito==10){ digito="K"; }
	if(digito==11){ digito=0; }
	
	if(!rut || !dv){ ok=0; }
	else if(digito!=dv){ ok=0; }
	else { ok=1; }
	
	return ok;
}

function validarRutSeparado(rut,dv){
	var ok=0;
	var rut=$(rut).val();
	var dv=$(dv).val();

	var largo=rut.length;
	var suma=0;
	var mult=2;
	largo--;
	
	while(largo>=0){
		suma=suma+(rut.charAt(largo)*mult);
		if(mult>6){ mult=2; }
		else { mult++; }
		largo--;
	}

	var resto=suma%11;
	var digito=11-resto;
	
	if(digito==10){ digito="k"; }
	if(digito==11){ digito=0; }
	
	if(!rut || !dv){ ok=0; }
	else if(digito!=dv){ ok=0; }
	else { ok=1; }
	
	return ok;
}

function validarSelect(id){
	var ok=1;
	var casilla=$("#"+id);
	var valor=casilla.val();
	if(valor){if(valor=="" || valor==0){ ok=0; }}
	else{ok=0;}
	return ok;
}

function validarCheckbox(nombre){
	var ok=1;
	var casillas=$('input[name="'+nombre+'"]').length;
	if(casillas>0){ok=1;}
	else{ok=0;}
	
	return ok;
}

function validarRadio(nombre){
	var ok=0;
	var radios=$('input[name="'+nombre+'"]');
	
	 if (radios.is(':checked')) {
        ok=1;
    } else {
        ok=0;
    }
	
	if(ok==1){
		return true
	}
	if(ok==0){
		return false
	}
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
$(document).ready(automatizar);
function automatizar(){
	$('.form-control').each(function(){	
		if($(this).hasClass('solo_email')){
			$(this).keypress(function(event){
				return soloEmail(event);
			});
		}
		if($(this).hasClass('solo_rut')){
			$(this).keypress(function(event){
				return soloRut(event);
			});
		}
		if($(this).hasClass('solo_numeros')){
			$(this).keypress(function(event){
				return soloNumeros(event);
			});
		}
		if($(this).hasClass('solo_password')){
			$(this).keypress(function(event){
				return soloPassword(event);
			});
		}
	});
}
/*************************/