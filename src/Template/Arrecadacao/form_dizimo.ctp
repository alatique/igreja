<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>

<div class="bg-light">
    <div class="container users index large-9 medium-8 columns content">
        <h3><?= __('Dizimos') ?></h3>
        <?php $total = 0; $total_dizimos = 0; $total_ofertas = 0;?>
        <table cellpadding="0" cellspacing="0" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"><?= __('membro') ?></th>
                    <th scope="col"><?= __('R$ dizimo') ?></th>
                    <th scope="col"><?= __('R$ oferta') ?></th>
                    <th scope="col" class="actions"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dizimo as $dizimo): ?>
                <tr>
                	<td><?= h($usuarios[$dizimo->user_id]) ?></td>
                    <td><?= h($dizimo->vl_dizimo) ?></td>
                    <td><?= h($dizimo->vl_oferta) ?></td>
                    <td>
                        <?php if ($sta_edicao != 'N') { ?>
                            <a href="#" class="btn-delete-dizimo" id="<?= $dizimo->id?>">
                                <img src="<?= BASE_URL."/font/bootstrap-icons-1.8.1/trash.svg"?>">
                            </a>
                        <?php } ?>
                    </td>
                </tr>

                <?php
                    $total_dizimos += $dizimo->vl_dizimo;
                    $total_ofertas += $dizimo->vl_oferta;
                    $total += ($dizimo->vl_dizimo + $dizimo->vl_oferta);
                ?>
                <?php endforeach; ?>

                
            </tbody>
        </table>

        <div class="d-grid gap-4 d-md-flex justify-content-md-end">
            <label id="total-arrecadacao" style="color: gray; font-size: 22px;" data-id="<?= $total?>"><?= "TOTAL: R$" . $total?></label>
            <input id="total-dizimos" type="hidden" value="<?= $total_dizimos?>">
            <input id="total-ofertas" type="hidden" value="<?= $total_ofertas?>">
        </div>

        <?php //echo $this->element('pagination'); ?>
    </div>
</div>



                    

                    