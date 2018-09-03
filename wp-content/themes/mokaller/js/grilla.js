var w=$(window).width();
$(document).ready(function($) {				
	var lang=$("#gidioma").val();
	if(lang=="de"){
		var frase1="Load More";
		var frase2="Loading...";
		var frase3="Load More";
	}
	else{
		var frase1="Mehr Artikel laden";
		var frase2="Wird geladen...";
		var frase3="Mehr Reisen ansehen";
	}
	
	$('#blogrid').mediaBoxes({
		columns:3,
		boxesToLoadStart: 9,
		boxesToLoad:3,
		horizontalSpaceBetweenBoxes:30,
		verticalSpaceBetweenBoxes:30,
		popup:false,
		lazyLoad:false,
		thumbnailOverlay:false, 
		LoadingWord:frase2,
        loadMoreWord:frase1,
		resolutions: [
            {
                maxWidth:991,
                columns:2,
            },
            {
                maxWidth:640,
                columns:1,
            },
        ],
	}); 
	
	$('#tourgrid').mediaBoxes({
		columns:3,
		boxesToLoadStart: 9,
		boxesToLoad:3,
		horizontalSpaceBetweenBoxes:30,
		verticalSpaceBetweenBoxes:40,
		popup:false,
		lazyLoad:false,
		thumbnailOverlay:false, 
		LoadingWord:frase2,
        loadMoreWord:frase3,
		resolutions: [
            {
                maxWidth:991,
                columns:2,
            },
            {
                maxWidth:640,
                columns:1,
            },
        ],
	}); 
});
/****************************/
