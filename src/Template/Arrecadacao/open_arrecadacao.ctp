<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>


<main>
    <?= $this->element('menu') ?>
    <div class="bg-light">
        <div class="container users index large-9 medium-8 columns content text-start">
            
            <fieldset>
                <legend><?= __('nova_arrecadacao') ?></legend>
                
                <div class="row g-3">
                    <input id="arrecadacao_id" value="<?= $arrecadacao->id?>" type="hidden">
                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('igreja')?></label>
                        <input class ="form-control" value="<?= $igrejas[$arrecadacao->id_igreja] ?>" disabled>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('responsavel 1')?></label>
                        <input class ="form-control" value="<?= $diaconos[$arrecadacao->diacono1_id] ?>" disabled>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('responsavel 2')?></label>
                        <input class ="form-control" value="<?= $diaconos[$arrecadacao->diacono2_id] ?>" disabled>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('data')?></label>
                        <input class ="form-control" value="<?= date_format($arrecadacao->dt_cadastro, 'Y-m-d') ?>" disabled>
                    </div>              

                </div>
            </fieldset>
            <br/>
            <br/>
            <br/>
            <hr>
            <br/>

        </div>



        <div class="container users index large-9 medium-8 columns content">
            <?= $this->Form->create($dizimo, ['class' => 'form-group text-start', 'label' => false]) ?>
            <fieldset>
                <legend><?= __('novo_dizimo') ?></legend>
                
                <div class="row g-3">
                    
                    <div class="col-md-6 col-lg-6">
                        <label class="text-start"><?=__('membro')?></label>
                        <?php  echo $this->Form->control('user_id', ['class' => 'form-control', 'label' => false, 'options' => $usuarios, 'disabled' => $disable]); ?>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('dizimo')?></label>
                        <?php  echo $this->Form->control('vl_dizimo', ['empty' => true, 'class' => 'form-control', 'label' => false, 'type' => 'text', 'disabled' => $disable]); ?>
                    </div>

                    <div class="col-md-3 col-lg-3">
                        <label class="text-start"><?=__('oferta')?></label>
                        <?php  echo $this->Form->control('vl_oferta', ['empty' => true, 'class' => 'form-control', 'label' => false, 'type' => 'text', 'disabled' => $disable]); ?>
                    </div>

                    <input name="dt_dizimo" value="<?= date('Y-m-d')?>" type="hidden">
                  
                    <input name="arrecadacao_id" value="<?= $arrecadacao->id?>" type="hidden">
                    

                </div>
            </fieldset>
            <br/>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <?php if ($disable != true) { ?>
                    <span class="btn btn-success btn-lg btn-salva-dizimo"><?=__('salvar')?></span>
                    <?php //echo $this->Form->button(__('confirmar'), ['class' => 'btn btn-success btn-lg', 'type' => 'submit']) ?>
                <?php }?>
            </div>
            
            <br/>
            <?= $this->Form->end() ?>
        </div>

        
        <div class="container users index large-9 medium-8 columns content">
            <div id="form-dizimo"></div>
        </div>
        <div class="container users index large-9 medium-8 columns content">
            <br/><br/><br/>

            <!-- <div class="d-grid gap-4 d-md-flex justify-content-md-start" style="float: left">
                <span class="btn btn-danger btn-lg btn-salva-arrecadacao"><?=__('cancelar_arrecadacao')?></span>
            </div> -->

            
            <div class="d-grid gap-4 d-md-flex justify-content-md-end">
                <?php if ($disable != true) { ?>
                    <span class="btn btn-success btn-lg btn-salva-arrecadacao"><?=__('fechar_arrecadacao')?></span>
                <?php } ?>
            </div>
            
            <br/><br/><br/><br/>
        </div>
        
    </div>

</main>



<?= $this->Html->script('/js/controllers/arrecadacao/open_arrecadacao.js') ?>

