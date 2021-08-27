// $.getJSON("https://s3.amazonaws.com/dolartoday/data.json", function(data){
// });

//Variables
$(document).ready(function(){
	get_DolarfromDB();	
});

function get_DolarfromDB(){
$.ajax({      
      dataType: "json",              
      url: '/SmartShop/Dolar/getDolarfrom_DB',            
      contentType: 'application/json; chartset=utf-8',
      processData: false,
      beforeSend: function(){
        $("#dolar_DB").val('Cargando...');        
        $("#marcaje_DB").html('Cargando...');
      },
      success: function(datos){            
      //Informacion obtenida del modelo
      //En caso de no haebr datos retorna un 0 para no enviar la respuesta al front. 
        if(datos.respuesta == 0){                    
        $("#marcaje_DB").html('Vuelvelo a Intentar...');
        $("#dolar_DB").val('Vuelvelo a Intentar...');         
        }else{
          //en caso de haber respuesta...
        var marcaje = datos.marcaje;            
        var precio_dolar = datos.precio_dolar;
        var seleccion = datos.seleccion;
        $('#marcaje_DB').html(marcaje);
        $('#dolar_DB').val(precio_dolar);
        $('#TasaEstablecida_BD').html(precio_dolar);

        //Se establecen los checks 
        if(seleccion == 'oficial'){
         $('#check_oficial').attr('checked','true'); 
        }else if(seleccion == 'paralelo'){
          $('#check_paralelo').attr('checked','true'); 
        }else{
          
          $('#check_otra').attr('checked','true'); 
          $('#otra_API').val(precio_dolar); 
        }
        } 
      },
      error: function(xhr, textStatus, error){        
        $("#marcaje_DB").html('Vuelvelo a Intentar...');
        $("#dolar_DB").val('Vuelvelo a Intentar...');
          
      }
    });
}

