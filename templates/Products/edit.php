<!-- <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 * @var string[]|\Cake\Collection\CollectionInterface $productCategories
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $product->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="products form content">
            <?= $this->Form->create($product) ?>
            <fieldset>
                <legend><?= __('Edit Product') ?></legend>
                    <?= $this->Form->control('product_title'); ?>
                    <?= $this->Form->control('product_description'); ?>
                    <?= $this->Form->control('product_category_id', ['options' => $productCategories]); ?>
                    <?= $this->Form->control('product_image'); ?>
                    <?= $this->Form->control('product_tags'); ?>
                    <?= $this->Form->control('status'); ?>
                    <?= $this->Form->control('created_date'); ?>
                    <?= $this->Form->control('modified_date'); ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->

<div class="container-fluid px-1 py-5 mx-auto">
    <div class="row d-flex justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
            <h3>Add Products</h3>
            <!-- <p class="blue-text">Just answer a few questions<br> so that we can personalize the right experience for you.</p> -->
            <div class="card">
                <h5 class="text-center mb-4">Powering world-class companies</h5>
                <?= $this->Form->create($product, ['type' => 'file']) ?>
                <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-12 flex-column d-flex">
                    <?= $this->Html->image($product->product_image, array('width'=>'100px')); ?>
                        <label class="form-control-label px-3">Product Image<span class="text-danger"> *</span></label>
                        <input type="file" id="product-image" name="product_image" placeholder="Enter your first name" >
                    </div>
                    <div class="form-group col-sm-12 flex-column d-flex">
                    <?= $this->Form->control('product_title'); ?>
                    </div>
                </div>
                <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-12 flex-column d-flex">
                        <select class="form-control-label px-3" id="product_category_id" name="product_category_id" style="height: 42px;">
                            <?php foreach($productcategory as $list){  
                                if($product->product_category_id == $list->id){?>
                                <option value="<?= $list->id ?>" selected ><?= $list->category_name ?></option>
                                <?php }else{ ?>
                                    <option value="<?= $list->id ?>"  ><?= $list->category_name ?></option>

                          <?php  }} ?>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-12 flex-column d-flex">  <?= $this->Form->control('product_description'); ?> </div>
                </div>
                
                <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-12 flex-column d-flex"> <?= $this->Form->control('product_tags'); ?> </div>
                </div>

                <div class="row justify-content-end">
                    <?= $this->Form->button(__('Submit')) ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>
</div>
<?= $this->Html->css('addp', ['block' => 'css'])    ?>