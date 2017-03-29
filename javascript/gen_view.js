var userUrl = CI_ROOT+'general/listaUsuarios/';
var equipoUrl = CI_ROOT+'general/equiposUsuario/';
var detalleequipo = CI_ROOT+'general/detalleEquipo/'
 
var popupStatus = 0;  //0 means disabled; 1 means enabled;  

$(function() {
    
   $( "#accordion" ).accordion({autoHeight: false, animated: 'bounceslide'});
   
   $('#equipoDialog').dialog({
      autoOpen: false,
      buttons: {
          'Ok': function() {
              $(this).dialog('close');
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
    })  
}); //End Document ready


function listUsers(area) {
    $.ajax({
        type: 'POST',
        url: userUrl,
        data: 'area='+area,
        dataType: 'html',
        success: function (response) {
            $('#lista_Usuarios').html(''); //limpia div de lista de usuario
            $('#equipos_fill').html('');
            $('#equipos_fill').html('<span>Seleccione un Usuario</span>');
            $('#lista_Usuarios').html(response); //rellena con usuarios de nueva area
            
        }
    });
}

function listEquipo(id_user) {
    
    $.ajax({
       type: 'POST',
       url: equipoUrl,
       data: 'id_user='+id_user,
       dataType: 'html',
       success: function (response) {
           $('#equipos_fill').html('');
           $('#equipos_fill').html(response);
       }
    });
    
}

function detalleEquipo(cod_inv) {
   $.ajax({
       type: 'Post',
       url: detalleequipo,
       data: 'cod_inv='+cod_inv,
       dataType: 'html',
       success: function (response) {
           centerPopup();
           $('#infoEquipoPop #popEquipoContent').html(response);
           loadPopup();
       }
   });
}

function loadPopup(){  
    //loads popup only if it is disabled  
    if(popupStatus==0){  
    $("#backgroundPopup").css({  
    "opacity": "0.8"  
    });  
    $("#backgroundPopup").fadeIn("slow");  
    $("#infoEquipoPop").fadeIn("slow");  
    popupStatus = 1;  
    }  
}

function disablePopup(){  
    //disables popup only if it is enabled  
    if(popupStatus==1){  
    $("#backgroundPopup").fadeOut("slow");  
    $("#infoEquipoPop").fadeOut("slow");  
    popupStatus = 0;  
    $('#infoEquipoPop #popEquipoContent').html('');
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

    $("#backgroundPopup").css({  
    "height": windowHeight  
    });  
  
}  
  