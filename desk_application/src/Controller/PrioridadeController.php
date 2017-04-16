<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Prioridade Controller
 *
 * @property \App\Model\Table\PrioridadeTable $Prioridade
 */
class PrioridadeController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $prioridade = $this->paginate($this->Prioridade);

        $this->set(compact('prioridade'));
        $this->set('_serialize', ['prioridade']);
    }

    /**
     * View method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $prioridade = $this->Prioridade->get($id, [
            'contain' => ['ShTicket']
        ]);

        $this->set('prioridade', $prioridade);
        $this->set('_serialize', ['prioridade']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $prioridade = $this->Prioridade->newEntity();
        if ($this->request->is('post')) {
            $prioridade = $this->Prioridade->patchEntity($prioridade, $this->request->data);
            if ($this->Prioridade->save($prioridade)) {
                $this->Flash->success(__('The prioridade has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prioridade could not be saved. Please, try again.'));
            }
        }
        $shTicket = $this->Prioridade->ShTicket->find('list', ['limit' => 200]);
        $this->set(compact('prioridade', 'shTicket'));
        $this->set('_serialize', ['prioridade']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $prioridade = $this->Prioridade->get($id, [
            'contain' => ['ShTicket']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $prioridade = $this->Prioridade->patchEntity($prioridade, $this->request->data);
            if ($this->Prioridade->save($prioridade)) {
                $this->Flash->success(__('The prioridade has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The prioridade could not be saved. Please, try again.'));
            }
        }
        $shTicket = $this->Prioridade->ShTicket->find('list', ['limit' => 200]);
        $this->set(compact('prioridade', 'shTicket'));
        $this->set('_serialize', ['prioridade']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Prioridade id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $prioridade = $this->Prioridade->get($id);
        if ($this->Prioridade->delete($prioridade)) {
            $this->Flash->success(__('The prioridade has been deleted.'));
        } else {
            $this->Flash->error(__('The prioridade could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
