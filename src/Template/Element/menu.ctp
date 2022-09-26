<nav class="navbar navbar-expand-md navbar-dark" aria-label="Fourth navbar example" style="background-color: #138DB2">
  <div class="container-fluid">
  	<?= $this->Html->getCrumbs(' > ', [
		    'text' => $this->Html->image('IPM-azul.jpg', ['width' => '80', 'height' => '80']),
		    'url' => ['controller' => 'welcome', 'action' => 'index'],
		    'escape' => false ])
	?>
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample04">
      <ul class="navbar-nav ms-auto mb-2 mb-md-0">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Arrecadações</a>
          <ul class="dropdown-menu" aria-labelledby="dropdown01">
            <li><a class="dropdown-item" href="<?= BASE_URL."/arrecadacao/add"?>">Nova arrecadação</a></li>
            <li><?= $this->Html->link('Lista arrecadações', '/arrecadacao/index', ['class' => 'dropdown-item']) ?></li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown02" data-bs-toggle="dropdown" aria-expanded="false">Membros</a>
          <ul class="dropdown-menu" aria-labelledby="dropdown02">
            <li><a class="dropdown-item" href="<?= BASE_URL."/users/add"?>">Novo membro</a></li>
            <li><?= $this->Html->link('Lista membros', '/users/index', ['class' => 'dropdown-item']) ?></li>
            <li><?= $this->Html->link('Importar excel membros', '/users/import-users-excel', ['class' => 'dropdown-item']) ?></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown03" data-bs-toggle="dropdown" aria-expanded="false">Relatórios</a>
          <ul class="dropdown-menu" aria-labelledby="dropdown03">
            <li><a class="dropdown-item" href="<?= BASE_URL."/relatorio/gerar-excel-fidelidade-ano-atual"?>">Dizimos membros mes/ano (xls)</a></li>
            <li><a class="dropdown-item" href="<?= BASE_URL."/relatorio/gerar-pdf-fidelidade-ano-atual"?>">Dizimos membros mes/ano (pdf)</a></li>
          </ul>
        </li>
      </ul>
      <div>
      	<?= $this->Html->getCrumbs(' > ', [
		    'text' => $this->Html->image('logout.png', ['width' => '30', 'height' => '30']),
		    'url' => ['controller' => 'users', 'action' => 'logout'],
		    'escape' => false
		])?>
      </div>
    </div>

  </div>
</nav>