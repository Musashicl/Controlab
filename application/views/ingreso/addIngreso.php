<?php $atribs= array('id' => 'formAddIngreso'); ?>

<script type="text/javascript" src="<?=base_url();?>javascript/addIngresoForm.js" ></script>

<div class="formAdd">
    <h1>Ingreso de Equipo</h1>
   
    <?=form_open('general/addIngreso', $atribs);?>


    <legend>Contact form</legend>
       
                <label for="ticket">
                    <span>Ticket</span>                       
                    <input type="text" name="ticket" id="ticket" class="validate[required,custom[number]]" />
                </label>
				
				<label for="asset">
                    <span>Asset</span>                       
                    <input type="text" name="asset" id="asset" class="validate[required,custom[number]]" />
                </label>
        
                <label for="estado_id">
                    <span>Estado</span>
                    <?=form_dropdown('estado_id',$estados,'0');?>
                </label>
        
                <label for="tipo_id">
                    <span>Tipo</span>
                    <?=form_dropdown('tipo_id',$tipos,'0');?>
                </label>
        
                <label for="fingreso">
                    <span>Fecha Ingreso</span>
                    <input type="text" name="fingreso" id="fingreso" class="validate[required] text-input datepicker" size="30" />
                </label>
    
                <label for="motivo">
                    <span>Motivo</span>
                    <textarea name="motivo" id="motivo" class="validate[required]"cols="30" rows="10"></textarea>
                </label>
    
                <label for="descripcion">
                    <span>Descripcion</span>
                    <textarea name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
                </label>
    
                <label for="diagnostico">
                    <span>Diagnostico</span>
                    <textarea name="diagnostico" id="diagnostico" cols="30" rows="10"></textarea>
                </label>
    
                <label for="ubicacion_id">
                    <span>Ubicacion</span>
                    <?=form_dropdown('ubicacion_id',$ubicacion,'0');?>
                </label>
    
                <label>
                    <span><button type="button" id="enviarAddForm">Agregar</button></span> 
                </label>
       	

								
    
    <?//=form_dropdown('estado_id',$estados,'0');?>
                                

    <?=form_close();?>
</div>
<pre><?// print_r ($estadoList);?></pre>





