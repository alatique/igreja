<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dizimo $dizimo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Dizimo'), ['action' => 'edit', $dizimo->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dizimo'), ['action' => 'delete', $dizimo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dizimo->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dizimo'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dizimo'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dizimo view large-9 medium-8 columns content">
    <h3><?= h($dizimo->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($dizimo->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vl Dizimo') ?></th>
            <td><?= $this->Number->format($dizimo->vl_dizimo) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Vl Oferta') ?></th>
            <td><?= $this->Number->format($dizimo->vl_oferta) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('User Id') ?></th>
            <td><?= $this->Number->format($dizimo->user_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Arrecadacao Id') ?></th>
            <td><?= $this->Number->format($dizimo->arrecadacao_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Dt Dizimo') ?></th>
            <td><?= h($dizimo->dt_dizimo) ?></td>
        </tr>
    </table>
</div>
