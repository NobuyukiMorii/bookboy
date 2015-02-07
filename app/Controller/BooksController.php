<?php
class BooksController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

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
        $this->set('Books', $this->Book->find('all'));
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
	        $this->request->data['Book']['user_id'] = $this->Auth->user('id'); //Added this line
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
	        if ($this->Book->save($this->request->data)) {
	            $this->Session->setFlash(__('Your Book has been updated.'));
	            return $this->redirect(array('action' => 'index'));
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