
<script src="<?=base_url();?>javascript/datagrid.js"></script>
<? if ($this->session->userdata('userRole') == 'admin') : ?>
	<div id="opcionesApp">
	      
            <div class="agregar">
                <a href="#" class="button">
                <span class="user">Ingresar un equipo</span>
                </a>
            </div>
		
            <div class="eliminar">   
                <a href="#" class="button">
                    <span class="user">Eliminar equipo</span>
                </a>
            </div>

            <div class="soe">   
                <a href="#" class="button">
                    <span class="user">Generar / Ver SOE</span>
                </a>
            </div>
	</div>
	
<? endif; ?>	

<br><br><br>
<div id="filtro">
    <span>
            <label for="filter">Filtro</label>  
            <input type="text" name="filter" id="filter" />  
    </span>
 </div>

<br>
<div id="datagrid">
    
    
    <div id="gridIngreso"><?=$grid;?></div>
	
    <div id="ajax_paging" >
		<? if (strlen($pagination)) : ?>
       		<?=$pagination; ?>
		<? endif; ?>
    </div>

    </br></br>
    <div id="paginas">
        <span>
            <label for="per_page">Por pagina : </label>  
            <? $pags = array('10' => 10, '15' => 15, '20' => 20); $attr = 'id="per_page"';?>            
            <?=form_dropdown('per_page', $pags, $per_page , $attr  ); ?>
        </span>
    </div>

</div>








