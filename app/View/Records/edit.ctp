<!-- File: /app/View/Records/add.ctp -->

<h1>Return Books</h1>
<?php
echo $this->Form->create('Record');
echo $this->Form->input('book_id' , array(
	'type' => 'hidden',
	'value' => $id
));
echo $this->Form->input('return_date', array(
    'type' => 'hidden',
    'default' => date('Y-m-d')
));
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end('Return your book');
?>