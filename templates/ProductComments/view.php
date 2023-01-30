<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductComment $productComment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Product Comment'), ['action' => 'edit', $productComment->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product Comment'), ['action' => 'delete', $productComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productComment->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Product Comments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product Comment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productComments view content">
            <h3><?= h($productComment->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product') ?></th>
                    <td><?= $productComment->has('product') ? $this->Html->link($productComment->product->id, ['controller' => 'Products', 'action' => 'view', $productComment->product->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $productComment->has('user') ? $this->Html->link($productComment->user->id, ['controller' => 'Users', 'action' => 'view', $productComment->user->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Comments') ?></th>
                    <td><?= h($productComment->comments) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($productComment->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($productComment->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($productComment->modified_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
