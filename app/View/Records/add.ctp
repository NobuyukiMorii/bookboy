<!-- File: /app/View/Records/add.ctp -->

<h1>Until when will you borrow the book?</h1>

<?php
echo $this->Form->create('Record' , array('class' => 'form-inline'));
?>
	<?php
	echo $this->Form->input('Record.borrow_date', array(
	    'type' => 'hidden',
	    'default' => date('Y-m-d'),
	    'label' => false,
	    'class' => "form-control"
	));
	echo $this->Form->input('Record.plan_to_return_date', array(
	    'type' => 'date',
	    'default' => date("Y-m-d",strtotime("+1 week")),
	    'label' => false,
	    'class' => "form-control"
	));
	?>
	<div class="margin-top30"></div>
	<button type="submit" class="btn btn-default">Submit</button>
</form>