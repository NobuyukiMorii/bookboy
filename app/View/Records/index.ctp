<!-- File: /app/View/Records/index.ctp -->

<h1>List</h1>

<?php
echo $this->Form->create('Record');
if(isset($value)){
    echo $this->Form->input('Record.conditions', array(
        'label' => false,
        'type' => 'radio',
        'options' => array(1 => "Late only" , 2 => "All Borrower’s list"),
        'value' => $value,
        'style' => 'float:none;',
    ));
} else {
    echo $this->Form->input('Record.conditions', array(
        'label' => false,
        'type' => 'radio',
        'options' => array(1 => "Late only" , 2 => "All Borrower’s list"),
        'value' => 1,
        'style' => 'float:none;',
    ));
}


echo $this->Form->end('Change');
?>

<table>
    <tr>
        <th>User_name</th>
        <th>Title</th>
        <th>Borrow_date</th>
        <th>plan_to_return_date</th>
        <th>days</th>
<!--         <th>return_date</th> -->
    </tr>

<!-- ここで$Records配列をループして、投稿情報を表示 --> 
    <?php foreach ($Records as $Record): ?>
    <tr>
        <td>
            <?php echo $this->Html->link($Record['User']['username'], array('controller' => 'Users' , 'action' => 'view', $Record['User']['id']));?>
        </td>
        <td>
            <?php echo $this->Html->link($Record['Book']['title'], array('controller' => 'Books' , 'action' => 'view', $Record['Book']['id']));?>
        </td>
        <td>
            <?php echo h($Record['Record']['borrow_date']);?>
        </td>
        <td>
            <?php echo h($Record['Record']['plan_to_return_date']);?>
        </td>
        <td>
            <?php 
                $days =  (strtotime($Record['Record']['plan_to_return_date']) - strtotime(date('Y-m-d'))) / ( 60 * 60 * 24);
                if($days >=0){
                    echo '-' . $days;
                } 
                if($days == 0){
                    echo '-' . $days;
                }
                if($days <= 0){
                    echo '+' .$days;
                }
            ;?>
        </td>
<!--         <td>
            <?php echo h($Record['Record']['return_date']);?>
        </td> -->
    </tr>
    <?php endforeach; ?>

</table>