<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Igreja Controller
 *
 * @property \App\Model\Table\IgrejaTable $Igreja
 *
 * @method \App\Model\Entity\Igreja[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class IgrejaController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $igreja = $this->paginate($this->Igreja);

        $this->set(compact('igreja'));
    }

    /**
     * View method
     *
     * @param string|null $id Igreja id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $igreja = $this->Igreja->get($id, [
            'contain' => [],
        ]);

        $this->set('igreja', $igreja);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $igreja = $this->Igreja->newEntity();
        if ($this->request->is('post')) {
            $igreja = $this->Igreja->patchEntity($igreja, $this->request->getData());
            if ($this->Igreja->save($igreja)) {
                $this->Flash->success(__('The igreja has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The igreja could not be saved. Please, try again.'));
        }
        $this->set(compact('igreja'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Igreja id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $igreja = $this->Igreja->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $igreja = $this->Igreja->patchEntity($igreja, $this->request->getData());
            if ($this->Igreja->save($igreja)) {
                $this->Flash->success(__('The igreja has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The igreja could not be saved. Please, try again.'));
        }
        $this->set(compact('igreja'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Igreja id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $igreja = $this->Igreja->get($id);
        if ($this->Igreja->delete($igreja)) {
            $this->Flash->success(__('The igreja has been deleted.'));
        } else {
            $this->Flash->error(__('The igreja could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
