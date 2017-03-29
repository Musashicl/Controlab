<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="menu_links"> <!-- Menu Links Starts Here -->
    <? if($this->session->userdata('userId') && $this->session->userdata('userRole') && $this->session->userdata('app')) : ?>
		<? $this->load->view('layout/appmenu/'. $this->session->userdata('app').'/'. $this->session->userdata('userRole')); ?>
		<a href="<?=base_url();?>general/killsess" class="menu_links">Kill sess</a><span class="menu_border">&nbsp;</span>
    <? endif;?>
       
            
   
	
    
</div> <!-- Menu Links Ends Here -->