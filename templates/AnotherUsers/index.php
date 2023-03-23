<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\AnotherUser> $anotherUsers
 */
?>
<div class="anotherUsers index content">
    <?= $this->Html->link(__('New Another User'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Another Users') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('is_superuser') ?></th>
                    <th><?= $this->Paginator->sort('username') ?></th>
                    <th><?= $this->Paginator->sort('role') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($anotherUsers as $anotherUser): ?>
                <tr>
                    <td><?= $this->Number->format($anotherUser->id) ?></td>
                    <td><?= h($anotherUser->is_superuser) ?></td>
                    <td><?= h($anotherUser->username) ?></td>
                    <td><?= h($anotherUser->role) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $anotherUser->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $anotherUser->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $anotherUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $anotherUser->id)]) ?>
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
