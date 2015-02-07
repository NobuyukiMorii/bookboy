<!-- File: /app/View/Books/index.ctp -->

<h1>Blog Books</h1>
<p><?php echo $this->Html->link('Add Book', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Title</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- ここで$Books配列をループして、投稿情報を表示 -->

    <?php foreach ($Books as $Book): ?>
    <tr>
        <td><?php echo $Book['Book']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($Book['Book']['title'], array('action' => 'view', $Book['Book']['id']));?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $Book['Book']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $Book['Book']['id'])); ?>
        </td>
        <td>
            <?php echo $Book['Book']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>