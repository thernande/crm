function ajax_contacts(datos)
{        
          $.ajax({
               type: "GET",
               url: "/opportunities/search_contact/"+datos.elements["customer_id"].value,    
               beforeSend: function() {
                   $('#ldr').html('<div class="rating-flash" id="cargando_div" style="position:relative;left:150px">Loading  <img src="/img/ajax-loader_mini.gif"></div>');
                   },
               success: function(msg){
                $('#ldr').html("");                               //borramos el gif animado del proceso de carga
                $('#comboprovincias').html(msg); //reemplaza el contenido del div comboprovincias con el html que genera busca_provincia.ctp
               }
             });
    }
};
