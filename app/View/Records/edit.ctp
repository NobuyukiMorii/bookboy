<!-- File: /app/View/Records/add.ctp -->

<h1>Add Record</h1>
<?php
echo $this->Form->create('Record');
echo $this->Form->input('book_id' , array(
	    'type' => 'hidden',
	    'value' => 1
	)
);
echo $this->Form->input('borrow_date', array(
    'type' => 'date',
));
echo $this->Form->input('plan_to_return_date', array(
    'type' => 'date',
));
echo $this->Form->input('return_date', array(
    'type' => 'date',
));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Save Record');
?>