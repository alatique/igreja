<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<main>
    <?= $this->element('menu') ?>
    <div class="bg-light">
    <div class="container users index large-9 medium-6 columns content">
        <br/>
        <h3><?= __('Membros') ?></h3>
        <br/>
        <div class="row g-3">
            <div class="col-md-8 col-lg-8">
            </div>
            <div class="col-md-3 col-lg-3">
                <input class="form-control" type="text" id="filtro-membros" name="filtro-membros" placeholder="busca por nome...">
            </div>
            <div class="col-md-1 col-lg-1">
                <button class="btn btn-primary" id="btn-filtro-membros" style="margin-top:0"><?=__('filtrar')?></button>
            </div>
        </div>

        <br/>

        <table cellpadding="0" cellspacing="0" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col" class="actions"></th>
                    <th scope="col"><?= $this->Paginator->sort('name', __('nome')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('birth', __('nascimento')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('cel', __('celular')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('email', __('email')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('city', __('cidade')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('sta_ativo', __('usuario ativo')) ?></th>
                    <th scope="col"><?= $this->Paginator->sort('membro_arrolado', __('membro')) ?></th>
                    <!-- <th scope="col" class="actions"></th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td class="actions">
                        <a href="<?=BASE_URL."/users/edit/".$user->id?>">
                            <img src="<?=BASE_URL."/font/bootstrap-icons-1.8.1/pencil.svg"?>" alt="pencil" width="15" height="15">    
                        </a>
                    </td>
                    <td><?= h($user->name) ?></td>
                    <td><?= (h($user->birth) != '') ? $user->birth->format('d/m/Y') : '' ?></td>
                    <td><?= $this->Format->numero($user->cel, true) ?></td>
                    <td><?= h($user->email) ?></td>
                    <td><?= h($user->city) ?></td>
                    <td><?= (h($user->sta_ativo) == 1) ? 'Sim' : 'Não' ?></td>
                    <td><?= (h($user->membro_arrolado) == 1) ? 'Sim' : 'Não' ?></td>
                    <!-- <td class="actions">
                        <?php 
                        //echo $this->Form->postLink($this->Html->image(BASE_URL."/font/bootstrap-icons-1.8.1/trash.svg"), ['action' => 'delete', $user->id], ['escape' => false, 'confirm' => __('Are you sure you want to delete # {0}?', $user->name)]); ?>
                    </td> -->
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?= $this->element('pagination'); ?>
    </div>
    </div>
</main>

<?= $this->Html->script('/js/controllers/users/index.js') ?>