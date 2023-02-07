<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Mailer\Email;
use Cake\Mailer\Mailer;
use Cake\Mailer\TransportFactory;
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
        $this->Model = $this->loadModel('ProductComments');
        $this->loadComponent('Flash');
        $this->viewBuilder()->setLayout('mydefault');
        // $this->loadComponent('Rahul');        
    }

    public function index()
    {
        $this->viewBuilder()->setLayout('admin');
        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        if($user->user_type == 0){
            return $this->redirect(['controller'=>'products','action' => 'productcategories',]);
        }
        $status = $this->UserProfile->get($uid, [
            'contain' => ['Users'],
        ]);
        $this->paginate=[
            'contain' => ['UserProfile'],
        ];
        $status=$this->request->getQuery('status');
        if($status != null ){
            dd($status);
            $users = $this->Users->find('all')->contain('UserProfile')->where(['status'=>$status]);       
        }else{
            $users = $this->paginate($this->Users);
        }

        $this->set(compact('users','status'));
        if($this->request->is('ajax')){
            echo "dfd";
        // $this->autoRender=false;
        // $this->render('element/flash/user_index');
        // dd($users);die;
    }
    }

    
    public function services()
    {
        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        $status = $this->UserProfile->get($uid, [
            'contain' => ['Users'],
        ]);
        $users = $this->paginate($this->Users);

        $this->set(compact('users','status'));
    }

    // ================user-status===========
    public function userstatus($id=null,$status = null)
    {
        $userstatus = $this->Users->get($id);
        if($status == 1){
            $userstatus->status = 2;
        }else{
            $userstatus->status = 1;
        }
        if($this->Users->save($userstatus)){
            $this->Flash->success(__('The user status has been changed.'));
        }
          return  $this->redirect(['action'=>'index']);
        $this->set(compact('userstatus'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
   
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */

    // ==================signup page ==================

    public function add()
    {
        $this->viewBuilder()->setLayout('mylogin');

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            // ==========add image ===============
            $data = $this->request->getData();
            $productImage = $this->request->getData("user_profile.profile_image");
            $fileName = $productImage->getClientFilename();
            $data["user_profile"]["profile_image"] = $fileName;
            $email=$data["email"];
            $result = $this->Users->find('all')->where(['email' => $email])->first();
            if($result){
                $this->Flash->error(__('Email already in use.'));
            }else{
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

        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        $status = $this->UserProfile->get($uid, [
            'contain' => ['Users'],
        ]);
        $user = $this->Users->get($id, [
            'contain' => ['UserProfile'],
        ]);
        $fileName2 = $user['user_profile']['profile_image'];

        // print_r($user);die;
        // echo $user['user_profile']['profile_image'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            // ==========add image ===============
            $productImage = $this->request->getData("user_profile.profile_image");
            $fileName = $productImage->getClientFilename();
            if ($fileName == '') {
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
                    return $this->redirect(['action' => 'userprofile', $id]);
                }
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }

        // echo '<pre>';
        // print_r($user);
        // die;
        $this->set(compact('user','status'));
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
        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        $this->Users->ProductComments->deleteAll(array('user_id' => $id));
        $this->Users->UserProfile->deleteAll(array('user_id' => $id));
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The post has been deleted.'));
        } else {
            $this->Flash->error(__('The post could not be deleted. Please, try again.'));
        }
        if($uid == $id){
            return $this->redirect(['controller' => 'Users', 'action' => 'logout']);
        }else{
            return $this->redirect(['controller' => 'Users', 'action' => 'index']);
        }
    }

    // ===================before login =====================
    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        // Configure the login action to not require authentication, preventing
        // the infinite redirect loop issue
        $this->Authentication->addUnauthenticatedActions(['login', 'add','forgot','getotp','reset']);
    }
    // ===================login=====================

    public function login()
    {
        $this->viewBuilder()->setLayout('mylogin');

        $this->request->allowMethod(['get', 'post']);
        $result = $this->Authentication->getResult();
        // regardless of POST or GET, redirect if user is logged in
        if ($result->isValid()) {
             $user = $this->Authentication->getIdentity();
            if($user->status == 2){
                $this->Flash->error(__('Invalid email or password'));
                $redirect = $this->request->getQuery('redirect', [
                    'controller' => 'Users',
                    'action' => 'logout',
                ]);
                return $this->redirect($redirect);
            }else if($user->status == 1){
              
            // redirect to /articles after login success
            $this->Flash->success(__('Login Successfully'));

            $redirect = $this->request->getQuery('redirect', [
                'controller' => 'Products',
                'action' => 'productcategories',
            ]);

            return $this->redirect($redirect);
        }
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
        // echo $uid;
        $uid = $user->id;
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
                //   print_r($user);die;
                    $status = $this->UserProfile->get($uid, [
                        'contain' => ['Users'],
                    ]);
        // echo '<pre>';
        // print_r($user);die;
        // $post=TableRegistry::get("Posts");
        // $count = $this->Posts->find()->where(['user_id' => $id])->count();
        // echo '<pre>';
        // print_r($user);
        // die;
        $this->set(compact('user', 'uid','status'));
    }

    // =======================forget password==========================
    public function forgot()
    {
        $this->viewBuilder()->setLayout('mylogin');

        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $email = $this->request->getData('email');
            $user->email = $email;
            $result = $this->Users->checkEmailExist($email);
            if ($result) {
            $token = rand(10000, 99999);
            $result = $this->Users->insertToken($email, $token);

                $mailer = new Mailer('default');
                $mailer->setTransport('gmail'); //your email configuration name
                $mailer->setFrom(['kunal02chd@gmail.com' => 'Code The Pixel']);
                $mailer->setTo($email);
                $mailer->setEmailFormat('html');
                $mailer->setSubject('O.T.P');
                $mailer->deliver("$token is your one time password for animeclub");

                $this->Flash->success(__('Reset email send successfully.'));

                return $this->redirect(['action' => 'getotp']);
            }
            $this->Flash->error(__('Please enter valid credential..'));
        }
        $this->set(compact('user'));
    }

    //  ===================get otp=======================
    public function getotp()
    {
        
        $this->viewBuilder()->setLayout('mylogin');
        // $this->viewBuilder()->setLayout('mydefault');
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            
            $token = $this->request->getData('token');
            $result = $this->Users->checktokenexist($token);
           
            if ($result) {
                $session = $this->getRequest()->getSession(); //get session
                $session->write('token', $token); //write name value to session
                return $this->redirect(['action' => 'reset']);
            }
            $this->Flash->error(__('Please enter valid password'));
        }
        $this->set(compact('user'));
    }

    // ======================reset password==============================
    public function reset()
    {
    $this->viewBuilder()->setLayout('mylogin');
        $session = $this->request->getSession(); //read session data
        if ($session->read('token') != null) {
        } else {
            $this->redirect(['action' => 'login']);
        } 
            $token=$session->read('token');
            $user = $this->Users->newEmptyEntity();
            if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $password = $this->request->getData('password');
            $confirm_password = $this->request->getData('confirm_password');
            // echo '<pre>';
            // print_r($confirm_password);
            // print_r($password);
            // die;
                if($password == $confirm_password){
                $res = $this->Users->resetPassword($token, $password);
                if ($res) {
                    $session->destroy();
                    $this->Flash->success(__('Password updated successfully.'));
                    return $this->redirect(['action' => 'login']);
                }
            }
                $this->Flash->error(__('Please enter valid password'));   
        }
        $this->set(compact('user'));
    }
}
