<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'Nexseed BookBoy');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('style');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="container">
		<div id="header">
			<h1><?php echo $this->Html->link('Nexseed BookBoy', array('controller' => 'Books' ,'action' => 'index')); ?></h1>
		</div>
		<div id="content">

      <!-- Static navbar -->
      	<?php $PresentController = $this->name ;?>

      	<nav class="navbar navbar-default">
        	<div class="container-fluid">
          		<div id="navbar" class="navbar-collapse collapse">
            		<ul class="nav navbar-nav">
            			<?php if($PresentController  === 'Books'): ?>
              				<li class="active">
              			<?php else: ?>
              				<li>
              			<?php endif; ?>
              				<?php echo $this->Html->link('Book List', array('controller' => 'Books' ,'action' => 'index')); ?></li>
              				</li>
            		</ul>
            		<ul class="nav navbar-nav">
            			<?php if($PresentController === 'Records'): ?>
              				<li class="active">
              			<?php else: ?>
              				<li>
              			<?php endif; ?>
              				<?php echo $this->Html->link('Borroewer List', array('controller' => 'Records' ,'action' => 'index')); ?></li>
              				</li>
            		</ul>
                <ul class="nav navbar-nav">
                  <?php if($PresentController === 'Users'): ?>
                      <li class="active">
                    <?php else: ?>
                      <li>
                    <?php endif; ?>
                      <?php echo $this->Html->link('Users List', array('controller' => 'Users' ,'action' => 'index')); ?></li>
                      </li>
                </ul>
		            <ul class="nav navbar-nav navbar-right">
		              	<li><?php echo $this->Html->link('Logout', array('controller' => 'Users' ,'action' => 'logout')); ?></li></li>
		            </ul>
          		</div><!--/.nav-collapse -->
        	</div><!--/.container-fluid -->
      	</nav>
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">

		</div>
	</div>
</body>
<?php echo $this->Html->script( 'bootstrap.'); ?>
</html>
