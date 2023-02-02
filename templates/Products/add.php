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
                        <label class="form-control-label px-3">Product Image<span class="text-danger"> *</span></label>
                        <input type="file" id="product-image" name="product_image" placeholder="Enter your first name" >
                    </div>
                    <div class="form-group col-sm-12 flex-column d-flex">
                        <label class="form-control-label px-3">Product Title<span class="text-danger"> *</span></label>
                        <input type="text" id="product-title" name="product_title" placeholder="Enter your last name">
                    </div>
                </div>
                <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-12 flex-column d-flex">
                        <select class="form-control-label px-3" id="product_category_id" name="product_category_id" style="height: 42px;">
                            <?php foreach($productcategory as $list){  ?>
                                <option value="<?= $list->id ?>"><?= $list->category_name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-12 flex-column d-flex"> <label class="form-control-label px-3">Product Description<span class="text-danger"> *</span></label> <textarea type="text" id="product-description" name="product_description"></textarea> </div>
                </div>
                <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-12 flex-column d-flex"> <label class="form-control-label px-3">Product Tags<span class="text-danger"> *</span></label> <textarea type="text" id="product-tags" name="product_tags"></textarea> </div>
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