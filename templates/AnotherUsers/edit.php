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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $anotherUser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $anotherUser->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Another Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="anotherUsers form content">
            <?= $this->Form->create($anotherUser) ?>
            <fieldset>
                <legend><?= __('Edit Another User') ?></legend>
                <?php
                    echo $this->Form->control('is_superuser');
                    echo $this->Form->control('username');
                    echo $this->Form->control('password');
                    echo $this->Form->control('role');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
