<html>
<head>
    <?php include("header.php");
      includes();
    ?>
</head>
<body>
<div class="col-sm-6">
 		
    
    <div class="panel panel-default">
      <div class="panel-heading bg-info">
        <span class="panel-title">Meus Empregados</span>
 		<div class="panel-heading-controls">
			<button onclick="javascript:document.location='?s_ativo=S'" class="btn btn-xs btn-primary btn-outline dark">Ativos</button>
			<!--<button onclick="javascript:document.location='?s_ativo=A'" class="btn btn-xs btn-primary btn-outline dark">Afastados</button>-->
			<button onclick="javascript:document.location='?s_ativo=N'" class="btn btn-xs btn-primary btn-outline dark">Inativos</button>			
		</div>
 
      </div>
 
      <div class="table-responsive">
        <table class="table table-responsive table-striped table-hover table-condensed text-valign">
          <tr>
            <th scope="col">
            <small>Nome do Trabalhador</small>
            </th>
            
            <th style="text-align: center" scope="col">
           <small></small>
            </th>
 
            <th>
            </th>
            <th>
            </th>
            <th></th>
 
          </tr>
 
          
          <tr>
            <td style="vertical-align:middle;">Guilherme Empregado Live</td> 
            <td style="text-align: left; vertical-align:middle;"><img class='icon' src='icon/checado.png' data-toggle='tooltip' title='Ativo'></td> 
            <td style="text-align: right;">
            <a href="empregados_editar.php?id_empregados=87" onclick="load()" id="col_dir_empregadoscad_empregadosnome_completo_1"><img src="icon/lapis.png" class="icon-btn" data-toggle="tooltip" title="Editar"></a>&nbsp;
            <a href="marca_ponto.php?id_empregados=87" id="col_dir_empregadoscad_empregadosLink6_1"><img src="icon/clock.png" class="icon-btn" data-toggle="tooltip" title="Folha de ponto"></td></a>
            <td width="5%" style="text-align:right;" nowrap>
              <div id="padrao" class="btn-group dropdown">
                <img src="icon/more.png" class="icon-btn dropdown-toggle" data-toggle="dropdown">
                <ul role="menu" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                  <li role="presentation"><a href="pagamentos.php?id_empregados=87" role="menuitem" tabindex="-1" id="col_dir_empregadoscad_empregadosLabel1_1" onclick="load()"><img src="icon/dinheiro.png" width="24px 24px" style="margin:5px"> Gerenciar Pagamentos</a></li>
                  <li role="presentation"><a href="afastamentos.php?id_empregados=87" role="menuitem" tabindex="-1" id="col_dir_empregadoscad_empregadosLink1_1" onclick="load()"><img src="icon/calendario.png" width="24px 24px" style="margin:5px"> Gerenciar Afastamentos</a></li>
                  <!--<li role="presentation"><a href="marca_ponto.php?id_empregados=87" role="menuitem" tabindex="-1" id="col_dir_empregadoscad_empregadosLink4_1" onclick="load()"><img src="icon/registro_de_ponto.png" width="24px 24px" style="margin:5px">	Folha de Ponto</a></li>-->
                  <li role="presentation"><a href="ferias.php?id_empregados=87&amp;tipo=F" role="menuitem" tabindex="-1" id="col_dir_empregadoscad_empregadosLink5_1" onclick="load()"><img src="icon/coqueiro.png" width="24px 24px" style="margin:5px"> Conceder Férias</a></li>
                  <li role="presentation"><a href="contrato_trabalho.php?id_empregados=87" role="menuitem" tabindex="-1" id="col_dir_empregadoscad_empregadosLink3_1" onclick="load()"><img src="icon/texto.png" width="24px 24px" style="margin:5px"> Gerar Contrato de Trabalho</a></li>
                  <li role="presentation"><a href="rescisoes.php?id_empregados=87" role="menuitem" tabindex="-1" id="col_dir_empregadoscad_empregadosLink2_1" onclick="load()"><img src="icon/rescisao.png" width="24px 24px" style="margin:5px"> Rescisão de Contrato</a></li>
                </ul>
              </div>
 			</td> 
 			<td style="width:15px; !important"></td>
          </tr>
 
          
        </table>
 
      </div>
      
 <hr class="grid-gutter-margin-b no-margin-t no-margin-b">
      <div class="panel-footer text-center">
      <div class="text-left">
        
 &nbsp;
 </div>
       	<div class="text-right" style="margin-top:-20px;">
      		<button class="btn btn-sm btn-success btn-outline" onclick="javasript: load(); document.location='empregados_editar.php';"><i class="fa fa-fw fa-plus"></i>Incluir Funcionário</button>
      	</div>
      </div>
 
    </div>
</body>
</html>