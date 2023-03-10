<div class="container emp-profile">
    <div class="row">
        <div class="col-md-4">
            <div class="profile-img">
                <?= $this->Html->image(h($user->user_profile->profile_image), array('width' => '200px')) ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-head">
                <h3>
                    <?= h($user->user_profile->first_name) ?>
                    <?= h($user->user_profile->last_name) ?>
                </h3>
                <h4 class="text-primary">
                    <i><?= h($user->email) ?></i>
                </h4>
                <!-- <h6 class="proile-rating">Total No Of Posts: <span>
                    </span></h6> -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <span class="nav-link active" id="About" data-toggle="tab" role="tab" aria-controls="home" aria-selected="true">About</span>
                    </li>
                    <li class="nav-item">
                        <span class="nav-link " id="Posts" data-toggle="tab" role="tab">Posts</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-2">
             <?= $this->Html->link(__('Edit Profile'), ['action' => 'edit', $user->id], ['class' => 'nav-link profile-edit-btn mb-4']); ?>
             <?php if($status->user->user_type == 1){ ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'nav-link profile-edit-btn']) ?>
            <?php }?>
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
            <div class="tab-content profile-tab" id="about_user">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>User Id</label>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <?= $this->Number->format($user->id) ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Name</label>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <?= h($user->user_profile->first_name) ?>
                                <?= h($user->user_profile->last_name) ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Phone</label>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <?= h($user->user_profile->contact) ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <?= h($user->email) ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Address</label>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <?= h($user->user_profile->address) ?>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Created Date</label>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <?= h($user->user_profile->created_date->format('Y-m-d H:i:s')) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->Html->css('userprofile', ['block' => 'css']); ?>
<?= $this->Html->script('userprofile', ['block' => 'script']); ?>
