/* FUNCIONES INICIALES ******/
var to;
var mobile=false;
var carrusel;
var w=$(window).width();
$(document).ready(function($) {				
	if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){mobile=true;}
	
	calcular();
	
	$("#header").sticky({topSpacing:0});
		
	$('#send').click(function(event){
		return false;
	});
		
	$("#sidebar").stick_in_parent({
		parent:'.parent',
		offset_top:70,
		recalc_every:1
	});
	
	if(w<=1023){
		if($('#sidebar').length){
			$("#sidebar").trigger("sticky_kit:detach");
		}
	}
	
	$('.menu-trigger').click(function(){
		$(this).toggleClass('close-menu');
		$('body').toggleClass('close-menu');
		$(".menu-responsive").slideToggle("fast");
		return false;
	});
	
	
	$('.menu-item-has-children > a').click(function(){
		$(".menu-responsive .menu ul").slideToggle("fast");
		return false;
	});
	
	var menus=$(".menu li");
	for(i=0;i<menus.length;i++){
		$(menus[i]).mouseover(function(){
			$(this).addClass("hover");
		}).mouseout(function() {
			$(this).removeClass("hover");
		});
	}
	
	$(".listado .modulo").each(function(obj){
		$(this).mouseover(function(){
			$(this).addClass("hover");
		});
		$(this).mouseout(function(){
			$(this).removeClass("hover");
		});
	});
	
	$(".relacionados .mod").each(function(obj){
		$(this).mouseover(function(){
			$(this).addClass("hover");
		});
		$(this).mouseout(function(){
			$(this).removeClass("hover");
		});
	});
	
	/*$('.desplegables').accordion({ 
		active:0,
		selectedClass:'activo', 
		header:'.desplegador',
		autoHeight:false,
		heightStyle:"content",
		collapsible:true,
	});
	
	$("#accordiontours").accordion({
		active:0,
		selectedClass:'activo', 
		header:'.desplegador',
		autoHeight:false,
		heightStyle:"content",
		collapsible:true,
  		create: function( event, ui ) {
			calcularTour();
		}
	});
	
	$("#accordionblog").accordion({
		active:0,
		selectedClass:'activo', 
		header:'.desplegador',
		autoHeight:false,
		heightStyle:"content",
		collapsible:true,
  		create: function( event, ui ) {
			calcularBlog();
		}
	});
	*/

	carrusel=$('#carrusel').lightSlider({
		item:1,
		loop:true,
		controls:false,
		enableDrag:false,
		slideMargin:0,
		pager:true,
		slideMove:1,
		easing:'cubic-bezier(0.25, 0, 0.25, 1)',
		mode:'fade',
		speed:600,
		pause:6000,
		auto:true,
		onSliderLoad:function(){
			$('.carrusel').removeClass('cS-hidden');
		}
	}); 
	$('#avanzar1').on('click', function () {
		carrusel.goToNextSlide();
		return false;
	});
	$('#retroceder1').on('click', function () {
		carrusel.goToPrevSlide();
		return false;
	}); 
	
	$('.selectpicker').selectpicker();
	$('.nav').tabCollapse();
	
	$(window).resize(function() {
		var w=$(window).width();
		 
		$('.listado .contenido').css('height','auto');
		
		calcular();		
		$("#accordiontours").accordion("destroy").accordion({
			active:0,
			selectedClass:'activo', 
			header:'.desplegador',
			autoHeight:false,
			heightStyle:"content",
			collapsible:true,
			create: function( event, ui ) {
				calcularTour();
			}
		});
		
		$("#accordionblog").accordion("destroy").accordion({
			active:0,
			selectedClass:'activo', 
			header:'.desplegador',
			autoHeight:false,
			heightStyle:"content",
			collapsible:true,
			create: function( event, ui ) {
				calcularBlog();
			}
		});
		
		if(w<=1023){
			if($('#sidebar').length){
				$("#sidebar").trigger("sticky_kit:detach");
			}
		}
		
	});
		
});
/****************************/
$(function(){
	$(window).scroll(function(){
		var scroll=$(window).scrollTop();
		if(mobile){
			if(scroll>=300){$(".contactanos").fadeIn();} 
			else {$(".contactanos").fadeOut();}
		}
	});
});

