<?php
namespace App\Controller;

use App\Controller\AppController;
use Respect\Validation\Validator as v;

/**
 * Departamento Controller
 *
 * @property \App\Model\Table\DepartamentoTable $Departamento
 */
class DepartamentoController extends AppController
{

    const ERRO = 'Houve um erro ao tentar cadastrar. Por favor, tente novamente...';

    public $paginate = [
        'limit' => 10
    ];

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $Departamento = $this->paginate($this->Departamento);

        $this->set(compact('Departamento'));
        $this->set('_serialize', ['Departamento']);
    }

    /**
     * View method
     *
     * @param string|null $id Ticket Departamento id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $Departamento = $this->Departamento->get($id, [
            'contain' => []
        ]);

        $this->set('Departamento', $Departamento);
        $this->set('_serialize', ['Departamento']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        try {

            $Departamento = $this->Departamento->newEntity();
            if ($this->request->is('post')) {
                $Departamento = $this->Departamento->patchEntity($Departamento, $this->request->data);

                if (!v::email()->validate($this->request->data['email_departamento'])) {
                    throw new \Exception('Por favor, cadastre um email válido.');
                }

                if ($this->Departamento->save($Departamento)) {
                    $this->Flash->success(__('Cadastro efetuado com sucesso.'));

                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Houve um erro ao tentar cadastrar. Por favor, tente novamente...'));
                }
            }
            $this->set(compact('Departamento'));
            $this->set('_serialize', ['Departamento']);


        } catch (\Exception $e) {

            $this->Flash->error(__($e->getMessage()));
            return $this->redirect($this->referer());

        }


    }

    /**
     * Edit method
     *
     * @param string|null $id Ticket Departamento id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        try {

            $Departamento = $this->Departamento->get($id, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $Departamento = $this->Departamento->patchEntity($Departamento, $this->request->data);
                if ($this->Departamento->save($Departamento)) {
                    $this->Flash->success(__('Dados Editados com sucesso.'));

                    return $this->redirect(['action' => 'index']);
                } else {
                    $this->Flash->error(__('Houve um erro ao tentar editar. Por favor, tente novamente...'));
                }
            }
            $this->set(compact('Departamento'));
            $this->set('_serialize', ['Departamento']);


        } catch (\Exception $e) {

            $this->Flash->error(__($e->getMessage()));
            return $this->redirect($this->referer());

        }


    }

    /**
     * Delete method
     *
     * @param string|null $id Ticket Departamento id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $Departamento = $this->Departamento->get($id);
        if ($this->Departamento->delete($Departamento)) {
            $this->Flash->success(__('Departamento excluído com sucesso.'));
        } else {
            $this->Flash->error(__('Houve um erro ao tentar excluir. Por favor, tente novamente...'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
