<?php
class RecordsController extends AppController {

    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
        $this->set('Records', $this->Record->find('all'));
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

    public function add() {
        if ($this->request->is('post')) {
            $this->request->data['Record']['user_id'] = $this->Auth->user('id');
            if ($this->Record->save($this->request->data)) {
                $this->Session->setFlash(__('Your Record has been saved.'));
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Record'));
        }

        $Record = $this->Record->findById($id);
        if (!$Record) {
            throw new NotFoundException(__('Invalid Record'));
        }

        if ($this->request->is(array('Record', 'put'))) {
            $this->Record->id = $id;
            $this->request->data['Record']['user_id'] = $this->Auth->user('id');
            if ($foo = $this->Record->save($this->request->data)) {
                $this->Session->setFlash(__('Your Record has been updated.'));
                return $this->redirect(array('action' => 'index'));
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