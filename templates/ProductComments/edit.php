<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ProductComment $productComment
 * @var string[]|\Cake\Collection\CollectionInterface $products
 * @var string[]|\Cake\Collection\CollectionInterface $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $productComment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $productComment->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Product Comments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="productComments form content">
            <?= $this->Form->create($productComment) ?>
            <fieldset>
                <legend><?= __('Edit Product Comment') ?></legend>
                <?php
                    echo $this->Form->control('product_id', ['options' => $products]);
                    echo $this->Form->control('user_id', ['options' => $users]);
                    echo $this->Form->control('comments');
                    echo $this->Form->control('created_date');
                    echo $this->Form->control('modified_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
