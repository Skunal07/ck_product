<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * UserProfile Controller
 *
 * @property \App\Model\Table\UserProfileTable $UserProfile
 * @method \App\Model\Entity\UserProfile[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UserProfileController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users'],
        ];
        $userProfile = $this->paginate($this->UserProfile);

        $this->set(compact('userProfile'));
    }

    /**
     * View method
     *
     * @param string|null $id User Profile id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $userProfile = $this->UserProfile->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set(compact('userProfile'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $userProfile = $this->UserProfile->newEmptyEntity();
        if ($this->request->is('post')) {
            $userProfile = $this->UserProfile->patchEntity($userProfile, $this->request->getData());
            if ($this->UserProfile->save($userProfile)) {
                $this->Flash->success(__('The user profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user profile could not be saved. Please, try again.'));
        }
        $users = $this->UserProfile->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('userProfile', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User Profile id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userProfile = $this->UserProfile->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $userProfile = $this->UserProfile->patchEntity($userProfile, $this->request->getData());
            if ($this->UserProfile->save($userProfile)) {
                $this->Flash->success(__('The user profile has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user profile could not be saved. Please, try again.'));
        }
        $users = $this->UserProfile->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('userProfile', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User Profile id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $userProfile = $this->UserProfile->get($id);
        if ($this->UserProfile->delete($userProfile)) {
            $this->Flash->success(__('The user profile has been deleted.'));
        } else {
            $this->Flash->error(__('The user profile could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
