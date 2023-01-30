<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users view content">
            <h3><?= h($user->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Type') ?></th>
                    <td><?= h($user->user_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= h($user->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($user->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created Date') ?></th>
                    <td><?= h($user->created_date) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified Date') ?></th>
                    <td><?= h($user->modified_date) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Product Comments') ?></h4>
                <?php if (!empty($user->product_comments)) : ?>
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
                        <?php foreach ($user->product_comments as $productComments) : ?>
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
            <div class="related">
                <h4><?= __('Related User Profile') ?></h4>
                <?php if (!empty($user->user_profile)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('User Id') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Contact') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Profile Image') ?></th>
                            <th><?= __('Created Date') ?></th>
                            <th><?= __('Modified Date') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($user->user_profile as $userProfile) : ?>
                        <tr>
                            <td><?= h($userProfile->id) ?></td>
                            <td><?= h($userProfile->user_id) ?></td>
                            <td><?= h($userProfile->first_name) ?></td>
                            <td><?= h($userProfile->last_name) ?></td>
                            <td><?= h($userProfile->contact) ?></td>
                            <td><?= h($userProfile->address) ?></td>
                            <td><?= h($userProfile->profile_image) ?></td>
                            <td><?= h($userProfile->created_date) ?></td>
                            <td><?= h($userProfile->modified_date) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'UserProfile', 'action' => 'view', $userProfile->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'UserProfile', 'action' => 'edit', $userProfile->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'UserProfile', 'action' => 'delete', $userProfile->id], ['confirm' => __('Are you sure you want to delete # {0}?', $userProfile->id)]) ?>
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
