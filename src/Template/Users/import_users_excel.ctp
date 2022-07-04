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
	    	<br/>
	        <h3><?= __('Importar membros de um excel') ?></h3>
	        
	        <br/><br/>

            <div class="d-grid gap-2 d-md-flex justify-content-md-start">                
				<h5>1. Faça o download do arquivo base em excel e o preencha com os dados dos membros (os campos de nome e email são obrigatórios).</h5>	            
	        </div>

	        <br/>
	        
	        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
	        	<a href="<?=BASE_URL."/webroot/templates/planilha-membros-ipm.xlsx"?>" class="btn btn-success btn-lg">Download Template</a>
	        </div>
	        
	        <hr>
	        <br/>

	        <div class="d-grid gap-2 d-md-flex justify-content-md-start">  
	        	<h5>2. Clique no campo abaixo, selecione o caminho do arquivo onde você inseriu os dados dos novos usuários e clique em "enviar".</h5>
	    	</div>

	    	<br/>

	        <form action="read-excel" enctype="multipart/form-data" method="post"> 

   		        <div class=" form-group input col-md-4 col-lg-6 align-items-center">                
		            
		            <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
			            <input type="file" name="upload-users" class="form-control" maxlength="200" id="field-upload"/> 
		        </div>

		        <br/>
	            
	            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
	            	<input name="send-file" type="submit" value="enviar" class="btn btn-success btn-lg">
	            </div>
		            <br/><br/><br/><br/>

		        <input type="hidden" name="_csrfToken" autocomplete="off" value="<?= $header?>">
	                       
			</form>

	        
	    </div>
    </div>
</main>