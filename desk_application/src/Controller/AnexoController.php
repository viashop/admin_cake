<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Anexo Controller
 *
 * @property \App\Model\Table\AnexoTable $Anexo
 */
class AnexoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $anexo = $this->paginate($this->Anexo);

        $this->set(compact('anexo'));
        $this->set('_serialize', ['anexo']);
    }

    /**
     * View method
     *
     * @param string|null $id Anexo id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $anexo = $this->Anexo->get($id, [
            'contain' => []
        ]);

        $this->set('anexo', $anexo);
        $this->set('_serialize', ['anexo']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $anexo = $this->Anexo->newEntity();
        if ($this->request->is('post')) {
            $anexo = $this->Anexo->patchEntity($anexo, $this->request->data);
            if ($this->Anexo->save($anexo)) {
                $this->Flash->success(__('The anexo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The anexo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('anexo'));
        $this->set('_serialize', ['anexo']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Anexo id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $anexo = $this->Anexo->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $anexo = $this->Anexo->patchEntity($anexo, $this->request->data);
            if ($this->Anexo->save($anexo)) {
                $this->Flash->success(__('The anexo has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The anexo could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('anexo'));
        $this->set('_serialize', ['anexo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Anexo id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $anexo = $this->Anexo->get($id);
        if ($this->Anexo->delete($anexo)) {
            $this->Flash->success(__('The anexo has been deleted.'));
        } else {
            $this->Flash->error(__('The anexo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
