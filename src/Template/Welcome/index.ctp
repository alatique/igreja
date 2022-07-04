
<main>
  <?= $this->element('menu') ?>

  <body>
  	<!--Inicio teste cards-->
	  <div class="album py-5 bg-light">
	    <div class="container">
	      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
	        <div class="col">
	          <div class="card shadow-sm">
	            
	          	<div id="container" style="width:100%; height:400px;"></div>
	            
	          </div>
	        </div>

	        <div class="col">
	          <div class="card shadow-sm">
	            <div id="container2" style="width:100%; height:400px;"></div>
	          </div>
	        </div>

	        <div class="col">
	          <div class="card shadow-sm">
	            <div id="container3" style="width:100%; height:400px;"></div>
	          </div>
	        </div>
	        
	      </div>
	    </div>
	  </div>
	  <input type="hidden" name="_csrfToken" autocomplete="off" value="<?= $header?>">
	  <!--Fim teste cards-->
  </body>
</main>

<?php echo $this->Html->script('/js/controllers/welcome/index.js') ?>
