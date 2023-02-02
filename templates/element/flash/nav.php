<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <?= $this->Html->link(__('Product'), ['controller' => 'products', 'action' => 'productcategories'], ['class' => 'navbar-brand']) ?>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <?= $this->Html->link(__('Home'), ['controller' => 'products', 'action' => 'productcategories'], ['class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
          <?= $this->Html->link(__('Services'), ['controller' => 'users', 'action' => 'services'], ['class' => 'nav-link']) ?>
        </li>

      </ul>
      <ul>
        <?= $this->Form->create(null, ['type' => 'get']) ?>
        <?= $this->Form->control('key', ['label' => false, 'value' => $this->request->getQuery('key'), 'style' => "
    width: 500px;
    margin-top: 18px;
    border-radius:10px;
    height:35px
"]) ?>
        <input type='submit' value="Submit" style="display: none;" />
        <?= $this->Form->end() ?>
      </ul>
      <?php
      if ($status->user->user_type == 1) {
      ?>
        <ul class="navbar-nav me-auto ">
          <li class="nav-item">
            <?= $this->Html->link(__('Users'), ['controller' => 'users', 'action' => 'index'], ['class' => 'nav-link']) ?>
          </li>
          <li class="nav-item">
            <?= $this->Html->link(__('Product'), ['controller' => 'Products', 'action' => 'index'], ['class' => 'nav-link']) ?>
          </li>
          <li class="nav-item">
            <?= $this->Html->link(__('Product_Categories'), ['controller' => 'products', 'action' => 'indexproductc'], ['class' => 'nav-link']) ?>
          </li>
        </ul>
      <?php } ?>
      <ul class="navbar-nav me-auto " style="margin-left: auto;">
        <div class="btn-group">
          <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $status->first_name ?> <?= $status->last_name ?>
            <?= $this->Html->image(h($status->profile_image), array('width' => '50px', 'style' => 'border-radius: 50%;width: 50px;}')) ?>
          </button>
          <div class="dropdown-menu" style="background-color: #dddbdb;">
            <span style="padding: 10px;"><?= $status->user->email ?></span><br>
            <?php if ($status->user->user_type == 1) {
              echo '<span style="margin-left: 80px;"><small>(Admin)</small></span>';
            } else {
              echo '<span style="margin-left: 80px;"><small>User</small></span>';
            }
            ?>
            <?= $this->Html->link(__("About"), ['controller' => 'users', 'action' => 'userprofile', $status->user->id], ['class' => 'dropdown-item text-center']) ?>
            <div class="dropdown-divider"></div>
            <?= $this->Html->link(__('Logout'), ['controller' => 'users', 'action' => 'logout',], ['class' => "dropdown-item text-center"]) ?>
          </div>
        </div>
      </ul>
    </div>
  </div>
</nav>