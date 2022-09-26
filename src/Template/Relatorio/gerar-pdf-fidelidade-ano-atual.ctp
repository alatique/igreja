<style type="text/css">
	.pdf-cabecalho-titulo{
		font-size: 14px;
		text-align: left;
	}

	.pdf-cabecalho-texto{
		font-size: 14px;
		width: 520px;
		padding-left: 10px;
	}

	#pdf-img-logo{
		width: 50px;
		height: 65px;
		text-align: right;
  }

  .table-pdf{
    border-collapse: collapse;
    width: 100%;
  }

  .table-head-pdf{
    display: inline-block;
    text-align: center;
    vertical-align: top;
    box-sizing: border-box;
    border-collapse: collapse;
    border: 1px solid #000000;
    font-weight: bold;
    font-size: 13px;
    background-color: #8DB2DD;
  }
  
  .table-cel-pdf{
    /*display: inline-block;*/
    text-align: center;
    vertical-align: middle;
    box-sizing: border-box;
    border-collapse: collapse;
    border: 1px solid #000000;
    font-size: 12px;
  }

  .table-cel-pdf-blank{
    display: inline-block;
    text-align: center;
    vertical-align: top;
    box-sizing: border-box;
    border: 0px solid #FFFFFF;
    padding: 10px 0 10px 0;
  }

</style>


<table class="table table-borderless">
  <thead>
  </thead>
  <tbody>

    <tr>
      <th scope="col" class="pdf-cabecalho-titulo">Título:</th>
      <td class="pdf-cabecalho-texto">Relatório de dízimos e ofertas mensais por membro</td>
      <td rowspan="3"><img src="<?=BASE_URL?>/webroot/img/IPM-logo.png" id="pdf-img-logo"></td>
    </tr>

    <tr>
      <th scope="col" class="pdf-cabecalho-titulo">Data:</th>
      <td class="pdf-cabecalho-texto"><?= date('d/m/Y') ?></td>
      <td></td>
    </tr>

    <tr>
      <th scope="col" class="pdf-cabecalho-titulo">Gerado por:</th>
      <td class="pdf-cabecalho-texto"><?= $user['name'] ?></td>
      <td></td>
    </tr>

  </tbody>
</table>

<br/><br/><br/>



<table class="table-pdf">
  <thead>
    <tr>
      <th class="table-head-pdf">MÊS</th>
      <th class="table-head-pdf">MEMBRO</th>
      <th class="table-head-pdf">DÍZIMO (R$)</th>
      <th class="table-head-pdf">OFERTA (R$)</th>
    </tr>
  </thead>
  <tbody>
    <?php $mes_anterior = ''; ?>
    <?php $contador_mes = 1; ?>
    <?php foreach ($dados as $key => $d) { ?>
      <?php if ($mes_anterior != $d[1] and $mes_anterior != '') { ?>
        <tr>
          <td class="table-cel-pdf-blank"></td>
          <td class="table-cel-pdf-blank"></td>
          <td class="table-cel-pdf-blank"></td>
          <td class="table-cel-pdf-blank"></td>
        </tr>
      <?php $contador_mes = 1; ?>
        
      <?php  }?>
        <tr>
          <?php if ($contador_mes == 1) { ?>
            <td class="table-cel-pdf" rowspan="<?=$repeticao_meses[$d[1]]?>"><?php echo $d[1] ?></td>
          <?php } ?>

          
          <td class="table-cel-pdf"><?php echo $d[2] ?></td>
          <td class="table-cel-pdf"><?php echo $d[3] ?></td>
          <td class="table-cel-pdf"><?php echo $d[4] ?></td>
        </tr>
      <?php 
        $mes_anterior = $d[1]; 
        $contador_mes++;
    } ?>
  </tbody>
</table>

<br/><br/><br/>
<?= "Documento confidencial da Igreja Presbiteriana do Morumbi"?>