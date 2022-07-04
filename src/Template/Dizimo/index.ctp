<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Dizimo[]|\Cake\Collection\CollectionInterface $dizimo
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Dizimo'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dizimo index large-9 medium-8 columns content">
    <h3><?= __('Dizimo') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vl_dizimo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('vl_oferta') ?></th>
                <th scope="col"><?= $this->Paginator->sort('user_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dt_dizimo') ?></th>
                <th scope="col"><?= $this->Paginator->sort('arrecadacao_id') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dizimo as $dizimo): ?>
            <tr>
                <td><?= $this->Number->format($dizimo->id) ?></td>
                <td><?= $this->Number->format($dizimo->vl_dizimo) ?></td>
                <td><?= $this->Number->format($dizimo->vl_oferta) ?></td>
                <td><?= $this->Number->format($dizimo->user_id) ?></td>
                <td><?= h($dizimo->dt_dizimo) ?></td>
                <td><?= $this->Number->format($dizimo->arrecadacao_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $dizimo->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $dizimo->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $dizimo->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dizimo->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
