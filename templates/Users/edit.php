<!-- <?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($user) ?>
            <fieldset>
                <legend><?= __('Edit User') ?></legend>
                
                    <?= $this->Form->control('email');?>
                    <?= $this->Form->control('password');?>
                    <?= $this->Form->control('user_type');?>
                    <?= $this->Form->control('status');?>
                    <?= $this->Form->control('created_date');?>
                    <?= $this->Form->control('modified_date');?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div> -->
<?= $this->Form->create($user, ['enctype' => 'multipart/form-data']) ?>
<div class="container emp-profile">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
            <?= $this->Html->image(h($user->user_profile['profile_image']), array('width' => '200px')) ?>
                <div class="file btn btn-lg btn-primary">
                    Change Photo
                    <input type="file" name="user_profile[profile_image]" />
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h3>
                    <?= h($user->username) ?>
                </h3>
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <span class="nav-link active" id="Postas" data-toggle="tab" role="tab">Edit</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
            <?= $this->Html->link(__('Cancel'), ['action' => 'userprofile', $user->id], ['class' => 'nav-link profile-edit-btn']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="profile-work">
                <p>WORK LINK</p>
                <span>Website Link</span><br />
                <span>Bootsnipp Profile</span><br />
                <span>Bootply Profile</span>
                <p>SKILLS</p>
                <span>PHP</span><br />
                <span>Web Designer</span><br />
                <span>Web Developer</span><br />
                <span>WordPress</span><br />
            </div>
        </div>
        <div class="col-md-8">
            <div class="tab-content profile-tab" id="abosut_user">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
   
                    <div class="row">
                        <div class="col-md-4">
                            <label class='labelname ' >First Name :-  </label>
                        </div>
                        <div class="col-md-8">
                            <?= $this->Form->control('user_profile.first_name',['label' => false]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class='labelname ' >Last Name :-  </label>
                        </div>
                        <div class="col-md-8">
                            <?= $this->Form->control('user_profile.last_name',['label' => false]); ?>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class='labelname ' >Email :-  </label>
                        </div>
                        <div class="col-md-8">
                            <?= $this->Form->control('email',['label' => false]); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class='labelname ' >Phone No:-  </label>
                        </div>
                        <div class="col-md-8">
                            <?= $this->Form->control('user_profile.contact', ['required' => false, 'label' => false, 'type' => 'text', 'placeholder' => 'Phone-Number']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class='labelname ' >Address :-</label>
                        </div>
                        <div class="col-md-8">
                            <?= $this->Form->control('user_profile.address',['label' => false]); ?>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
<?= $this->Html->css('userprofile', ['block' => 'css']); ?>
<?= $this->Html->css('edit', ['block' => 'css']); ?>
