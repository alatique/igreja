<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Http\Exception\NotFoundException;


/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index($param = null)
    {

        $conditions = [];

        if (!is_null($param)){
            $conditions[] = ['name like "%'.$param.'%"'];
        } else {
            $conditions[] = "1=1";    
        }


        $query = $this->Users->find()
                      ->where($conditions);


        // paginacao
        $this->paginate = [
            'limit' => 10
        ];

        $users = $this->paginate($query);
        

        //$users = $this->paginate($this->Users);

        
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
        $this->viewBuilder()->layout('admin');
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->email = $user->username;
            $user->dt_cadastro = date('Y-m-d');
            $user->zip = str_replace('-', '', $user->zip);
            $user->tel = str_replace(['-','(',')',' '], '', $user->tel);
            $user->cel = str_replace(['-','(',')',' '], '', $user->cel);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        $this->loadModel('Lista');
        $igrejas = $this->Lista->listaIgrejas();

        $this->viewBuilder()->layout('admin');
        $this->set(compact('user', 'igrejas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->zip = str_replace('-', '', $user->zip);
            $user->tel = str_replace(['-','(',')',' '], '', $user->tel);
            $user->cel = str_replace(['-','(',')',' '], '', $user->cel);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        
        $this->loadModel('Lista');
        $igrejas = $this->Lista->listaIgrejas();

        $this->viewBuilder()->layout('admin');
        $this->set(compact('user', 'igrejas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function login(){

        if($this->request->is('post')){
            //Auth->identify() verifica se o registro existe no banco de dados
            $user = $this->Auth->identify();
            
            if($user){   
                //comando que loga o usuario no sistema
                $this->Auth->setUser($user);
                $this->request->session()->write('Auth.User.obj', $user);
                //para o redirect funcinar, necessário implementar loadComponent('Auth', ['loginRedirect') no AppController.php. Ele funciona casado com o loginRedirect
                return $this->redirect($this->Auth->redirectUrl());
            
            } else {
                $this->Flash->error(__('Usuário e/ou senha incorretos'));
            }
        }

        $this->viewBuilder()->setLayout('login');

    }
    

    public function logout(){
        //para o redirect funcionar, necessário implementar loadComponent('Auth', ['logoutRedirect') no AppController.php
        $this->Flash->success('Você saiu com sucesso');
        return $this->redirect($this->Auth->logout());

    }


    public function readExcel(){

        $this->loadModel('Excel');
        $dados = $this->Excel->importExcelFile($_FILES);

        if ($this->Users->saveUsers($dados)) {
            return $this->redirect(['action' => 'index']);
        } 

        throw new NotFoundException(__("Houve um erro ao salvar os usuários"));

    }


    public function importUsersExcel(){

        $this->loadComponent('Csrf');
        $header = $this->request->getParam('_csrfToken');

        $this->viewBuilder()->layout('admin');
        $this->set(compact('header'));

    }
}
