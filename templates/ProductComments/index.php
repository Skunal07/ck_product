<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ProductComment> $productComments
 */
?>
<div class="productComments index content">
    <?= $this->Html->link(__('New Product Comment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Product Comments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('product_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('comments') ?></th>
                    <th><?= $this->Paginator->sort('created_date') ?></th>
                    <th><?= $this->Paginator->sort('modified_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productComments as $productComment): ?>
                <tr>
                    <td><?= $this->Number->format($productComment->id) ?></td>
                    <td><?= $productComment->has('product') ? $this->Html->link($productComment->product->id, ['controller' => 'Products', 'action' => 'view', $productComment->product->id]) : '' ?></td>
                    <td><?= $productComment->has('user') ? $this->Html->link($productComment->user->id, ['controller' => 'Users', 'action' => 'view', $productComment->user->id]) : '' ?></td>
                    <td><?= h($productComment->comments) ?></td>
                    <td><?= h($productComment->created_date) ?></td>
                    <td><?= h($productComment->modified_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $productComment->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $productComment->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $productComment->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productComment->id)]) ?>
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
