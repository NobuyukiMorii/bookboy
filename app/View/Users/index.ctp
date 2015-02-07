<!-- File: /app/View/Books/index.ctp -->

<h1>Blog Books</h1>
<p><?php echo $this->Html->link('Add Book', array('action' => 'add')); ?></p>
<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

<!-- ここで$Books配列をループして、投稿情報を表示 -->

    <?php foreach ($users as $user): ?>
    <tr>
        <td><?php echo $user['User']['id']; ?></td>
        <td>
            <?php echo $this->Html->link($user['User']['username'], array('action' => 'view', $user['User']['id']));?>
        </td>
        <td>
            <?php echo h($user['User']['role']);?>
        </td>
        <td>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $user['User']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>