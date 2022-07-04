<div class="row">
    <div class="col-lg-12">
        <h6 class="pretitle"><?=__('Relatórios')?></h6>
        <h2 class="title"><?=__('001 - Extração de Serviços')?></h2>
    </div>
</div>


<div class="col-lg-12">

	<div class="panel panel-default">
		<div class="panel-body">
	

				<?
					echo $this->Bootstrap->inputDate('dt_inicio', [
						  'lg'=> '2'
						, 'label' => "Data Inicio"
						 ]);
				?>



				<?
					echo $this->Bootstrap->inputDate('dt_fim', [
						  'lg'=> '2'
						, 'label' => "Data Fim"
						 ]);
				?>



				<?
					echo $this->Bootstrap->input('empresa_id', [
						  'lg'=> '2'
						, 'label' => "Empresa"
						, 'options' => $lista_empresas
						 ]);
				?>

	


			<div class="col-lg-3">
				</br>
				<span class="btn btn-gerar btn-success">Gerar Relatório</span>
			</div>
		</div>
	</div>
</div>

<?= $this->Html->script('/js/controllers/relatorio-001/form.js'. $this->Global->stv()) ?>
