<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<link rel="stylesheet" type="text/css" href="<?=base_url();?>css/loginForm.css" />

<div id="loginForm">
	<?=form_open('login/logon'); ?>
	<h1>Control Laboratorio</h1>

	
		<p>
		    <?=form_label('Correo :','email');?>
		    <?=form_input('email', '', 'id="email"');?>
		</p>
		<p>
		    <?=form_label('Password :','password');?>
		    <?=form_password('password','','id="password"');?>
		</p>
		<p>
		    <input type="submit" class="button" value="Ingresar" />

		</p>
		
		<?=form_close(); ?>
		
		<div class="errors">
		    <?=validation_errors();?> 
	</div>

</div>

