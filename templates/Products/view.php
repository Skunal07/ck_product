<section class="section">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-6" data-aos="fade-up">
                <h2><?= h($product->product_title) ?></h2>
                <p><?= h($product->product_description) ?></p>
            </div>
            <?php
            if ($status->user->user_type == 1) {
                echo  $this->Html->link(__('Back to List'), ['action' => 'index'], ['class' => 'readmore','style'=>'margin-left:300px;']);
            };
            ?>
        </div>
    </div>

    <div class="site-section pb-0">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-md-8" data-aos="fade-up">
                    <!-- <img src="/img/img_1_big.jpg" alt="Image" class="img-fluid"> -->
                    <?= $this->Html->image(h($product->product_image), array('class' => 'img-fluid')) ?>
                </div>
                <div class="col-md-3 ml-auto" data-aos="fade-up" data-aos-delay="100">
                    <div class="sticky-content">
                        <h3 class="h3"><?= h($product->product_category->category_name) ?></h3>
                        <p class="mb-4"><span class="text-muted">Design</span></p>

                        <div class="mb-5">
                            <p><?= h($product->product_description) ?></p>
                        </div>
                        <?= $this->Html->link(__('Visit Website'), ['action' => 'productcategories'], ['class' => 'readmore']) ?>
                    </div>
                </div>
            </div>
        </div>
</section>

<!-- ======= Testimonials Section ======= -->
<section class="section pt-0">
    <h3>Comments</h3>
    <hr>
    <?php if ($status->user->user_type == 0) { ?>
        <?= $this->Form->create($comment) ?>
        <div class="d-flex flex-row add-comment-section mt-4 mb-4">

            <input type="text" name="comments" id="comments" class="form-control mr-3" placeholder="Add comment">
            <button class="btn btn-primary" type="submit">Comment</button>
        </div>
    <?php } ?>
    <?php
    // echo $this->Form->control('comments', array('label' => false, 'type' => 'text'));
    ?>
    <!-- <button type="submit" class="fa-solid fa-arrow-right"></button> -->
    <?= $this->Form->end() ?>

    <div class="comments">
        <?php foreach ($comments as $comment) : ?>
            <div class="d-flex flex-row mb-2">
                <?= $this->Html->image($comment->user->user_profile->profile_image, array('class' => 'd-block ui-w-40 rounded-circle', 'width' => '60px')); ?>
                <div class="d-flex flex-column ml-2">
                    <span class="name"><?= h($comment->user->user_profile->first_name) ?></span>
                    <h5 class="text-bold"><?= h($comment->comments) ?></h5>
                </div>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ProductComments', 'action' => 'delete', $comment->id, $product->id], ['confirm' => __('Are you sure you want to delete?'), 'style' => "margin-left: auto;"]) ?>
            </div>
        <?php endforeach; ?>
    </div>
</section><!-- End Testimonials Section -->
<?= $this->Html->css('productc', ['block' => 'css'])    ?>
<?= $this->Html->css('viewp', ['block' => 'css'])    ?>