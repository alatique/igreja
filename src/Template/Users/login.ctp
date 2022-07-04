<div>
  <?= $this->Flash->render() ?>
</div>
<?php
  echo $this->Form->create('post', ['class' => 'form-signin']);
    echo $this->Html->image('IPM-logo.png', ['class' => 'mb-4','width' => '90', 'height' => '120']);
?>
    <h1 class="h3 mb-3 fw-normal">Login</h1>

    

    <div class="form-floating">
      <?= $this->Form->control('username', ['class' => 'form-control', 'placeholder' => 'name@example.com', 'label' => false ]); ?>  
    </div>
    
    <div class="form-floating">
      <?= $this->Form->control('password', ['class' => 'form-control', 'placeholder' => 'senha', 'label' => false ]); ?>  
    </div>

    <?= $this->Form->button(__('Entrar'), ['class' => 'w-100 btn btn-lg btn-primary', 'type' => 'submit']) ?>

<?= $this->Form->end() ?>