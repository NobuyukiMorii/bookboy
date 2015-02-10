    <!-- File: /app/View/Books/index.ctp -->


<?php
echo $this->Form->create('Book' , array('novalidate' => true));
?>
<div class="form-group">
<?php
if(isset($value)){
    echo $this->Form->input('Book.title', array(
        'label' => false,
        'type' => 'input',
        'value' => $value,
        'class' => 'form-control',
        'placeholder' => "Book name hehre"
    ));
} else {
    echo $this->Form->input('Book.title', array(
        'label' => false,
        'type' => 'input',
        'class' => 'form-control',
        'placeholder' => "Book name hehre"
    ));
}
?>
</div>
<button type="submit" class="btn btn-default">Submit</button>
</form>

<div class="margin-top30"></div>

<table class="table table-bordered">
    <tr class="info">
        <th>No</th>
        <th>Title</th>
<!--         <th>Description</th> -->
        <th>Status</th>
        <th>Borrower</th>
 <!--        <th>Borrow_date</th> -->
        <th>Return_date</th>
 <!--        <th>Return_date</th> -->
        <?php if($userSession['role'] == 'admin'): ?>
            <th>Actions</th>
        <?php endif; ?>
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
                <?php echo '<span class="text-success">avaiable</span>' ;?>
            <?php endif; ?>
            <?php if($latest_record[$i]['Record']['borrow_date'] != '-'): ?>    
                <?php echo '<span class="text-danger">unavaiable</span>' ;?>
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
            <?php if($latest_record[$i]['Record']['plan_to_return_date'] != '-'): ?>
                <?php echo h(date('Y/m/d' , strtotime($latest_record[$i]['Record']['plan_to_return_date'])));?>
            <?php else: ?>
                <?php echo $latest_record[$i]['Record']['plan_to_return_date']; ?> 
            <?php endif; ?>
        </td>
<!--         <td>
            <?php echo h($latest_record[$i]['Record']['return_date']);?>
        </td> -->
        <?php if($userSession['role'] == 'admin'): ?>
        <td>
<!--             <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $Book['Book']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $Book['Book']['id'])); ?>  -->

            <!-- もし本がまだ借りられていなければ、borrow出来る -->

            <?php if($latest_record[$i]['Record']['borrow_date'] == '-'): ?>
                    <a class="btn btn-info" href="
                    <?php echo $this->Html->url(array('controller' => 'Records' , 'action' => 'add', $Book['Book']['id'])); ?>
                    ">Borrow</a>
            <?php endif; ?>
            <!-- もし本を借りている人がいれば、return出来る -->
            <?php if(isset($latest_record[$i]['Record']['id'])): ?>
                <a class="btn btn-warning" href="
                <?php echo $this->Html->url(array('controller' => 'Records' , 'action' => 'edit', $latest_record[$i]['Record']['id'])); ?>
                ">Return</a>
            <?php endif; ?>
        </td>
        <?php endif; ?>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
</table>

<p class="text-right"><?php echo $this->Html->link('Add New Book', array('action' => 'add'), array('class' => 'btn btn-primary')); ?></p>