<?php
class Book extends AppModel {

   public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );

	public function isOwnedBy($book, $user) {
	    return $this->field('id', array('id' => $book, 'user_id' => $user)) !== false;
	}
   
}