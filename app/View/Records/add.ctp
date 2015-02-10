<!-- File: /app/View/Records/add.ctp -->

<h1>Add Record</h1>
<?php
echo $this->Form->create('Record');
echo $this->Form->input('Record.borrow_date', array(
    'type' => 'hidden',
    'default' => date('Y-m-d')
));
echo $this->Form->input('Record.plan_to_return_date', array(
    'type' => 'date',
    'default' => date("Y-m-d",strtotime("+1 week")),
    'label' => 'Deadline of the returning book',
));

echo $this->Form->end('Save Record');
?>