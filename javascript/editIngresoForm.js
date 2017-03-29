$( function () {
    var validated = 0;
        $('#fingreso').datetimepicker();
        $('#fsalida').datetimepicker();

    
    $('#formEditIngreso').validationEngine('attach',{ onSuccess: function() {
                                                        validated = 1;
                                                }, onFailure: function () {
                                                        validated= 0;
                                                }
    });
    
    $('#enviarEditForm').click(function(e) {
       e.preventDefault();
      if (validated == 1) {
           editIngreso();
      }
    });
    
    
});


function editIngreso() {
    $('#ajaxLoadAni').fadeIn('slow');
    var data = $('#formEditIngreso').serialize();
    
    $.ajax({
        type: 'post',
        url: editIngresoUrl,
        data: data,
        dataType: 'json',
        success: function (resp) {
            $('#ajaxLoadAni').fadeOut('slow');
            if (resp.error) {
                $('#ingresoDialog span').html('');
                $.each(resp.error, function (){
                    $('#ingresoDialog span').html(resp.error).appendTo();
                });
                $('#ingresoDialog').dialog('open');
            } else {
                disablePopup();
                $('#ingresoDialog span').html(resp.edited);
                $('#ingresoDialog').dialog('open');
                loadGrid();
            }
        }
    });
    
}