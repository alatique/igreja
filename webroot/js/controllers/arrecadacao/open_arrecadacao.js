var addArrecadacao = {

   

	listaDizimo : function(arrecadacao_id){

        var data = {};

        var url = ajaxurl + "arrecadacao/form-dizimo/"+arrecadacao_id;    
        //$("#form-dizimo").load(url);
        jQuery.ajax({
            type: "get",
            data: data,
            cache: false,
            url: url,
            dataType: "html",
            headers: {'X-CSRF-TOKEN': $('input[name=_csrfToken]').val()},
            error: function (request, error) {
                console.log('Erro ao buscar', request.message);
            },
            success: function (response) {
                console.log(response);
                $("#form-dizimo").html(response);
            }
        });
    },


    salvaDizimo : function(){

        var arrecadacao_id = $("input[name=arrecadacao_id]").val();

        var data = {
            user_id : $("#user-id option").filter(':selected').val(),
            dizimo : $("input[name=vl_dizimo]").val(),
            oferta : $("input[name=vl_oferta]").val(),
            data : $("input[name=dt_dizimo]").val(),
            arrecadacao_id : arrecadacao_id
        };

        var url = ajaxurl + "dizimo/add";    
       
        jQuery.ajax({
            type: "post",
            data: data,
            cache: false,
            url: url,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('input[name=_csrfToken]').val()},
            error: function (request, error) {
                console.log('Erro ao buscar', request.message);
            },
            success: function (response) {
                console.log(response);
                addArrecadacao.listaDizimo(arrecadacao_id);
            }
        });
    },

    excluiDizimo : function(dizimo_id){


        var data = {
            id : dizimo_id
        };

        var arrecadacao_id = $("input[name=arrecadacao_id]").val();        
        var url = ajaxurl + "dizimo/delete";    
       

        jQuery.ajax({
            type: "post",
            data: data,
            cache: false,
            url: url,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('input[name=_csrfToken]').val()},
            error: function (request, error) {
                console.log('Erro ao buscar', request.message);
            },
            success: function (response) {
                console.log(response);
                addArrecadacao.listaDizimo(arrecadacao_id);
            }
        });
    },

    
    finalizaArrecadacao : function(vl_total, vl_dizimos, vl_ofertas, id){


        var data = {
            id         : id,
            vl_total   : vl_total,
            vl_dizimos : vl_dizimos, 
            vl_ofertas : vl_ofertas
        };


        var url = ajaxurl + "arrecadacao/finaliza";    
       

        jQuery.ajax({
            type: "post",
            data: data,
            cache: false,
            url: url,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $('input[name=_csrfToken]').val()},
            error: function (request, error) {
                console.log('Erro ao buscar', request.message);
            },
            success: function (response) {
                console.log(response);
                window.location = ajaxurl+"arrecadacao/index";
            }
        });
    }

}


$(document).ready(function(){
  
    addArrecadacao.listaDizimo($('#arrecadacao_id').val());
    

	$("body").on("click", ".btn-salva-dizimo",function(){
		addArrecadacao.salvaDizimo();
	});

    $("body").on("click", ".btn-delete-dizimo",function(){
        addArrecadacao.excluiDizimo($(this).attr('id'));
    });

    $("body").on("click", ".btn-salva-arrecadacao",function(){
        /*alert($('#total-arrecadacao').attr('data-id'));
        alert($('#total-dizimos').val());
        alert($('#total-ofertas').val());
        alert($("input[name=arrecadacao_id]").val());*/
        var vl_total = $('#total-arrecadacao').attr('data-id');
        var vl_dizimos = $('#total-dizimos').val();
        var vl_ofertas = $('#total-ofertas').val();
        var id = $("input[name=arrecadacao_id]").val();

        addArrecadacao.finalizaArrecadacao(vl_total, vl_dizimos, vl_ofertas, id);
    });
    

    
});

