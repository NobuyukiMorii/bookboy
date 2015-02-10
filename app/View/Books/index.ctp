<!-- File: /app/View/Books/index.ctp -->

<h1>Books</h1>
<p><?php echo $this->Html->link('Add Book', array('action' => 'add')); ?></p>
<p><?php echo $this->Html->link('Borrower', array('controller' => 'Records' ,'action' => 'index')); ?></p>

<?php
echo $this->Form->create('Book' , array('novalidate' => true));
if(isset($value)){
    echo $this->Form->input('Book.title', array(
        'label' => false,
        'type' => 'input',
        'value' => $value,
    ));
} else {
    echo $this->Form->input('Book.title', array(
        'label' => false,
        'type' => 'input',
    ));
}


echo $this->Form->end('Change');
?>

<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
<!--         <th>Description</th> -->
        <th>Status</th>
        <th>Borrower</th>
 <!--        <th>Borrow_date</th> -->
        <th>Return_date</th>
 <!--        <th>Return_date</th> -->
        <th>Actions</th>
    </tr>

<!-- ここで$Books配列をループして、投稿情報を表示 -->

    <?php $i = 0 ; ?>
    <?php $j = 0 ; ?>
    <?php 
    foreach ($Books as $Book): ?>
    <?php $j++ ; ?>
    <tr>
        <td><?php echo $j; ?></td>
        <td>
            <?php echo $this->Html->link($Book['Book']['title'], array('action' => 'view', $Book['Book']['id']));?>
        </td>
<!--         <td>
            <?php echo h($Book['Book']['description']);?>
        </td> -->
        <td>
            <?php if($latest_record[$i]['Record']['borrow_date'] == '-'): ?>
                <?php echo 'avaiable' ;?>
            <?php endif; ?>
            <?php if($latest_record[$i]['Record']['borrow_date'] != '-'): ?>    
                <?php echo 'unavaiable' ;?>
            <?php endif; ?>
        </td>
        <td>
            <?php if($borrow_user[$i]['User']['username'] == '-'): ?>
                <?php echo $borrow_user[$i]['User']['username'] ;?> 
            <?php endif; ?>
            <?php if($borrow_user[$i]['User']['username'] != '-'): ?>
                <?php echo $this->Html->link($borrow_user[$i]['User']['username'] , array('controller' => 'Users' , 'action' => 'view', $borrow_user[$i]['User']['id']));?>
            <?php endif; ?>
        </td>
<!--         <td>
            <?php echo h($latest_record[$i]['Record']['borrow_date']);?>
        </td> -->
        <td>
            <?php echo h($latest_record[$i]['Record']['plan_to_return_date']);?>
        </td>
<!--         <td>
            <?php echo h($latest_record[$i]['Record']['return_date']);?>
        </td> -->
        <td>
<!--             <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $Book['Book']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $Book['Book']['id'])); ?>  -->

            <!-- もし本がまだ借りられていなければ、borrow出来る -->
            <?php if($latest_record[$i]['Record']['borrow_date'] == '-'): ?>
                    <a href="
                    <?php echo $this->Html->url(array('controller' => 'Records' , 'action' => 'add', $Book['Book']['id'])); ?>
                    ">Borrow</a>
            <?php endif; ?>
            <!-- もし本を借りている人がいれば、return出来る -->
            <?php if(isset($latest_record[$i]['Record']['id'])): ?>
                <a href="
                <?php echo $this->Html->url(array('controller' => 'Records' , 'action' => 'edit', $latest_record[$i]['Record']['id'])); ?>
                ">Return</a>
            <?php endif; ?>
        </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>