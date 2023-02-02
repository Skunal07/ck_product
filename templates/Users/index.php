<div class="users index content">
    <h3 class="text_center"><?= __('Users List') ?></h3>
<div class="table-responsive"  style="overflow: hidden;">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
        <table class="styled-table">
            <thead>
                <tr>
                    <th class="text-center"><?= __('Id') ?></th>
                    <th class="text-center"><?= __('Image') ?></th>
                    <th class="text-center"><?= __('Name') ?></th>
                    <th class="text-center"><?= __('Email') ?></th>
                    <th class="text-center"><?= __('Address') ?></th>
                    <th class="text-center"><?= __('Phone No') ?></th>
                    <th class="text-center"><?= __('User_type') ?></th>
                    <th class="text-center"><?= __('Status') ?></th>
                    <th class="text-center"><?= __('Created Date') ?></th>
                    <th class="text-center"><?= __('Modified Date') ?></th>
                    <th class="text-center"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($users as $user) :

                    if ($status->id == $user->id) {
                        continue;
                    } ?>
                    <tr>
                        <td class="text-center"><?= $this->Number->format($i++) ?></td>
                        <td class="text-center"><?= $this->Html->image(h($user->user_profile->profile_image), array('width' => '50px')) ?></td>
                        <td class="text-center"><?= h($user->user_profile->first_name) ?><?= h($user->user_profile->last_name) ?></td>
                        <td class="text-center"><?= h($user->email) ?></td>
                        <td class="text-center"><?= h($user->user_profile->address) ?></td>
                        <td class="text-center"><?= h($user->user_profile->contact) ?></td>
                        <?php if ($user->user_type == 0) { ?>
                            <td class="text-center">User</td>
                        <?php } else { ?>
                            <td class="text-center">Admin</td>
                        <?php } ?>
                        <td class="text-center"><?php if($user->status == 2){
                            echo $this->Form->postLink(__('Deactivate'), ['controller' => 'Users', 'action' => 'userstatus', $user->id,$user->status], ['confirm' => __('Are you sure you want to deactivate ?', $user->id),'class'=>'btn-btn-primary','escape'=>false,'title'=>'Deactive']) ;
                        }else{
                            echo $this->Form->postLink(__('Activate'), ['controller' => 'Users', 'action' => 'userstatus', $user->id,$user->status], ['confirm' => __('Are you sure you want to deactivate ?', $user->id),'class'=>'btn-btn-success','escape'=>false,'title'=>'Active']) ;
                        } ?></td>
                        <td class="text-center"><?= h($user->user_profile->created_date) ?></td>
                        <td class="text-center"><?= h($user->user_profile->modified_date) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['action' => 'userprofile', $user->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
        <div class="col-md-2"></div>
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
</div>
</div>
<?= $this->Html->css('index', ['block' => 'css']); ?>