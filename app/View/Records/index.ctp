<!-- File: /app/View/Records/index.ctp -->

<h1>Records</h1>
<p><?php echo $this->Html->link('Add Record', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>User_name</th>
        <th>Book_id</th>
        <th>Borrow_date</th>
        <th>plan_to_return_date</th>
        <th>return_date</th>
    </tr>

<!-- ここで$Records配列をループして、投稿情報を表示 -->

    <?php foreach ($Records as $Record): ?>
    <tr>
        <td><?php echo $Record['Record']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($Record['Record']['user_id'], array('action' => 'view', $Record['Record']['id']));?>
        </td>
        <td>
            <?php echo $this->Html->link($Record['Record']['book_id'], array('action' => 'view', $Record['Record']['id']));?>
        </td>
        <td>
            <?php echo h($Record['Record']['borrow_date']);?>
        </td>
        <td>
            <?php echo h($Record['Record']['plan_to_return_date']);?>
        </td>
        <td>
            <?php echo h($Record['Record']['return_date']);?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $Record['Record']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $Record['Record']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>