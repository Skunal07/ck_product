<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Product'), ['action' => 'edit', $product->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Product'), ['action' => 'delete', $product->id], ['confirm' => __('Are you sure you want to delete # {0}?', $product->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Products'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Product'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="products view content">
            <h3><?= h($product->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Product Title') ?></th>
                    <td><?= h($product->product_title) ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Category') ?></th>
                    <td><?= $product->has('product_category') ? $this->Html->link($product->product_category->id, ['controller' => 'ProductCategories', 'action' => 'view', $product->product_category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Product Image') ?></th>
                    <td><?= h($product->product_image) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($product->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($product->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($product->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($product->modified_date) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Product Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($product->product_description)); ?>
                </blockquote>
            </div>
            <div class="text">
                <strong><?= __('Product Tags') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($product->product_tags)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Product Comments') ?></h4>
                <?php if (!empty($product->product_comments)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('Comments') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th><?= __('Modified Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($product->product_comments as $productComments) : ?>
                        <tr>
                            <td><?= h($productComments->id) ?></td>
                            <td><?= h($productComments->product_id) ?></td>
                            <td><?= h($productComments->user_id) ?></td>
                            <td><?= h($productComments->comments) ?></td>
                            <td><?= h($productComments->created_date) ?></td>
                            <td><?= h($productComments->modified_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ProductComments', 'action' => 'view', $productComments->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ProductComments', 'action' => 'edit', $productComments->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProductComments', 'action' => 'delete', $productComments->id], ['confirm' => __('Are you sure you want to delete # {0}?', $productComments->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
