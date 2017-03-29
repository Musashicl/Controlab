/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$( function () {
    var validated = 0;
        $('#fingreso').datetimepicker();

    //$('#fingreso').datetimepicker();
    
    
    $('#formAddIngreso').validationEngine('attach',{ onSuccess: function() {
                                                        validated = 1;
                                                }, onFailure: function () {
                                                        validated= 0;
                                                }
    });
    
    $('#enviarAddForm').click(function(e) {
       e.preventDefault();
      if (validated == 1) {
           addIngreso();
      }
    });
    
    
});

function addIngreso () {
    $('#ajaxLoadAni').fadeIn('slow');
    var data = $('#formAddIngreso').serialize();
    
    $.ajax({
        type: 'Post',
        url: addIngresoUrl,
        data: data,
        dataType: 'json',
        success: function (resp) {
            
            $('#ajaxLoadAni').fadeOut('slow');
            if (resp.error) {
                $('#ingresoDialog span').html('');
                $.each(resp.error, function (){
                    $('#ingresoDialog span').html(error).appendTo();
                });
                $('#ingresoDialog').dialog('open');
                    
                
                    
                
//                $('#ingresoDialog span').html(resp.error);
//                $('#ingresoDialog').dialog('open');
//                
            } else {
                disablePopup();
                $('#ingresoDialog span').html('El Equipo se ingreso Correctamente con id ' + resp.id);
                $('#ingresoDialog').dialog('open');
                loadGrid();
            }
            
        }
        
    });
    
}

