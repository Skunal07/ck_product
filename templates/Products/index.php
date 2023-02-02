<?php

/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Product> $products
 */
?>
<div class="products index content">
    <?= $this->Html->link(__('Add New Product '), ['action' => 'add'], ['class' => 'btn btn-dark float-right']) ?>
    <h3><?= __('Products') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_title') ?></th>
                    <th><?= $this->Paginator->sort('product_category_id') ?></th>
                    <th><?= $this->Paginator->sort('product_image') ?></th>
                    <th><?= $this->Paginator->sort('status') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $this->Number->format($product->id) ?></td>
                        <td><?= h($product->product_title) ?></td>
                        <td><?= $product->has('product_category') ? $this->Html->link($product->product_category->id, ['controller' => 'ProductCategories', 'action' => 'view', $product->product_category->id]) : '' ?></td>
                        <td><?= h($product->product_image) ?></td>
                        <td class="text-center"><?php if ($product->status == 1) {
                                echo $this->Form->postLink(__('Deactivate'), ['controller' => 'Products', 'action' => 'productstatus', $product->id, $product->status], ['confirm' => __('Are you sure you want to deactivate ?', $product->id), 'class' => 'btn-btn-primary', 'escape' => false, 'title' => 'Deactive']);
                            } else {
                                echo $this->Form->postLink(__('Activate'), ['controller' => 'Products', 'action' => 'productstatus', $product->id, $product->status], ['confirm' => __('Are you sure you want to deactivate ?', $product->id), 'class' => 'btn-btn-success', 'escape' => false, 'title' => 'Active']);
                            } ?>
                        </td>
                        <td><?= h($product->created_date) ?></td>
                        <td><?= h($product->modified_date) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'view', $product->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $product->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>