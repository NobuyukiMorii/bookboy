<?php
class Record extends AppModel {

   public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

    public $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'foreignKey'   => 'user_id'
        ),
        'Book' => array(
            'className'    => 'Book',
            'foreignKey'   => 'book_id'
        ),
    );

}