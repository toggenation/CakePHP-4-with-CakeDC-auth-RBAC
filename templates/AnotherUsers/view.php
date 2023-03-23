<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AnotherUser $anotherUser
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Another User'), ['action' => 'edit', $anotherUser->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Another User'), ['action' => 'delete', $anotherUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $anotherUser->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Another Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Another User'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="anotherUsers view content">
            <h3><?= h($anotherUser->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Username') ?></th>
                    <td><?= h($anotherUser->username) ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= h($anotherUser->role) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($anotherUser->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Superuser') ?></th>
                    <td><?= $anotherUser->is_superuser ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Posts') ?></h4>
                <?php if (!empty($anotherUser->posts)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Body') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Another User Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($anotherUser->posts as $posts) : ?>
                        <tr>
                            <td><?= h($posts->id) ?></td>
                            <td><?= h($posts->body) ?></td>
                            <td><?= h($posts->title) ?></td>
                            <td><?= h($posts->another_user_id) ?></td>
                            <td><?= h($posts->created) ?></td>
                            <td><?= h($posts->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Posts', 'action' => 'view', $posts->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Posts', 'action' => 'edit', $posts->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Posts', 'action' => 'delete', $posts->id], ['confirm' => __('Are you sure you want to delete # {0}?', $posts->id)]) ?>
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
