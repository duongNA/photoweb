<script type="text/javascript">
	$(function() {
		// hide menu bar and footer
		$('#header, #footer').hide();

		$('#container').css('background-color', '#F4F4F4');
		$('#content').css('padding-left', '0');
		$('#flashMessage').css('text-align', 'center');
	});
</script>
<style type="text/css">
div.submit {
	display: inline;
}

div.login-panel {
	border-bottom: 2px solid #dddddd;
	margin-bottom: 20px;
}

</style>

<div id="form-panel">
<!-- <div class="fb-login"> -->
	<?php
// 		if ($facebook_user) {
// 			echo $this->Facebook->disconnect(array('redirect' => '/users/logout'));
// 		} else {
// 			echo $this->Facebook->login(array('perms' => 'email,publish_stream'));
// 		}
// 	?>
<!-- </div> -->
	<h1>Welcome to Photoshare</h1>

	<?php echo $this->Session->flash('auth'); ?>


	
	<div id="login-panel">
		
		<?php 
			echo $this->Form->create('User');
			echo $this->Form->input('username', array('label' => false, 'placeholder' => 'User name'));
			echo $this->Form->input('password', array('label' => false, 'placeholder' => 'Password'));
			
		?>
		<div>
			<?php 
				echo $this->Form->end(__('Login'), array('style' => 'display:inline'));
				echo $this->Html->link("Register",array('controller'=>'users','action'=>'add'));
			?>
		</div>
	</div>

	<?php echo $this->Facebook->login(array('perms' => 'email,publish_stream', 'width' => '344')); ?>

</div>

