<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

			
		echo $this->Html->css('cake.generic');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
// 		echo $this->Html->script('jquery-1.7.1.min');
// 		echo $this->Html->script('jquery.masonry.min');
// 		echo $this->Html->script('modernizr-2.5.3.min');
// 		echo $this->Html->script('script');
// 		echo $this->Html->script('jquery.infinitescroll.min');	
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<div class="top-menu" id="main-menu">
			<ul >
				<li>
						<?php echo $this->Html->link('Home',array('controller'=>'posts','action'=>'index'));?>
				</li>
				<li>
						<?php echo $this->Html->link('Hot',array('controller'=>'posts','action'=>'hot'));?>
				</li>
				<li>
						<?php echo $this->Html->link('Add new post',array('controller'=>'posts','action'=>'add'));?>
				</li>
				<?php
					if($this->Session->check('Auth.User')){
						if($this->Session->read('Auth.User.role')=='admin'){
							echo "<li>".$this->Html->link("Manage users",array('controller'=>'users','action'=>'manage'))."</li>";
							echo "<li>".$this->Html->link("Manage posts",array('controller'=>'posts','action'=>'manage'))."</li>";
							echo "<li>".$this->Html->link("Manage albums",array('controller'=>'albums','action'=>'manage'))."</li>";
							echo "<li>".$this->Html->link("Manage comments",array('controller'=>'comments','action'=>'manage'))."</li>";
						}
					}
				?>
			</ul>	
		</div>

		<div class="top-menu" id="user-menu">	
			<ul >
				<?php if(!$this->Session->check('Auth.User')) {
					echo "<li>".$this->Html->link('Log in',array('controller'=>'users','action'=>'login'))."</li>";
					echo "<li>".$this->Html->link('Register',array('controller'=>'users','action'=>'add'))."</li>";
				} else {
					echo "Hello:";
					echo '<li id="user-name">'.$this->Html->link($this->Session->read('Auth.User.username'), array('controller'=>'users','action'=>'view',$this->Session->read('Auth.User.id')))."</li>";
					echo "<li>".$this->Html->link('Log out',array('controller'=>'users','action'=>'logout'))."</li>";
				}
				?>
			</ul>
		</div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<!--
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>-->
		</div>

	</div>
  	<?php echo $this->element('sql_dump'); ?>
	<?php echo $this->Facebook->init(); ?>
</body>
</html>
