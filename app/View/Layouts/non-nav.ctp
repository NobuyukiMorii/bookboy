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
      	<?php
      	$PresentUrl = $this->request->here;
      	$BooksUrl = $this->Html->url(array('controller' => 'Books')) . 'Books/';
      	$BooksUrlRoot = $this->Html->url(array('controller' => 'Books'));
      	$RecordsUrl = $this->Html->url(array('controller' => 'Records'));
      	$UsersUrl = $this->Html->url(array('controller' => 'Users'));

      	if($PresentUrl == $BooksUrl || $BooksUrlRoot){
      		$active = 'Books';
      	}
      	if($PresentUrl == $RecordsUrl){
      		$active = 'Records';
      	}
      	if($PresentUrl == $UsersUrl){
      		$active = 'Users';
      	}
		  ?>

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">

		</div>
	</div>
</body>
<?php echo $this->Html->script( 'bootstrap.'); ?>
</html>
