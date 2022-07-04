<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Arrecadacao $arrecadacao
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $arrecadacao->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $arrecadacao->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Arrecadacao'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Dizimo'), ['controller' => 'Dizimo', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dizimo'), ['controller' => 'Dizimo', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="arrecadacao form large-9 medium-8 columns content">
    <?= $this->Form->create($arrecadacao) ?>
    <fieldset>
        <legend><?= __('Edit Arrecadacao') ?></legend>
        <?php
            echo $this->Form->control('dt_cadastro', ['empty' => true]);
            echo $this->Form->control('total_dizimo');
            echo $this->Form->control('total_oferta');
            echo $this->Form->control('total_arrecadado');
            echo $this->Form->control('id_igreja');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
