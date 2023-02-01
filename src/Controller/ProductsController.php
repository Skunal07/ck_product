<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Products Controller
 *
 * @property \App\Model\Table\ProductsTable $Products
 * @method \App\Model\Entity\Product[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ProductsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function initialize(): void
    {
        $this->loadComponent('Authentication.Authentication');
        $this->Model = $this->loadModel('ProductCategories');
        $this->Model = $this->loadModel('ProductComments');
        $this->Model = $this->loadModel('UserProfile');
        $this->Model = $this->loadModel('Users');
        $this->loadComponent('Flash');
        $this->viewBuilder()->setLayout('mydefault');
        // $this->loadComponent('Rahul');        
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['ProductCategories'],
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products'));
    }
    public function productcategories($id=null)
    {
        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        $status = $this->UserProfile->get($uid, [
            'contain' => ['Users'],
        ]);

        $this->paginate = [
            'contain' => ['ProductCategories'],
        ];
        $this->paginate = [
            'contain' => [],
        ];
        $key = $this->request->getQuery('key');
        if($key){
            $query =$this->Products->find('all')
                ->where(['Or'=>['product_title like'=>'%'.$key.'%','product_tags like'=>'%'.$key.'%']]);
        }else{
            $query=$this->Products;
        }
        $products = $this->paginate($query);
        if($id != null){
            $products = $this->Products->find()->where(['product_category_id'=>$id])->all();
        }
        $productc = $this->paginate($this->ProductCategories);
        // echo '<pre>';
        // print_r($productc);die;

        $this->set(compact('products','productc','status','id'));
    }

    /**
     * View method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {

        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        $product = $this->Products->get($id, [
            'contain' => ['ProductCategories', 'ProductComments'],
        ]);
        $user = $this->UserProfile->get($uid, [
            'contain' => [],
        ]);
        $status = $this->UserProfile->get($uid, [
            'contain' => ['Users'],
        ]);
        $comments = $this->ProductComments->find('all',['contain' => ['Users','Users.UserProfile']])->where(['product_id'=>$id])->all();

        // echo '<pre>';
        // print_r($comments);die;

        // $comments = $this->Product->find('all',['contain' => ['category']])->where(['product_category_id'=>$id])->all();
        $comment = $this->ProductComments->newEmptyEntity();           
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $data['product_id'] = $id;
            $data['user_id'] = $uid;
            $comment = $this->ProductComments->patchEntity($comment, $data);
            if ($this->ProductComments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));
                return $this->redirect(['controller'=>'products','action' => 'view', $id]);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }

        $this->set(compact('product','comments','comment','user','status'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $productCategories = $this->Products->ProductCategories->find('list', ['limit' => 200])->all();
        $this->set(compact('product', 'productCategories'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $product = $this->Products->patchEntity($product, $this->request->getData());
            if ($this->Products->save($product)) {
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $productCategories = $this->Products->ProductCategories->find('list', ['limit' => 200])->all();
        $this->set(compact('product', 'productCategories'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Product id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $product = $this->Products->get($id);
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
