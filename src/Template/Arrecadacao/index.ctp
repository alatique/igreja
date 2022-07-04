<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<main>
    <?= $this->element('menu') ?>
    <div class="bg-light">
    <div class="container users index large-9 medium-8 columns content">
        <h3><?= __('Arrecadacao') ?></h3>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" class="actions"></th>
                    <th scope="col"><?= $this->Paginator->sort('dt_cadastro', __('arrecadado em')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('total_dizimo', __('total dizimos')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('total_oferta', __('total ofertas')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('total_arrecadado', __('total arrecadado')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('sta_edicao', __('status')) ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($arrecadacao as $arrecadacao): ?>
                    <?php 
                        $icon = "pencil.svg";
                        if ($arrecadacao->sta_edicao == 'N') {
                            $icon = "eye.svg";
                        }
                    ?>
                <tr>
                    <td class="actions">
                        <a href="<?=BASE_URL."/arrecadacao/open-arrecadacao/".$arrecadacao->id?>">
                            <img src="<?=BASE_URL."/font/bootstrap-icons-1.8.1/".$icon?>" alt="pencil" width="15" height="15" class="add-dizimo">    
                        </a>
                    </td>
                    <td><?= h($arrecadacao->dt_cadastro->format('d/m/Y')) ?></td>
                    <td><?= "R$ ".$this->Number->format($arrecadacao->total_dizimo) ?></td>
                    <td><?= "R$ ".$this->Number->format($arrecadacao->total_oferta) ?></td>
                    <td><?= "R$ ".$this->Number->format($arrecadacao->total_arrecadado) ?></td>
                    <td><?= ($arrecadacao->sta_edicao == 'N') ? __('finalizado') : __('em_andamento') ?></td>
                </tr>
                <?php endforeach; ?>

                
            </tbody>
        </table>

        <?= $this->element('pagination'); ?>
    </div>
    </div>
</main>


