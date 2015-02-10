<!-- File: /app/View/Records/index.ctp -->

<?php echo $this->Form->create('Place', array('class' => 'form-horizontal' , 'novalidate' => true)); ?>
    <fieldset class="PlaceDetailForm">
        <?php echo $this->Form->input('Record.conditions', array(
            'legend' => false,
            'type' => 'radio',
            'div' => 'radio-horizontal',
            'options' => array(1 => "Late only" , 2 => "All Borrower’s list"),
            'value' => $value,
            'style' => 'float:none;',
        )); ?>
        <button type="submit" class="btn btn-default">Submit</button>
    </fieldset>
</form>

<div class="margin-top30"></div>


<table class="table table-bordered">
    <tr class="info">
        <th>No</th>
        <th>User Name</th>
        <th>Book Title</th>
        <th>Borrow Date</th>
        <th>Deadline</th>
        <th>Remaining Days</th>
<!--         <th>return_date</th> -->
    </tr>

<!-- ここで$Records配列をループして、投稿情報を表示 --> 
    <?php $i = 0 ;?>
    <?php foreach ($Records as $Record): ?>
    <?php $i++ ;?>
    <tr>
        <td>
            <?php echo $i ;?>
        </td>
        <td>
            <?php echo $this->Html->link($Record['User']['username'], array('controller' => 'Users' , 'action' => 'view', $Record['User']['id']));?>
        </td>
        <td>
            <?php echo $this->Html->link($Record['Book']['title'], array('controller' => 'Books' , 'action' => 'view', $Record['Book']['id']));?>
        </td>
        <td>
            <?php echo h(date('Y/m/d' , strtotime($Record['Record']['borrow_date'])));?>
        </td>
        <td>
            <?php echo h(date('Y/m/d' , strtotime($Record['Record']['plan_to_return_date'])));?>
        </td>
        <td>
            <?php 
                $days =  (strtotime($Record['Record']['plan_to_return_date']) - strtotime(date('Y-m-d'))) / ( 60 * 60 * 24);
                if($days > 0){
                    echo '<span class="text-primary">-' . $days . "</span>";
                } 
                if($days == 0){
                    echo '<span class="text-warning">-' . $days . '</span>';
                }
                if($days < 0){
                    $days = $days + $days * -2;
                    echo '<span class="text-danger">+' .$days . '</span>';
                }
            ;?>
        </td>
<!--         <td>
            <?php echo h($Record['Record']['return_date']);?>
        </td> -->
    </tr>
    <?php endforeach; ?>

</table>