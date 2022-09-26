var index = {

    dadosGraficoBarra : function(){

        var url = ajaxurl + "welcome/get-dados-grafico-barra";    
        

        jQuery.ajax({
            type: "post",
            data: {},
            cache: false,
            url: url,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $("input[name=_csrfToken]").val()},
            error: function (request, error) {
                //console.log('Erro ao buscar', request.message);
                console.log("errado");
            },
            success: function (response) {
                console.log(response.resultado);
                //alert(response.resultado.dizimos[2]);
                index.graficoBarra(response.resultado.dizimos, response.resultado.ofertas);
            }
        });

    },


	graficoBarra : function(dizimos, ofertas){


        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Dizimos e Ofertas'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Fev',
                    'Mar',
                    'Abr',
                    'Mai',
                    'Jun',
                    'Jul',
                    'Ago',
                    'Set',
                    'Out',
                    'Nov',
                    'Dez'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Reais (R$)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Dízimos',
                data: dizimos

            }, {
                name: 'Ofertas',
                data: ofertas

            }/*, {
                name: 'London',
                data: [48.9, 38.8, 39.3, 41.4, 47.0, 48.3, 59.0, 59.6, 52.4, 65.2, 59.3, 51.2]

            }, {
                name: 'Berlin',
                data: [42.4, 33.2, 34.5, 39.7, 52.6, 75.5, 57.4, 60.4, 47.6, 39.1, 46.8, 51.1]

            }*/]
        });
    },


    dadosGraficoPizza : function(){

        var url = ajaxurl + "welcome/get-dados-grafico-fidelidade";
        

        jQuery.ajax({
            type: "post",
            data: {},
            cache: false,
            url: url,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $("input[name=_csrfToken]").val()},
            error: function (request, error) {
                //console.log('Erro ao buscar', request.message);
                console.log("errado");
            },
            success: function (response) {
                console.log(response.resultado);
                //alert(response.resultado.dizimos[2]);
                index.graficoPizza(response.resultado.fieis, response.resultado.infieis);
            }
        });

    },


    graficoPizza : function(fieis, infieis){


        Highcharts.chart('container2', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Fidelidade da igreja'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Fieis',
                    y: fieis,
                    /*sliced: true,
                    selected: true*/
                }, {
                    name: 'Infiéis',
                    y: infieis
                }, /*{
                    name: 'Firefox',
                    y: 10.85
                }, {
                    name: 'Edge',
                    y: 4.67
                }, {
                    name: 'Safari',
                    y: 4.18
                }, {
                    name: 'Other',
                    y: 7.05
                }*/]
            }]
        });
    },


    dadosGraficoMeiaLua : function(){

        var url = ajaxurl + "welcome/get-dados-grafico-meia-lua";
        

        jQuery.ajax({
            type: "post",
            data: {},
            cache: false,
            url: url,
            dataType: "json",
            headers: {'X-CSRF-TOKEN': $("input[name=_csrfToken]").val()},
            error: function (request, error) {
                //console.log('Erro ao buscar', request.message);
                console.log("errado");
            },
            success: function (response) {
                console.log(response.resultado);
                index.graficoMeiaLua(response.resultado.arrolados, response.resultado.nao_arrolados);
            }
        });

    },


    graficoMeiaLua : function(arrolados, nao_arrolados){

        Highcharts.chart('container3', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false
            },
            title: {
                text: 'Membros ativos<br>vs inativos',
                align: 'center',
                verticalAlign: 'middle',
                y: 60
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            fontWeight: 'bold',
                            color: 'white'
                        }
                    },
                    startAngle: -90,
                    endAngle: 90,
                    center: ['50%', '75%'],
                    size: '110%'
                }
            },
            series: [{
                type: 'pie',
                name: 'Browser share',
                innerSize: '50%',
                data: [
                    ['Ativos', arrolados],
                    //['Separado', 13.29],
                    ['Inativos', nao_arrolados],
                    /*['Edge', 3.78],
                    ['Safari', 3.42],
                    {
                        name: 'Other',
                        y: 7.61,
                        dataLabels: {
                            enabled: false
                        }
                    }*/
                ]
            }]
        });

    }





    /*,


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
                index.listaDizimo(arrecadacao_id);
            }
        });
    }*/

    

}


$(document).ready(function(){
  
    index.dadosGraficoBarra();
    index.dadosGraficoPizza();
    index.dadosGraficoMeiaLua();
        
});

