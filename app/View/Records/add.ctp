<!-- File: /app/View/Records/add.ctp -->

<h1>Add Record</h1>
<?php
echo $this->Form->create('Record');
echo $this->Form->input('Record.borrow_date', array(
    'type' => 'date',
));
echo $this->Form->input('Record.plan_to_return_date', array(
    'type' => 'date',
));

echo $this->Form->end('Save Record');
?>