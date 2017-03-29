/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var popupStatus = 0; 
var gridUp = 0;
var formOpen = 0;
var addIngresoUrl = CI_ROOT+'general/addIngreso/';
var editIngresoUrl = CI_ROOT+'general/editIngreso/';
var divClone;

$(function(){
   
   $('#ajaxLoadAni').fadeIn('slow');
   loadGrid();
   $('#ajaxLoadAni').fadeOut('slow');
   
   $('#dialog').dialog({
        autoOpen: false,
        buttons: {
            'Ok': function() {
                
                $(this).dialog('close');
                
                
            }
        }
    });


    $('#ingresoDialog').dialog({
        autoOpen: false,
        buttons: {
            'Ok': function() {
                $(this).dialog('close');
                //disablePopUp();
                
            }
        }
    });
    
    //CLOSING POPUP  
    //Click the x event!  
    $("#popupEquipoClose").click(function(){  
        disablePopup();  
    });  
        //Click out event!  
    $("#backgroundPopup").click(function(){  
        disablePopup();  
    });  
    //Press Escape event!  
    $(document).keypress(function(e){
        if (e.keyCode==27 && popupStatus==1){
            disablePopup();
        }
    });
    
    
});


function loadGrid(per_page, ajax, sort_by , sort_order, paginate ) {
    
    if (gridUp == '1' && ajax != undefined) {
        $('#grid_fill #gridIngreso').fadeOut('fast');
        gridUp= 0;
    }
	
	 if (per_page !== undefined ) {
	 
	 	$.ajax({ 
			type: 'post',
			url: CI_ROOT+'general/grid',
			data: {per_page: per_page, ajax: ajax, sort_by : sort_by, sort_order: sort_order},
			dataType: 'json',
			success: function (resp) {
				$('#grid_fill #gridIngreso').html('').html(resp.grid);
				applyGridStyle();
				$('#grid_fill #gridIngreso').fadeIn('fast');
				if (paginate !== undefined) {
                    applyPagination();
                } else {

                    $("#ajax_paging").fadeOut('fast').html('').html(resp.pag).fadeIn('fast');
                }

				
			} 			
			
		});
	 
	
	} else {
		 $('#grid_fill').load(CI_ROOT+'general/grid').fadeIn('fast');	
	}
	
    
    gridUp = 1;
    
	
    
}


function loadPopup( height){  
    //loads popup only if it is disabled  
    
    if(popupStatus==0){  
        centerPopup()
        
        if (height != '') {
             $("#infoEquipoPop").css('height', height);
        }
        $("#backgroundPopup").css({ "opacity": "0.8" });  
        $("#backgroundPopup").fadeIn("slow");  
        
        $("#infoEquipoPop").fadeIn("slow");  
        popupStatus = 1;  
        formOpen = 1;
    }  
}

function disablePopup(){  
    //disables popup only if it is enabled  
    if(popupStatus==1){  
        $("#backgroundPopup").fadeOut("slow");  
        $("#infoEquipoPop").fadeOut("slow");  
        popupStatus = 0; 
        formOpen = 0;
        $('#popEquipoContent').replaceWith(divClone);
        
    }  
}  

//centering popup  
function centerPopup(){  
    //request data for centering  
    var windowWidth = document.documentElement.clientWidth;  
    var windowHeight = document.documentElement.clientHeight;  
    var popupHeight = $("#infoEquipoPop").height();  
    var popupWidth = $("#infoEquipoPop").width();  
    //centering  
    $("#infoEquipoPop").css({  
    "position": "absolute",  
    "top": windowHeight/2-popupHeight/2,  
    "left": windowWidth/2-popupWidth/2  
    });  
    //only need force for IE6  

    $("#backgroundPopup").css({ "height": windowHeight });  
  
}  
  