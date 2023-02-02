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

    public function indexproductc($id=null)
    {
        $this->viewBuilder()->setLayout('admin');
        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        $status = $this->UserProfile->get($uid, [
            'contain' => ['Users'],
        ]);
        $productcat = $this->ProductCategories->newEmptyEntity();           
        if ($this->request->is(['patch', 'post', 'put'])) {
            $productcat = $this->ProductCategories->patchEntity($productcat, $this->request->getData());
            if ($this->ProductCategories->save($productcat)) {
                $this->Flash->success(__('The comment has been saved.'));
                return $this->redirect(['controller'=>'products','action' => 'indexproductc',]);
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
        }
        $productCategories = $this->paginate($this->ProductCategories);

        $this->set(compact('productCategories','status','productcat'));
    }


    public function index()
    {
        $this->viewBuilder()->setLayout('admin');
        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        $status = $this->UserProfile->get($uid, [
            'contain' => ['Users'],
        ]);
        $this->paginate = [
            'contain' => ['ProductCategories'],
        ];
        $products = $this->paginate($this->Products);

        $this->set(compact('products','status'));
    }

 // ================product category-status===========
 public function productcstatus($id=null,$status = null)
 {
     $productcstatus = $this->ProductCategories->get($id);
     if($status == 1){
         $productcstatus->status = 0;
     }else{
         $productcstatus->status = 1;
     }
     if($this->ProductCategories->save($productcstatus)){
         $this->Flash->success(__('The user status has been changed.'));
     }
       return  $this->redirect(['controller'=>'products','action'=>'indexproductc']);
     $this->set(compact('userstatus'));
 }


 // ================product -status===========
 public function productstatus($id=null,$status = null)
 {
     $productstatus = $this->Products->get($id);
     if($status == 1){
         $productstatus->status = 0;
     }else{
         $productstatus->status = 1;
     }
     if($this->Products->save($productstatus)){
         $this->Flash->success(__('The user status has been changed.'));
     }
       return  $this->redirect(['controller'=>'products','action'=>'index']);
     $this->set(compact('userstatus'));
 }



    // ============product and category ===============
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
//  ===========================delete category =======================

// public function deletecat($id = null)
// {
//     $this->request->allowMethod(['post', 'delete']);
//     $productCategory = $this->ProductCategories->get($id);
//     $products = $this->Products->find()->where(['product_category_id'=>$id])->all();
    
//     // $this->ProductCategories->Products->deleteAll(array('product_category_id' => $id));
//     dd($products);die;
//     $this->ProductCategories->Products->ProductComments->deleteAll(array('product_id' => $id));
//     if ($this->ProductCategories->delete($productCategory)) {
//         $this->Flash->success(__('The product category has been deleted.'));
//     } else {
//         $this->Flash->error(__('The product category could not be deleted. Please, try again.'));
//     }

//     return $this->redirect(['action' => 'index']);
// }
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
        $user = $this->Authentication->getIdentity();
            $uid = $user->id;
            $status = $this->UserProfile->get($uid, [
                'contain' => ['Users'],
            ]);
           
            $productcategory = $this->paginate($this->ProductCategories);
            // echo '<pre>';
            // print_r($productcategory);die;
        $product = $this->Products->newEmptyEntity();
        if ($this->request->is('post')) {
            // ==========add image ===============
            $data = $this->request->getData();
            $productImage = $this->request->getData("product_image");
            $fileName = $productImage->getClientFilename();
            $data["product_image"] = $fileName;
            $product = $this->Products->patchEntity($product, $data);
            
            if ($this->Products->save($product)) {
               
                    $hasFileError = $productImage->getError();

                    if ($hasFileError > 0) {
                        // no file uploaded
                        $data["product_image"] = "";
                    } else {
                        // file uploaded
                        $fileType = $productImage->getClientMediaType();

                        if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                            $imagePath = WWW_ROOT . "img/" . $fileName;
                            $productImage->moveTo($imagePath);
                            $data["product_image"] = $fileName;
                        }
                    }
                    $this->Flash->success(__('The user has been saved.'));
                    return $this->redirect(['action' => 'productcategories']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('productcategory','product','status'));
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
        $user = $this->Authentication->getIdentity();
        $uid = $user->id;
        $status = $this->UserProfile->get($uid, [
            'contain' => ['Users'],
        ]);
        $product = $this->Products->get($id, [
            'contain' => [],
        ]);
        $productcategory = $this->paginate($this->ProductCategories);
        $fileName2 = $product['product_image'];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();
            $productImage = $this->request->getData("product_image");
            $fileName = $productImage->getClientFilename();
            if ($fileName == '') {
                $fileName = $fileName2;
            }
            $data["product_image"] = $fileName;
            $product = $this->Products->patchEntity($product,$data);
            if ($this->Products->save($product)) {
                $hasFileError = $productImage->getError();

                if ($hasFileError > 0) {
                    // no file uploaded
                    $data["product_image"] = "";
                } else {
                    // file uploaded
                    $fileType = $productImage->getClientMediaType();

                    if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                        $imagePath = WWW_ROOT . "img/" . $fileName;
                        $productImage->moveTo($imagePath);
                        $data["product_image"] = $fileName;
                    }
                }
                $this->Flash->success(__('The product has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The product could not be saved. Please, try again.'));
        }
        $productCategories = $this->Products->ProductCategories->find('list', ['limit' => 200])->all();
        $this->set(compact('product', 'productCategories','productcategory','status'));
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
        $this->Products->ProductComments->deleteAll(array('Product_id' => $id));
        if ($this->Products->delete($product)) {
            $this->Flash->success(__('The product has been deleted.'));
        } else {
            $this->Flash->error(__('The product could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
