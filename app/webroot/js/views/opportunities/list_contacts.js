



$(document).ready(function(){
 /*
 
 $('#OpportunityCustomerId').change(function(){

  var selected = $(this).val();
  
  alert(selected);  

  
  $.ajax({
   type: "POST",
   //url: '/opportunities/getContactByCustomer',
   //url: "<?php echo $this->Html->url(array('controller' => 'opportunities', 'action' => 'getContactByCustomer')); ?>/",
   url: "<?php echo $this->Html->url(array('controller' => 'opportunities', 'action' => 'add')); ?>/",
   data: "idCustomer="+selected,
   dataType: 'json',
   success: function(data){
     
    $('#OpportunityContact option').remove();
    var $el = $("#OpportunityContact");
    if (data.length > 1) {
     $el.append($("<option></option>")
       .attr("value", -1).text("Elija el contacto "));
    }
    $.each(data, function(i,items){
     $el.append($("<option></option>")
       .attr("value", items.Contact.id).text(items.Contact.name));          
    });    
   }
 


  });
 });
});
*/



$(document).ready(function() {
    $('select:eq(0)').change(function(){
        $.getJSON("<?php echo $this->Html->url(array('controller' => 'opportunities', 'action' => 'getContacts')); ?>/" + $(this).val(), function(data){
            $('select:eq(1)').empty();
            $('select:eq(1)').append("<option value=\"\">- - Seleccionar - -</option>");
            $.each(data, function(optionIndex, option) {
                var html = "<option value=\"" + option['id'] + "\">" + option['name'] + "</option>";
                $('select:eq(1)').append(html);
            })
        })  
    });
});
