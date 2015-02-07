<!-- File: /app/View/Books/add.ctp -->

<h1>Add Book</h1>
<?php
echo $this->Form->create('Book');
echo $this->Form->input('title');
echo $this->Form->input('description', array('rows' => '3'));
echo $this->Form->end('Save Book');
?>