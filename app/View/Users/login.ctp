<?php echo $this->Session->flash('auth'); ?>

<?php echo $this->Form->create('User' ,array('class' => "form-inline")); ?>
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail3">Email address</label>
    <?php echo $this->Form->input('username' , array(
    	'label' => false,
    	'class' => "form-control",
    	'placeholder' => "User name"
    ));
    ?>
  </div>
  <div class="form-group">
    <label class="sr-only" for="exampleInputPassword3">Password</label>
    <?php
    echo $this->Form->input('password' ,array(
    	'label' => false,
    	'class' => "form-control",
    	'placeholder' => "Password"
    ));
	?>
  </div>
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>