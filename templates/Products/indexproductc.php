<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ProductCategory> $productCategories
 */
?>
<div class="productCategories index content">

    <h3><?= __('Product Categories') ?></h3>
    <div class="table-responsive" style="overflow: hidden;">
        <div class="row">
            <div class="col-md-4">
            </div>
            <div class="col-md-6">
                <?= $this->Form->create($productcat) ?>
                <div class="d-flex flex-row add-comment-section mt-4 mb-4">

                    <input type="text" name="category_name" id="category_name" class="form-control mr-3" placeholder="Category Name">
                    <button class="btn btn-primary" type="submit">Add Category</button>
                </div>
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th class="text-center"><?= __('Id') ?></th>
                            <th class="text-center"><?= __('Category_name') ?></th>
                            <th class="text-center"><?= __('No of Product') ?></th>
                            <th class="text-center"><?= __('Status') ?></th>
                            <th class="text-center"><?= __('Created_date') ?></th>
                            <th class="text-center"><?= __('Modified_date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = 1;

                        foreach ($productCategories as $productCategory) :
                            $i = 0;
                        ?>
                            <tr>
                                <td class="text-center"><?= $id++ ?></td>
                                <td class="text-center"><?= h($productCategory->category_name) ?></td>
                                <?php foreach ($productCategory->products as $product) { ?>
                                    <?php $i++;
                                        } ?> 
                                <td class="text-center"><?= $i ?></td>
                                <td class="text-center abc"><?php if ($productCategory->status == 1) {
                                                            echo $this->Form->postLink(__('Deactivate'), ['controller' => 'Products', 'action' => 'productcstatus', $productCategory->id, $productCategory->status], ['confirm' => __('Are you sure you want to deactivate ?', $productCategory->id), 'class' => 'abc', 'escape' => false, 'title' => 'Deactive']);
                                                        } else {
                                                            echo $this->Form->postLink(__('Activate'), ['controller' => 'Products', 'action' => 'productcstatus', $productCategory->id, $productCategory->status], ['confirm' => __('Are you sure you want to deactivate ?', $productCategory->id), 'class' => 'btn-btn-success', 'escape' => false, 'title' => 'Active']);
                                                        } ?>
                                </td>
                                <td class="text-center"><?= h($productCategory->created_date) ?></td>
                                <td class="text-center"><?= h($productCategory->modified_date) ?></td>
                                <td class="actions">
                                    <?= $this->Html->link(__('View'), ['action' => 'productcategories', $productCategory->id]) ?>
                                    <?= $this->Html->link(__('Edit'), ['controller' => 'ProductCategories', 'action' => 'edit', $productCategory->id]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-md-2"></div>
        </div>
        <div class="paginator">
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
</div>


<?= $this->Html->css('index', ['block' => 'css']); ?>