<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\Component\CsrfComponent;

/**
 * Dizimo Controller
 *
 * @property \App\Model\Table\DizimoTable $Dizimo
 *
 * @method \App\Model\Entity\Dizimo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DizimoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $dizimo = $this->paginate($this->Dizimo);

        $this->set(compact('dizimo'));
    }

    /**
     * View method
     *
     * @param string|null $id Dizimo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dizimo = $this->Dizimo->get($id, [
            'contain' => [],
        ]);

        $this->set('dizimo', $dizimo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(){
        
        $this->request->allowMethod(['post', 'delete']);
        $dizimo = $this->Dizimo->inserirDizimo($this->request->data);
        $this->set('_serialize', ['dizimo']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Dizimo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null){

        $this->request->allowMethod(['post', 'delete']);
        $dizimo = $this->Dizimo->excluirDizimo($this->request->data['id']);
        $this->set('_serialize', ['dizimo']);        
        
    }

    /**
     * Edit method
     *
     * @param string|null $id Dizimo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dizimo = $this->Dizimo->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dizimo = $this->Dizimo->patchEntity($dizimo, $this->request->getData());
            if ($this->Dizimo->save($dizimo)) {
                $this->Flash->success(__('The dizimo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The dizimo could not be saved. Please, try again.'));
        }
        $this->set(compact('dizimo'));
    }

}
