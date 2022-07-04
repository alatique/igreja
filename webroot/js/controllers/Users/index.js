var index = {
 

}


$(document).ready(function(){
  
	$("body").on("click", "#btn-filtro-membros",function(){
		window.location = ajaxurl + "users/index/"+$('#filtro-membros').val();
	});

        
});

