<?php
   
    $atribss = array(
        'id' => 'formEditIngreso'
    );
?>

<script type="text/javascript" src="<?=base_url();?>javascript/editIngresoForm.js" ></script>

<div class="formAdd">
    <h1>Edicion de Equipo</h1>
   
    <?= form_open('general/editIngreso', $atribss);?>

    <legend>Editar ingreso de equipo</legend>
       
                <input type="hidden" name="id" id="id" value="<?=$ingreso->id;?>" />
                <label for="ticket">
                    <span>Ticket</span>                       
                    <input type="text" name="ticket" id="ticket" class="validate[required,custom[number]]" value="<?=$ingreso->ticket;?>" />
                </label>
				<label for="asset">
                    <span>Asset</span>                       
                    <input type="text" name="asset" id="asset" class="validate[required,custom[number]]" value="<?=$ingreso->asset;?>" />
                </label>
        
                <label for="estado_id">
                    <span>Estado</span>
                    <?=form_dropdown('estado_id',$estados, $ingreso->estado_id);?>
                </label>
        
                <label for="tipo_id">
                    <span>Tipo</span>
                    <?=form_dropdown('tipo_id',$tipos,$ingreso->tipo_id);?>
                </label>
        
                <label for="fingreso">
                    <span>Fecha Ingreso</span>
                    <input type="text" name="fingreso" id="fingreso" class="validate[required] text-input datepicker" value="<?=$fingreso;?>" />
                </label>
    
                <label for="motivo">
                    <span>Motivo</span>
                    <textarea name="motivo" id="motivo" class="validate[required]"cols="30" rows="10" ><?=$ingreso->motivo;?></textarea>
                </label>
    
                <label for="descripcion">
                    <span>Descripcion</span>
                    <textarea name="descripcion" id="descripcion" cols="30" rows="10" ><?=$ingreso->descripcion;?></textarea>
                </label>
    
                <label for="fsalida">
                    <span>Fecha Salida</span>
                    <input type="text" name="fsalida" id="fsalida" class="text-input datepicker" value="<?=$fsalida;?>" />
                </label>
                
                <label for="diagnostico">
                    <span>Diagnostico</span>
                    <textarea name="diagnostico" id="diagnostico" cols="30" rows="10"><?=$ingreso->diagnostico;?></textarea>
                </label>
    
                <label for="ubicacion_id">
                    <span>Ubicacion</span>
                    <?=form_dropdown('ubicacion_id', $ubicacion, $ingreso->ubicacion_id);?>
                </label>
    
                <label>
                    <span><button type="button" id="enviarEditForm">Editar</button></span> 
                </label>
       	

								
    
    <?//=form_dropdown('estado_id',$estados,'0');?>
                                

    <?=form_close();?>
</div>