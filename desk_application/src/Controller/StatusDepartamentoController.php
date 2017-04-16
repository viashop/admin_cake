<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * StatusDepartamento Controller
 *
 * @property \App\Model\Table\StatusDepartamentoTable $StatusDepartamento
 */
class StatusDepartamentoController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $statusDepartamento = $this->paginate($this->StatusDepartamento);

        $this->set(compact('statusDepartamento'));
        $this->set('_serialize', ['statusDepartamento']);
    }

    /**
     * View method
     *
     * @param string|null $id Status Departamento id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statusDepartamento = $this->StatusDepartamento->get($id, [
            'contain' => ['ShTicket']
        ]);

        $this->set('statusDepartamento', $statusDepartamento);
        $this->set('_serialize', ['statusDepartamento']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $statusDepartamento = $this->StatusDepartamento->newEntity();
        if ($this->request->is('post')) {
            $statusDepartamento = $this->StatusDepartamento->patchEntity($statusDepartamento, $this->request->data);
            if ($this->StatusDepartamento->save($statusDepartamento)) {
                $this->Flash->success(__('The status departamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The status departamento could not be saved. Please, try again.'));
            }
        }
        $shTicket = $this->StatusDepartamento->ShTicket->find('list', ['limit' => 200]);
        $this->set(compact('statusDepartamento', 'shTicket'));
        $this->set('_serialize', ['statusDepartamento']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Status Departamento id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $statusDepartamento = $this->StatusDepartamento->get($id, [
            'contain' => ['ShTicket']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $statusDepartamento = $this->StatusDepartamento->patchEntity($statusDepartamento, $this->request->data);
            if ($this->StatusDepartamento->save($statusDepartamento)) {
                $this->Flash->success(__('The status departamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The status departamento could not be saved. Please, try again.'));
            }
        }
        $shTicket = $this->StatusDepartamento->ShTicket->find('list', ['limit' => 200]);
        $this->set(compact('statusDepartamento', 'shTicket'));
        $this->set('_serialize', ['statusDepartamento']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Status Departamento id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statusDepartamento = $this->StatusDepartamento->get($id);
        if ($this->StatusDepartamento->delete($statusDepartamento)) {
            $this->Flash->success(__('The status departamento has been deleted.'));
        } else {
            $this->Flash->error(__('The status departamento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
