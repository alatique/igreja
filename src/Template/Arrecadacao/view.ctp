<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Arrecadacao $arrecadacao
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Arrecadacao'), ['action' => 'edit', $arrecadacao->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Arrecadacao'), ['action' => 'delete', $arrecadacao->id], ['confirm' => __('Are you sure you want to delete # {0}?', $arrecadacao->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Arrecadacao'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Arrecadacao'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dizimo'), ['controller' => 'Dizimo', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dizimo'), ['controller' => 'Dizimo', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="arrecadacao view large-9 medium-8 columns content">
    <h3><?= h($arrecadacao->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($arrecadacao->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Dizimo') ?></th>
            <td><?= $this->Number->format($arrecadacao->total_dizimo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Oferta') ?></th>
            <td><?= $this->Number->format($arrecadacao->total_oferta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Total Arrecadado') ?></th>
            <td><?= $this->Number->format($arrecadacao->total_arrecadado) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id Igreja') ?></th>
            <td><?= $this->Number->format($arrecadacao->id_igreja) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt Cadastro') ?></th>
            <td><?= h($arrecadacao->dt_cadastro) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Dizimo') ?></h4>
        <?php if (!empty($arrecadacao->dizimo)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th scope="col"><?= __('Id') ?></th>
                <th scope="col"><?= __('Vl Dizimo') ?></th>
                <th scope="col"><?= __('Vl Oferta') ?></th>
                <th scope="col"><?= __('User Id') ?></th>
                <th scope="col"><?= __('Dt Dizimo') ?></th>
                <th scope="col"><?= __('Arrecadacao Id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($arrecadacao->dizimo as $dizimo): ?>
            <tr>
                <td><?= h($dizimo->id) ?></td>
                <td><?= h($dizimo->vl_dizimo) ?></td>
                <td><?= h($dizimo->vl_oferta) ?></td>
                <td><?= h($dizimo->user_id) ?></td>
                <td><?= h($dizimo->dt_dizimo) ?></td>
                <td><?= h($dizimo->arrecadacao_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Dizimo', 'action' => 'view', $dizimo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Dizimo', 'action' => 'edit', $dizimo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Dizimo', 'action' => 'delete', $dizimo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dizimo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
