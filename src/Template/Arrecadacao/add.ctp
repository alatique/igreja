<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>


<main>
    <?= $this->element('menu') ?>
    <div class="bg-light">
        <div class="container users index large-9 medium-8 columns content">
            <?= $this->Form->create($arrecadacao, ['class' => 'form-group text-start', 'label' => false]) ?>
            <fieldset>
                <legend><?= __('nova_arrecadacao') ?></legend>

                <div class="row g-3">

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('igreja')?></label>
                        <?php  echo $this->Form->control('id_igreja', ['class' => 'form-control', 'label' => false, 'options' => $igrejas]); ?>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('responsavel 1')?></label>
                        <?php  echo $this->Form->control('diacono1_id', ['class' => 'form-control', 'label' => false, 'options' => $diaconos]); ?>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('responsavel 2')?></label>
                        <?php  echo $this->Form->control('diacono2_id', ['class' => 'form-control', 'label' => false, 'options' => $diaconos]); ?>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('data')?></label>
                        <?php  echo $this->Form->control('dt_cadastro', ['empty' => true, 'class' => 'form-control', 'label' => false, 'type' => 'text', 'default' => date('Y-m-d')]); ?>
                    </div>              

                </div>
            </fieldset>
            <br/>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <?= $this->Form->button(__('confirmar'), ['class' => 'btn btn-success btn-lg', 'type' => 'submit']) ?>
            </div>
            <br/>
            <?= $this->Form->end() ?>
        </div>
    </div>
</main>
