<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dizimo $dizimo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dizimo->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dizimo->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dizimo'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dizimo form large-9 medium-8 columns content">
    <?= $this->Form->create($dizimo) ?>
    <fieldset>
        <legend><?= __('Edit Dizimo') ?></legend>
        <?php
            echo $this->Form->control('vl_dizimo');
            echo $this->Form->control('vl_oferta');
            echo $this->Form->control('user_id');
            echo $this->Form->control('dt_dizimo', ['empty' => true]);
            echo $this->Form->control('arrecadacao_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
