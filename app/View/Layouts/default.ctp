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
<html>
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
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<!-- <h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1> -->
			<ul>
				<li>
						<h1><?php echo $this->Html->link('Home',array('controller'=>'posts','action'=>'index'));?></h1>
				</li>
				<li>
						<h1><?php echo $this->Html->link('Hot',array('controller'=>'posts','action'=>'hot'));?></h1>
				</li>
				<li>
						<h1><?php if(!$this->Session->check('Auth.User')) {
							echo $this->Html->link('Log in',array('controller'=>'users','action'=>'login'));
							echo "<br>";
							echo $this->Html->link('Register',array('controller'=>'users','action'=>'add'));
						} else {
							echo "Hello: ";
							echo $this->Html->link($this->Session->read('Auth.User.username'), array('controller'=>'users','action'=>'view',$this->Session->read('Auth.User.id')));
							echo "<br>";
							echo $this->Html->link('Log out',array('controller'=>'users','action'=>'logout'));
						}
						?></h1>
				</li>
			</ul>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
