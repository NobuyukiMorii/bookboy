<?php
class RecordsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
        if(isset($this->data['Record']['conditions'])){
            if($this->data['Record']['conditions'] == 1){
                $conditions = array(
                    'plan_to_return_date <=' => date('Y-m-d'),
                    'return_date' => null
                );
                $this->set('value', 1);
            } else {
                $conditions = array(
                    'return_date' => null
                );
                $this->set('value', 2);
            }
        } else {
            $conditions = array(
                'return_date' => null
            );
            $this->set('value', 1);
        }
        $Records = $this->Record->find('all' , array(
            'conditions' => $conditions
        ));
        $this->set('Records', $Records);
    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Record'));
        }

        $Record = $this->Record->findById($id);
        if (!$Record) {
            throw new NotFoundException(__('Invalid Record'));
        }
        $this->set('Record', $Record);
    }

    public function add($books_id) {

        if ($this->request->is('post')) {
            //book_idを指定
            if(isset($books_id)){
                $this->request->data['Record']['book_id'] = $books_id;
            } else {
                $this->redirect(array('controller' => 'Books', 'action' => 'index'));
                $this->Session->setFlash(__('Are you silly?'));
            }
            //user_idを指定
            $this->request->data['Record']['user_id'] = $this->Auth->user('id');
            if ($this->Record->save($this->request->data)) {
                $this->Session->setFlash(__('You book borrowing book.Tomorrow book boy deliver it to you.'));
                $this->redirect(array('controller' => 'Books', 'action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Record'));
        }

        $this->set('id' , $id);
        $Record = $this->Record->findById($id);
        if (!$Record) {
            throw new NotFoundException(__('Invalid Record'));
        }

        if ($this->request->is(array('Record', 'put'))) {
            $this->Record->id = $id;
            $this->request->data['Record']['user_id'] = $this->Auth->user('id');
            if ($foo = $this->Record->save($this->request->data)) {
                $this->Session->setFlash(__('Your Record has been updated.'));
                return $this->redirect(array('controller' => 'Books', 'action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your Record.'));
        }

        if (!$this->request->data) {
            $this->request->data = $Record;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Record->delete($id)) {
            $this->Session->setFlash(
                __('The Record with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Session->setFlash(
                __('The Record with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }

}