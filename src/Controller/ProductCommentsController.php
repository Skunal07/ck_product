<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * ProductComments Controller
 *
 * @property \App\Model\Table\ProductCommentsTable $ProductComments
 * @method \App\Model\Entity\ProductComment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductCommentsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Products', 'Users'],
        ];
        $productComments = $this->paginate($this->ProductComments);

        $this->set(compact('productComments'));
    }

    /**
     * View method
     *
     * @param string|null $id Product Comment id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $productComment = $this->ProductComments->get($id, [
            'contain' => ['Products', 'Users'],
        ]);

        $this->set(compact('productComment'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $productComment = $this->ProductComments->newEmptyEntity();
        if ($this->request->is('post')) {
            $productComment = $this->ProductComments->patchEntity($productComment, $this->request->getData());
            if ($this->ProductComments->save($productComment)) {
                $this->Flash->success(__('The product comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product comment could not be saved. Please, try again.'));
        }
        $products = $this->ProductComments->Products->find('list', ['limit' => 200])->all();
        $users = $this->ProductComments->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('productComment', 'products', 'users'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product Comment id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $productComment = $this->ProductComments->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productComment = $this->ProductComments->patchEntity($productComment, $this->request->getData());
            if ($this->ProductComments->save($productComment)) {
                $this->Flash->success(__('The product comment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product comment could not be saved. Please, try again.'));
        }
        $products = $this->ProductComments->Products->find('list', ['limit' => 200])->all();
        $users = $this->ProductComments->Users->find('list', ['limit' => 200])->all();
        $this->set(compact('productComment', 'products', 'users'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product Comment id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null,$product_id)
    {
        $this->request->allowMethod(['post', 'delete']);
        $productComment = $this->ProductComments->get($id);
        if ($this->ProductComments->delete($productComment)) {
            $this->Flash->success(__('The product comment has been deleted.'));
        } else {
            $this->Flash->error(__('The product comment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['controller' => 'products', 'action' => 'view',$product_id]);
    }
}
