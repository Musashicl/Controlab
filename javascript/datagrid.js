var selectedId = '';

$(function(){
    applyGridStyle();
    
    $('#filter').keyup(function(event) {  
        //if esc is pressed or nothing is entered  
        if (event.keyCode == 27 || $(this).val() == '') {  
            //if esc is pressed we want to clear the value of search box  
            $(this).val('');  
            //we want each row to be visible because if nothing  
            //is entered then all rows are matched.  
            $('tbody tr').removeClass('visible').show().addClass('visible');  
        }  
  
        //if there is text, lets filter  
        else {  
            filter('tbody tr', $(this).val());  
        }  
        $('.visible td').removeClass('ui-widget-content2');  
        zebraRows('.visible:odd td', 'ui-widget-content2');  
    });
    
    
    /*$('.agregar').live('click', function (event){
        event.preventDefault();
        alert('funciona el click');
        //showAddIngreso();
    });*/


    $('.agregar').click( function(){ showAddIngreso();  });

    $('.eliminar').click( function(){ showEliminar(selectedId);  });
	
    $('.soe').click( function (event) {
            if (selectedId != '') {
                showSoe(selectedId);
            } else {
                $('#dialog').attr({ 'title' : 'soe' }); //ARREGLAR EL CAMBIO DE TITULO PARA DIALOGO :S 
                $('#dialog span').html('No hay ningun ingreso seleccionado');
                $('#dialog').position({my: "center", at: "center", of: window}).dialog('open');
            } 
    }) ;

   /* $('.soe').live('click', function (event){ //solo toma el primer elemento seleccionado para ver el soe..
        event.preventDefault();
		if (selectedId != '') {
			showSoe(selectedId);	
		} else {
			$('#dialog').attr({title : "SOE"});
			$('#dialog span').html('No hay ningun ingreso seleccionado');
			$('#dialog').dialog('open');
			
		} 
    });*/
	
	
	
	$('#per_page').change( function () {
		var page = $(this).val();
		loadGrid(page,1);      
	});
    
    
 	applyPagination();    
});


function applyPagination() { /* aplica la paginacion del grid de los equipos, */

      $("#ajax_paging a").click(function() {
	        var url = $(this).attr("href");
	        $.ajax({
		          type: "POST",
		          data: "ajax=1",
                          data: {per_page: $('#per_page').val(), 
                                 ajax: 1, 
                                 sort_by : $('thead th a.current_sort').attr('name'), 
                                 sort_order: $('thead th a.current_sort').attr('sort_order'),
                                 reorder: 'true' },
		          url: url,
		          dataType: 'json',
		          beforeSend: function() {
		            $('#ajaxLoadAni').fadeIn('fast');  
		            $("#gridIngreso").fadeOut('fast');  
		            $("#gridIngreso").html('');
		            $("#ajax_paging").html('');
		          },
		          success: function(resp) {
		            $("#gridIngreso").html(resp.grid);
		            $("#ajax_paging").html(resp.pag);
		            applyGridStyle();
		            applyPagination();
                    $('#ajaxLoadAni').fadeOut('fast');
		            $("#gridIngreso").fadeIn('fast');  
		            
		          }
	        });
	        return false;
      });

}

function zebraRows(selector, className) {
    if (!selector) selector = '.dg_form tbody tr:odd td';
    if (!className) className = 'ui-widget-content2';
    $(selector).removeClass(className).addClass(className)
}

function filter(selector, query) {
    query = $.trim(query); //trim white space  
    query = query.replace(/ /gi, '|'); //add OR for regex query  
  
    $(selector).each(function() {  
    ($(this).text().search(new RegExp(query, "i")) < 0) ? $(this).hide().removeClass('visible') : $(this).show().addClass('visible');  
  });  
  
}

function showAddIngreso() {
    
    divClone = $('#popEquipoContent').clone();
    if (formOpen == 0) {
        $.ajax ({
            url: 'general/addIngresoForm',
            success: function (resp) {
                $('#popEquipoContent').html(resp)
                loadPopup(550);
            }
        });
       
    } else {
        disablePopup();
        $('#popEquipoContent').replaceWith(divClone);
        $.ajax ({
            url: 'general/addIngresoForm',
            success: function (resp) {
                $('#popEquipoContent').html(resp)
                loadPopup(550);
            }
        });
    }
    
}

function showEdit(id) {
    divClone = $('#popEquipoContent').clone();
    if (formOpen == 0) {
        $.ajax({
            type:'post',
            url: 'general/editIngresoForm',
            data: 'id='+id,
            success: function (resp) {
                $('#popEquipoContent').html(resp)
                loadPopup(590);
            }
        });
    } else {
        disablePopup();
        $('#popEquipoContent').replaceWith(divClone);
        $.ajax({
            url: 'general/editIngresoForm',
            data: 'id='+id,
            success: function (resp) {
                $('#popEquipoContent').html(resp)
                loadPopup(590);
            }
        });
    }
    
}

function showSoe(id) {

	alert('mostrar sow aca con el id ' + id);	
}

function showEliminar(id) { // elimina registro con id seleccionado.
   
    $("eliminarDialog").dialog({
      resizable: false,
      height:140,
      modal: true,
      buttons: {
        "Delete all items": function() {
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
   /* $("eliminarDialog").dialog({
        resizable: false,
        height:140,
        modal:true,
        buttons: {
            "Eliminar Ingreso" : function (id){
                $.ajax({
                    type:'post',
                    url: 'general/deleteIngreso',
                    data: 'id='+id,
                    success: function (resp) { 
                        $(this).close();
                        loadGrid();
                        alert(' Se elimino el ingreso con id '+ resp.id);

                    }
                });
            }
        }
    });*/

    alert( 'aca se elimina id : ' + id);
}

function applyGridStyle() {
	selectedId = '';
    
    $('#gridIngreso tbody tr').addClass('visible');
    //Table Behavior
    
    /*$('.dg_check_toggler').click(function(){ //checkbox general. select all
        var checkboxes = $(this).parents('table').find('.dg_check_item');
        if($(this).is(':checked')){
            checkboxes.attr('checked','true');
        } else {
            checkboxes.removeAttr('checked');
        }
    });*/
    
    $('.dg_check_item').click( function() { //para agregar checkboxes
        if($(this).is(':checked')){
            $(this).parents('tr').addClass('.ui-state-active');
        }
    });
    
    //Table Styler
    $("#gridIngreso tr").hover(
        function() {
            $(this).children("td").addClass("ui-state-hover");
        },
        function() {
            $(this).children("td").removeClass("ui-state-hover");
        }
        );
    $("#gridIngreso tr").click(function(){
        $(this).children("td").toggleClass("ui-state-highlight2 selected bordecolor");
		if(selectedId == '') {
			selectedId = $(this).children("td").first('td').text();
		} else {
			selectedId = '';
		}
		
    });
    // Table Styler End
	
	$('#gridIngreso td').dblclick(function(){  // abre dialogo editar para los ingresos con dbl click
	
       var id = $('td:first', $(this).parents('tr')).text();
       showEdit(id); 
    });		
    
    $('thead th a').click(function () {  //cambia el sort order de la grilla
        loadGrid($('#per_page').val(), '1', $(this).attr('name') ,$(this).attr('sort_order'), 1 );
    });
}


