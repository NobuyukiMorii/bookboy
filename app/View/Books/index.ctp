<!-- File: /app/View/Books/index.ctp -->

<h1>Books</h1>
<p><?php echo $this->Html->link('Add Book', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Borrow_date</th>
        <th>Plan_to_return_date</th>
        <th>Return_date</th>
        <th>Actions</th>
    </tr>

<!-- ここで$Books配列をループして、投稿情報を表示 -->

    <?php 
    foreach ($Books as $Book): ?>
    <?php $i = 0; $i ++; ?>
    <tr>
        <td><?php echo $Book['Book']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($Book['Book']['title'], array('action' => 'view', $Book['Book']['id']));?>
        </td>
        <td>
            <?php echo h($Book['Book']['description']);?>
        </td>
        <td>
            <?php echo h($latest_record[$i]['Record']['borrow_date']);?>
        </td>
        <td>
            <?php echo h($latest_record[$i]['Record']['plan_to_return_date']);?>
        </td>
        <td>
            <?php echo h($latest_record[$i]['Record']['return_date']);?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $Book['Book']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $Book['Book']['id'])); ?>
            <a href="
            <?php echo $this->Html->url(array('controller' => 'Records' , 'action' => 'add', $latest_record[$i]['Record']['book_id'])); ?>
            ">Borrow</a>
            <a href="
            <?php echo $this->Html->url(array('controller' => 'Records' , 'action' => 'edit', $latest_record[$i]['Record']['id'])); ?>
            ">Return</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>