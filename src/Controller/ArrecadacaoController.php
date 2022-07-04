<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Controller\Component\CsrfComponent;

/**
 * Arrecadacao Controller
 *
 * @property \App\Model\Table\ArrecadacaoTable $Arrecadacao
 *
 * @method \App\Model\Entity\Arrecadacao[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArrecadacaoController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $query = $this->Arrecadacao->find()
                                   ->order(['dt_cadastro' => 'DESC']);
                                   
        $arrecadacao = $this->paginate($query);

        $this->viewBuilder()->layout('admin');
        $this->set(compact('arrecadacao'));
    }

    /**
     * View method
     *
     * @param string|null $id Arrecadacao id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $arrecadacao = $this->Arrecadacao->get($id, [
            'contain' => ['Dizimo'],
        ]);

        $this->viewBuilder()->layout('admin');
        $this->set('arrecadacao', $arrecadacao);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $arrecadacao = $this->Arrecadacao->newEntity();
        if ($this->request->is('post')) {
            $arrecadacao = $this->Arrecadacao->patchEntity($arrecadacao, $this->request->getData());
            $saved = $this->Arrecadacao->save($arrecadacao);
            if ($saved) {
                $this->Flash->success(__('The arrecadacao has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The arrecadacao could not be saved. Please, try again.'));
        }

        $this->loadModel('Lista');
        $diaconos = $this->Lista->listaDiaconos();
        $igrejas = $this->Lista->listaIgrejas();

        $this->viewBuilder()->layout('admin');

        $this->set(compact('arrecadacao', 'diaconos', 'igrejas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Arrecadacao id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $arrecadacao = $this->Arrecadacao->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $arrecadacao = $this->Arrecadacao->patchEntity($arrecadacao, $this->request->getData());
            if ($this->Arrecadacao->save($arrecadacao)) {
                $this->Flash->success(__('The arrecadacao has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The arrecadacao could not be saved. Please, try again.'));
        }
        $this->set(compact('arrecadacao'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Arrecadacao id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $arrecadacao = $this->Arrecadacao->get($id);
        if ($this->Arrecadacao->delete($arrecadacao)) {
            $this->Flash->success(__('The arrecadacao has been deleted.'));
        } else {
            $this->Flash->error(__('The arrecadacao could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function openArrecadacao($arrecadacao_id){

        $resultado = $this->Arrecadacao->carregarArrecadacao($arrecadacao_id);

        $arrecadacao = $resultado['arrecadacao'];
        $diaconos = $resultado['diaconos'];
        $igrejas = $resultado['igrejas'];
        $dizimo = $resultado['dizimo'];
        $usuarios = $resultado['usuarios'];
        $disable = $resultado['disable'];


        $this->viewBuilder()->layout('admin');

        $this->set(compact('arrecadacao', 'diaconos', 'igrejas', 'dizimo', 'usuarios', 'disable'));
        $this->set('_serialize', ['arrecadacao', 'diaconos', 'igrejas', 'dizimo', 'usuarios', 'disable']);
        
    }

    public function formDizimo($arrecadacao_id){

        
        $retorno = $this->Arrecadacao->listaDizimosUmaArrecadacao($arrecadacao_id);
        $dizimo = $retorno['dizimo'];
        $usuarios = $retorno['usuarios'];
        $sta_edicao = $retorno['sta_edicao'];

        $this->viewBuilder()->setLayout('ajax');

        $this->set(compact('dizimo', 'usuarios', 'sta_edicao'));
        $this->set('_serialize', ['dizimo', 'usuarios', 'sta_edicao']);
        //die();

    }

    public function finaliza(){

        $status = $this->Arrecadacao->finalizaArrecadacao($this->request->data);
        $this->set(compact('status'));
        $this->set('_serialize', ['status']);                                

    }
}
