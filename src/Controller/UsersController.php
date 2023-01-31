<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function initialize(): void
    {
        $this->loadComponent('Authentication.Authentication');
        $this->Model = $this->loadModel('UserProfile');
        $this->loadComponent('Flash');
        $this->viewBuilder()->setLayout('mydefault');
        // $this->loadComponent('Rahul');        
    }

    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['ProductComments', 'UserProfile'],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */

    // ==================signup page ==================

    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            // ==========add image ===============
            $productImage = $this->request->getData("user_profile.profile_image");
            $fileName = $productImage->getClientFilename();
            $data["user_profile"]["profile_image"] = $fileName;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                if ($this->UserProfile->save($user)) {
                    $hasFileError = $productImage->getError();

                    if ($hasFileError > 0) {
                        // no file uploaded
                        $data["user_profile"]["profile_image"] = "";
                    } else {
                        // file uploaded
                        $fileType = $productImage->getClientMediaType();

                        if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                            $imagePath = WWW_ROOT . "img/" . $fileName;
                            $productImage->moveTo($imagePath);
                            $data["user_profile"]["profile_image"] = $fileName;
                        }
                    }
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }


    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $user = $this->Users->get($id, [
            'contain' => ['UserProfile'],
        ]);
        $fileName2=$user['user_profile']['profile_image'];

        // print_r($user);die;
        // echo $user['user_profile']['profile_image'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
                // ==========add image ===============
                $productImage = $this->request->getData("user_profile.profile_image");
                $fileName = $productImage->getClientFilename();
                if($fileName == ''){
                    $fileName = $fileName2;
                }
                $data["user_profile"]["profile_image"] = $fileName;
                $user = $this->Users->patchEntity($user, $data);
                if ($this->Users->save($user)) {
                    if ($this->UserProfile->save($user)) {
                        $hasFileError = $productImage->getError();
    
                        if ($hasFileError > 0) {
                            // no file uploaded
                            $data["user_profile"]["profile_image"] = "";
                        } else {
                            // file uploaded
                            $fileType = $productImage->getClientMediaType();
    
                            if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                                $imagePath = WWW_ROOT . "img/" . $fileName;
                                $productImage->moveTo($imagePath);
                                $data["user_profile"]["profile_image"] = $fileName;
                            }
                        }
                        $this->Flash->success(__('The user has been saved.'));
                        return $this->redirect(['action' => 'userprofile',$id]);
                    }
                }
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
            
            // echo '<pre>';
            // print_r($user);
            // die;
            $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
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

    // ===================before login =====================
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add']);
    }
    // ===================login=====================

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            // redirect to /articles after login success
            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Products',
                'action' => 'index',
            ]);

            return $this->redirect($redirect);
        }
        // display error if user submitted and authentication failed
        if ($this->request->is('post') && !$result->isValid()) {
            $this->Flash->error(__('Invalid email or password'));
        }
    }
    // ========================logout ============================
    public function logout()
    {
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
            $this->Authentication->logout();
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }

    // ==================user profile =======================
    public function userprofile($id = null)
    {
        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        // echo $uid;
        if ($user->user_type == 0) {
            $user = $this->Users->get($uid, [
                'contain' => ['UserProfile'],
            ]);
        } else if ($user->user_type == 1) {
            $user = $this->Users->get($id, [
                'contain' => ['UserProfile'],
            ]);
        }
        // echo '<pre>';
        // print_r($user);die;
        // $post=TableRegistry::get("Posts");
        // $count = $this->Posts->find()->where(['user_id' => $id])->count();
        // echo '<pre>';
        // print_r($user);
        // die;
        $this->set(compact('user', 'uid'));
    }
}
