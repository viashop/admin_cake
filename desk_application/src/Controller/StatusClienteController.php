<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StatusCliente Controller
 *
 * @property \App\Model\Table\StatusClienteTable $StatusCliente
 */
class StatusClienteController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $statusCliente = $this->paginate($this->StatusCliente);

        $this->set(compact('statusCliente'));
        $this->set('_serialize', ['statusCliente']);
    }

    /**
     * View method
     *
     * @param string|null $id Status Cliente id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statusCliente = $this->StatusCliente->get($id, [
            'contain' => ['ShTicket']
        ]);

        $this->set('statusCliente', $statusCliente);
        $this->set('_serialize', ['statusCliente']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $statusCliente = $this->StatusCliente->newEntity();
        if ($this->request->is('post')) {
            $statusCliente = $this->StatusCliente->patchEntity($statusCliente, $this->request->data);
            if ($this->StatusCliente->save($statusCliente)) {
                $this->Flash->success(__('The status cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The status cliente could not be saved. Please, try again.'));
            }
        }
        $shTicket = $this->StatusCliente->ShTicket->find('list', ['limit' => 200]);
        $this->set(compact('statusCliente', 'shTicket'));
        $this->set('_serialize', ['statusCliente']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Status Cliente id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $statusCliente = $this->StatusCliente->get($id, [
            'contain' => ['ShTicket']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $statusCliente = $this->StatusCliente->patchEntity($statusCliente, $this->request->data);
            if ($this->StatusCliente->save($statusCliente)) {
                $this->Flash->success(__('The status cliente has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The status cliente could not be saved. Please, try again.'));
            }
        }
        $shTicket = $this->StatusCliente->ShTicket->find('list', ['limit' => 200]);
        $this->set(compact('statusCliente', 'shTicket'));
        $this->set('_serialize', ['statusCliente']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Status Cliente id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statusCliente = $this->StatusCliente->get($id);
        if ($this->StatusCliente->delete($statusCliente)) {
            $this->Flash->success(__('The status cliente has been deleted.'));
        } else {
            $this->Flash->error(__('The status cliente could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
