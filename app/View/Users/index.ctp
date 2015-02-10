<!-- File: /app/View/Books/index.ctp -->

<table class="table table-bordered">
    <tr class="info">
        <th>No</th>
        <th>Username</th>
        <th>Role</th>
        <?php if($userSession['role'] == 'admin'): ?>
        <th>Actions</th>
        <?php endif; ?>
    </tr>

<!-- ここで$Books配列をループして、投稿情報を表示 -->

    <?php $i = 0 ;?>
    <?php foreach ($users as $user): ?>
    <?php $i++ ;?>
    <tr>
        <td><?php echo $i ;?></td>
        <td>
            <?php echo $this->Html->link($user['User']['username'], array('action' => 'view', $user['User']['id']));?>
        </td>
        <td>
            <?php echo h($user['User']['role']);?>
        </td>
        <?php if($userSession['role'] == 'admin'): ?>
        <td>
            <?php echo $this->Html->link('Edit', array('action' => 'edit', $user['User']['id']) , array('class' => 'btn btn-info')); ?>
            <?php echo $this->Form->postLink(
                'Delete',
                array('action' => 'delete', $user['User']['id']),
                array('confirm' => 'Are you sure?' , 'class' => 'btn btn-danger'));
            ?>
        </td>
        <?php endif; ?>
    </tr>
    <?php endforeach; ?>

</table>

<p class="text-right"><?php echo $this->Html->link('Add User', array('action' => 'add'), array('class' => 'btn btn-primary')); ?></p>