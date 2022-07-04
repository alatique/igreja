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
             <?= $this->Form->create($user, ['class' => 'form-group text-start', 'label' => false]) ?>
            <fieldset>
                <legend><?= __('cadastro_usuario') ?></legend>

                <div class="row g-3">
                    <div class="col-md-4 col-lg-8">
                        <label class="text-start"><?=__('nome')?></label>
                        <?php echo $this->Form->control('name', ['class' => 'form-control', 'label' => false, 'required' => true, 'pattern' => "^[a-zA-ZáéíóúàèìòùçãõñâêîôûÁÉÍÓÚÀÈÌÒÙÇÃÕÑÂÊÎÔÛ\s]*$"]); ?>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label class="text-start"><?=__('nascimento')?></label>
                        <div class="input date">
                            <input class="form-control" type="date" id="birth" name="birth">
                            <?php  //echo $this->Form->control('birth', ['empty' => true, 'class' => 'form-control', 'label' => false, 'type' => 'date']); ?>
                        </div>
                    </div>

                    <div class="col-md-4 col-lg-8">
                        <label class="text-start"><?=__('endereco')?></label>
                        <?php  echo $this->Form->control('address', ['class' => 'form-control', 'label' => false]); ?>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label class="text-start"><?=__('bairro')?></label>
                        <?php  echo $this->Form->control('district', ['class' => 'form-control', 'label' => false, 'pattern' => "^[a-zA-ZáéíóúàèìòùçãõñâêîôûÁÉÍÓÚÀÈÌÒÙÇÃÕÑÂÊÎÔÛ\s]*$"]); ?>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label class="text-start"><?=__('cidade')?></label>
                        <?php  echo $this->Form->control('city', ['class' => 'form-control', 'label' => false, 'pattern' => "^[a-zA-ZáéíóúàèìòùçãõñâêîôûÁÉÍÓÚÀÈÌÒÙÇÃÕÑÂÊÎÔÛ\s]*$"]); ?>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label class="text-start"><?=__('cep')?></label>
                        <?php  echo $this->Form->control('zip', ['class' => 'form-control', 'label' => false]); ?>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label class="text-start"><?=__('estado')?></label>
                        <?php  echo $this->Form->control('state', ['class' => 'form-control', 'label' => false,
                                                                    'options' => $this->Lista->estados()]); ?>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('pais')?></label>
                        <?php  echo $this->Form->control('country', ['class' => 'form-control', 'label' => false, 'pattern' => "^[a-zA-ZáéíóúàèìòùçãõñâêîôûÁÉÍÓÚÀÈÌÒÙÇÃÕÑÂÊÎÔÛ\s]*$"]); ?>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('telefone')?></label>
                        <?php  echo $this->Form->control('tel', ['class' => 'form-control', 'label' => false]); ?>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('celular')?></label>
                        <?php  echo $this->Form->control('cel', ['class' => 'form-control', 'label' => false]); ?>
                    </div>

                    <!-- <div class="col-md-4 col-lg-4">
                        <label class="text-start"><?=__('email')?></label>
                        <?php //  echo $this->Form->control('email', ['class' => 'form-control', 'label' => false]); ?>
                    </div> -->

                    <div class="col-md-1 col-lg-1">
                        <label class="text-start"><?=__('tipo')?></label>
                        <?php  echo $this->Form->control('type', ['class' => 'form-control', 'label' => false, 'options'=> $this->Lista->tiposMembros()]); ?>
                    </div>

                    <div class="col-md-1 col-lg-1">
                        <label class="text-start"><?=__('ativo')?></label>
                        <?php  echo $this->Form->control('sta_ativo', ['class' => 'form-control', 'label' => false, 'options' => ['1' => __('sim'), '0' => __('nao')]]); ?>
                    </div>

                    <div class="col-md-1 col-lg-1">
                        <label class="text-start"><?=__('membro')?></label>
                        <?php  echo $this->Form->control('membro_arrolado', ['class' => 'form-control', 'label' => false, 'options' => ['1' => __('sim'), '0' => __('nao')]]); ?>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label class="text-start"><?=__('igreja')?></label>
                        <?php  echo $this->Form->control('id_igreja', ['class' => 'form-control', 'label' => false, 'options' => $igrejas]); ?>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label class="text-start"><?=__('usuario')?></label>
                        <?php  echo $this->Form->control('username', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
                    </div>

                    <div class="col-md-4 col-lg-4">
                        <label class="text-start"><?=__('senha')?></label>
                        <?php  echo $this->Form->control('password', ['class' => 'form-control', 'label' => false, 'required' => true]); ?>
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

<?= $this->Html->script('/js/controllers/mascara.js') ?>