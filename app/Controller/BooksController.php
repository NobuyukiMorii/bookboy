<?php
class BooksController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
    public $uses = array('User' , 'Book' , 'Record');

	public function isAuthorized($user) {
	    // 登録済ユーザーは投稿できる
	    if ($this->action === 'add') {
	        return true;
	    }

	    // 投稿のオーナーは編集や削除ができる
	    if (in_array($this->action, array('edit', 'delete'))) {
	        $BookId = (int) $this->request->params['pass'][0];
	        if ($this->Book->isOwnedBy($BookId, $user['id'])) {
	            return true;
	        }
	    }

	    return parent::isAuthorized($user);
	}

    public function index() {

        if(empty($this->data)){
        	$Books = $this->Book->find('all');
        } else {
        	$conditions = array('Book.title like ?' => array("%{$this->data['Book']['title']}%"));
        	$Books = $this->Book->find('all' , array(
        		'conditions' => $conditions
        	));
        	$this->set('value' , $this->data['Book']['title']);
        }
        $this->set(compact('Books'));


        foreach ($Books as $i => $Book) {

        	//$latest_record[$i]を検索
        	$conditions[$i] = array(
    				'book_id' => $Book['Book']['id'],
    				'return_date' => null,
    				'return_date' => null
        	);
        	$latest_record[$i] = $this->Record->find('first' , array(
        		'conditions' => $conditions[$i],
				'order' => array('Record.borrow_date' => 'desc'),
				'limit' => 1
        	));
        	//$latest_record[$i]に値が入っていれば
        	if(!empty($latest_record[$i]['Record']['user_id'])){
        		$conditions[$i] =  array('id' => $latest_record[$i]['Record']['user_id']);
	        	$borrow_user[$i] = $this->User->find('first' , array(
	        		'conditions' => array(
	        			'id' => $conditions[$i]
	        		),
	        	));
	        }
	        //$latest_record[$i]に空の配列の値が入っていれば
	        if(empty($latest_record[$i]['Record']['user_id'])){
	        	$latest_record[$i]['Record']['borrow_date'] = '-';
	        	$latest_record[$i]['Record']['plan_to_return_date'] = '-';
	        	$latest_record[$i]['Record']['return_date'] = '-';
	        	$borrow_user[$i]['User']['id'] = '-';
	        	$borrow_user[$i]['User']['username'] = '-';
	        	$borrow_user[$i]['User']['role'] = '-';
	        }

        }










        $this->set(compact('latest_record' , 'borrow_user'));
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Book'));
        }

        $Book = $this->Book->findById($id);
        if (!$Book) {
            throw new NotFoundException(__('Invalid Book'));
        }
        $this->set('Book', $Book);
    }

	public function add() {
	    if ($this->request->is('post')) {
	        $this->request->data['Book']['user_id'] = $this->Auth->user('id');
	        if ($this->Book->save($this->request->data)) {
	            $this->Session->setFlash(__('Your Book has been saved.'));
	            $this->redirect(array('action' => 'index'));
	        }
	    }
	}

	public function edit($id = null) {
	    if (!$id) {
	        throw new NotFoundException(__('Invalid Book'));
	    }

	    $Book = $this->Book->findById($id);
	    if (!$Book) {
	        throw new NotFoundException(__('Invalid Book'));
	    }

	    if ($this->request->is(array('Book', 'put'))) {
	        $this->Book->id = $id;
	        $this->request->data['Book']['user_id'] = $this->Auth->user('id');
	        if ($this->Book->save($this->request->data)) {
	            $this->Session->setFlash(__('Your Book has been updated.'));
	            return $this->redirect(array('controller' => 'Books' , 'action' => 'index'));
	        }
	        $this->Session->setFlash(__('Unable to update your Book.'));
	    }

	    if (!$this->request->data) {
	        $this->request->data = $Book;
	    }
	}

	public function delete($id) {
	    if ($this->request->is('get')) {
	        throw new MethodNotAllowedException();
	    }

	    if ($this->Book->delete($id)) {
	        $this->Session->setFlash(
	            __('The Book with id: %s has been deleted.', h($id))
	        );
	    } else {
	        $this->Session->setFlash(
	            __('The Book with id: %s could not be deleted.', h($id))
	        );
	    }

	    return $this->redirect(array('action' => 'index'));
	}

}