function calcular(){
	if($('#listadotours').length){
		var maxHeight=Math.max.apply(null, $("#listadotours .contenido").map(function(){return $(this).outerHeight();}).get());
		maxHeight=parseInt(maxHeight);
		$("#listadotours .contenido").css("height",maxHeight);
	}
	
	if($('#listadoblog').length){
		var maxHeight=Math.max.apply(null, $("#listadoblog .contenido").map(function(){return $(this).outerHeight();}).get());
		maxHeight=parseInt(maxHeight);
		$("#listadoblog .contenido").css("height",maxHeight);
	}
}

function calcularTour(){
	if($('#listadotours2').length){
		var maxHeight=Math.max.apply(null, $("#listadotours2 .contenido").map(function(){return $(this).outerHeight();}).get());
		maxHeight=parseInt(maxHeight);
		$("#listadotours2 .contenido").css("height",maxHeight);
	}
}

function calcularBlog(){
	if($('#listadoblog2').length){
		var maxHeight=Math.max.apply(null, $("#listadoblog2 .contenido").map(function(){return $(this).outerHeight();}).get());
		maxHeight=parseInt(maxHeight);	
		$("#listadoblog2 .contenido").css("height",maxHeight);
	}
}

function next(){
	$(".formulario .p1").fadeOut().css("display","none");
	$(".formulario .p2").fadeIn();
}

function back(){
	$(".formulario .p2").fadeOut().css("display","none");
	$(".formulario .p1").fadeIn();
}

function validarCampos(){
	var enviar=1;
	if(!validacionSimple("nombre",4)){ enviar=0;}
	if(!validarEmail("email")){enviar=0;}
	if(!validacionNumerica("fono",6)){ enviar=0;}
	if(!$("#yes").is(':checked')){enviar=0;} 
		
	if(enviar==1){jQuery('#send').removeClass("disabled");}
	else{
		$('#send').addClass("disabled"); 
		$('#send').click(function(event){
		   event.preventDefault();
		   event.stopPropagation();
		});
	}
	
}

function redirectSuccessPage() {
  window.location.href="/kontakt?status=success";
}

function validarForm(){
	var enviar=1;
	var lang=$('#lang').val();
	var fono=$('#fono').val();
	$(".form-control").removeClass('requerido');
	
	if(!$("#send").hasClass('disabled')){
		if(!validacionSimple("nombre",4)){ enviar=0; $("#nombre").addClass('requerido');}
		if(!validarEmail("email")){enviar=0; $("#email").addClass('requerido');}
		if(!validacionSimple("fono",5)){ enviar=0; $("#fono").addClass('requerido');}
		if(!$("#yes").is(':checked')){enviar=0; $("label").addClass('requerido');} 
		
		if(enviar==1){
			$('#send').removeClass("disabled");
			$('#alerta').fadeOut();
			var request=$.ajax({
				url: "/wp-content/themes/mokaller/ajax/form.php",
				method:"POST",
				dataType:"html",
				data: $("#form").serialize(),
				beforeSend:function(xhr){
					$(".formulario").addClass("especial");
					$("#form").fadeOut().css("display","none");
					$("#preloader").fadeIn();
				},
			});
			
			request.done(function(msg) {
				$("#preloader").fadeOut().css("display","none");
				document.getElementById("form").reset();
				
				var layer=dataLayer.push({'event':'GAevent','eventCategory':'lead', 'eventAction': 'submit', 'eventLabel':fono});
				if(layer===false){ setTimeout(redirectSuccessPage, 5000); }
				// window.location.href="/kontakt?status=success";
			});
		}
		else{
			$('#alerta').fadeIn();
			setTimeout(function(){ $('#alerta').fadeOut(); $(".form-control").removeClass('requerido');$("label").removeClass('requerido');},5000);
		}
	} 
	else{return false;}
}