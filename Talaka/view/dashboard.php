<?php
defined("System-access") or header('location: /error');
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Dias', 'Valor'],
          ['Domingo',  1000],
          ['Segunda',  1170],
          ['Terça',  660],
          ['Quarta',  1030],
          ['Quinta',  1000],
          ['Sexta',  1170],
          ['Sábado',  660]
        ]);

        var options = {
          title: 'Financiamentos na plataforma',
          curveType: 'function',
          legend: { position: 'top' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
      
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      function drawTable() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Nome do Projeto');
        data.addColumn('number', 'Valor arrecadado');
        data.addColumn('number', 'Número de Visualizações');
        data.addRows([
          ['Mike',  {v: 10000, f: '$10,000'}, {v: 10000, f: '10,000'}],
          ['Jim',   {v:8000,   f: '$8,000'},  {v: 10000, f: '10,000'}],
          ['Alice', {v: 12500, f: '$12,500'}, {v: 10000, f: '10,000'}],
          ['Bob',   {v: 7000,  f: '$7,000'},  {v: 10000, f: '10,000'}]
        ]);

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
    
<main id="pageAdmin" class="dash">
    <aside>
        <h1>
            talaka analytics
        </h1>
        <div id="modoAdmin">
            <div id="adminMenu">
                <h2>
                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                    Modo Administrador
                </h2>
                <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </div>
            <ul id="opcoesMenu">
                <a href="/">
                    <li>
                        Ir à página inicial
                    </li>
                </a>
                <a href="/explore">
                    <li>
                        Explorar projetos
                    </li>
                </a>
                <a href="#">
                    <li>
                        Deslogar
                    </li>
                </a>
            </ul>
        </div>
        
        <div id="areaControles">
            <ul>
                <li data-tab='VisaoGeral'>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    Visão Geral
                </li>
                <li data-tab='Campanha'>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    Campanhas / Projetos
                </li>
                <!--<li>-->
                <!--    <i class="fa fa-comments-o" aria-hidden="true"></i>-->
                <!--    Comentários-->
                <!--</li>-->
                <li data-tab='PaginasVisitadas'>
                    <i class="fa fa-line-chart" aria-hidden="true"></i>
                    Páginas visitadas
                </li>
            </ul>
        </div>
    </aside>
    <section>
        <header>
            <i id="menuAside" class="fa fa-bars" aria-hidden="true"></i>
            <div class='controleAtivo tituloHeader shadow'>
                <i class="fa fa-pie-chart" aria-hidden="true"></i>
                <h1>
                    Área administrativa
                    <span>
                        Painel de Controle - Talaka
                    </span>
                </h1>
            </div>
        </header>
        
        <div class='tabAdmin' id='tabVisaoGeral'>
            <div class="principalInfo">
                <h1>
                    Olá, Administrador!
                    <span>
                        Confira as novidades desta semana.
                    </span>
                </h1>
                <div id="areasInfo">
                    <div class='info shadow'>
                        <i class="fa fa-upload campanhas" aria-hidden="true"></i>
                        <p>
                            Novas Campanhas
                            <b>
                                <?= $projsLastweek;?>
                            </b>
                        </p>
                    </div>
                    <div class='info shadow'>
                        <i class="fa fa-users usuarios" aria-hidden="true"></i>
                        <p>
                            Novos Usuários
                            <b>
                                <?= $usersLastweek;?>
                            </b>
                        </p>
                    </div>
                    <div class='info shadow'>
                        <i class="fa fa-comments comentarios" aria-hidden="true"></i>
                        <p>
                            Comentários realizados
                            <b><?= $cmtsLastweek; ?></b>
                        </p>
                    </div>
                    <div class='info shadow'>
                        <i class="fa fa-tag tags" aria-hidden="true"></i>
                        <p>
                            Novas Tags
                            <b><?= $tagsLastweek; ?></b>
                        </p>
                    </div>
                </div>
            </div>
            
            <div id="arrecadado" class='shadow container'>
                <h2>
                    Esta semana 
                    <span>
                        foram arrecadados
                    </span>
                </h2>
                <div id="curve_chart"></div>
            </div>
            
            <a href='/explore/<?= $cat["nm_category"];?>/1'>
                <div id="categoria" class='shadow container'>
                    <h2>
                        Veja a categoria
                        <span>
                            mais cadastrada (<?= $cat["magnitude"];?>)
                        </span>
                    </h2>
                    <p>
                        <i class="fa fa-bookmark" aria-hidden="true"></i>
                            <?= $cat["nm_category"];?>
                    </p>
                </div>
            </a>
            
            <a href='/explore/<?= $tag["nm_tag"];?>/1'>
                <div id="tags" class='shadow container'>
                    <h2>
                        Veja a tag
                        <span>
                            mais cadastrada (<?= $tag["magnitude"];?>)
                        </span>
                    </h2>
                    <p>
                        <i class="fa fa-tag" aria-hidden="true"></i>
                            <?= $tag["nm_tag"];?>
                        
                    </p>
                </div>
            </a>
        </div>
        
        <div class='tabAdmin' id='tabCampanha'>
            <div class="principalInfo">
                <h1>
                   Campanhas e Projetos
                    <span>
                        Saiba tudo sobre os projetos cadastrados no Talaka!
                    </span>
                </h1>
            </div>
            
            <div id="campanhasCadastradas" class='shadow container'>
                <h2>
                    Campanhas cadastradas
                    <span>
                       no total, incluindos todas categorias e eixo
                    </span>
                </h2>
                ..inserir graficos..
            </div>
            
            <div id='aceitarProjetos' class='shadow container'>
                <h2>
                    Novos Projetos Cadastrados
                    <span>
                       Adicione, visite ou exclua os projetos cadastrados
                    </span>
                </h2>
                
                <ul class='lista'>
                    <?php if( count($projsToApprove) > 0){ 
                            foreach($projsToApprove as $project){ ?>
                        <li data-id="<?= $project->id;?>">
                            <p>
                                <?= $project->title;?>
                                <span>
                                    <?= $project->creator->name;?>
                                </span>
                            </p>
                            <ul class='item'>
                                <a href='/campanha/<?= urlencode($project->title) ;?>' target='_blank'>
                                    <li class='visualizar'>
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </li>
                                </a>
                                <li class='approve aceitar' data-id="<?= $project->id;?>">
                                    <i class="fa fa-check-circle"  aria-hidden="true"></i>
                                </li>
                                <li class='approve deletar' data-id="<?= $project->id;?>">
                                    <i class="fa fa-trash-o"  aria-hidden="true"></i>
                                </li>
                            </ul>
                        </li>
                    <?php } 
                    }else{ ?>
                        Nenhum Projeto para aprovação
                    <?php }
                    ?>
                </ul>
                
            </div>
            
            <!--<div id="denuncias" class='shadow container'>-->
            <!--    <h2>-->
            <!--        Denúncias de Projetos-->
            <!--        <span>-->
            <!--           no total, incluindos todas categorias e eixo-->
            <!--        </span>-->
            <!--    </h2>-->
            <!--    ..inserir lista de projetos a serem denunciados..-->
            <!--    <ul class='lista'>-->
            <!--        <li>-->
            <!--            <p>-->
            <!--                Título do Projeto-->
            <!--                <span>-->
            <!--                    nome do autor-->
            <!--                </span>-->
            <!--            </p>-->
            <!--            <ul class='item'>-->
            <!--                <li class='visualizar'>-->
            <!--                    <i class="fa fa-eye" aria-hidden="true"></i>-->
            <!--                </li>-->
            <!--                <li class='aceitar'>-->
            <!--                    <i class="fa fa-check-circle"  aria-hidden="true"></i>-->
            <!--                </li>-->
            <!--                <li class='deletar'>-->
            <!--                    <i class="fa fa-trash-o"  aria-hidden="true"></i>-->
            <!--                </li>-->
            <!--            </ul>-->
            <!--        </li>-->
            <!--        <li>-->
            <!--            <p>-->
            <!--                Título do Projeto-->
            <!--                <span>-->
            <!--                    nome do autor-->
            <!--                </span>-->
            <!--            </p>-->
            <!--            <ul class='item'>-->
            <!--                <li class='visualizar'>-->
            <!--                    <i class="fa fa-eye" aria-hidden="true"></i>-->
            <!--                </li>-->
            <!--                <li class='aceitar'>-->
            <!--                    <i class="fa fa-check-circle"  aria-hidden="true"></i>-->
            <!--                </li>-->
            <!--                <li class='deletar'>-->
            <!--                    <i class="fa fa-trash-o"  aria-hidden="true"></i>-->
            <!--                </li>-->
            <!--            </ul>-->
            <!--        </li>-->
            <!--    </ul>-->
            <!--</div>-->
        </div>
        
        <div class='tabAdmin' id='tabPaginasVisitadas'>
            <div class="principalInfo">
                <h1>
                   Páginas mais visitadas
                    <span>
                        Conheça as páginas do Talaka que são vistas com maior frequência
                    </span>
                </h1>
            </div>
            
            <div id="campanhasCadastradas" class='shadow container'>
                <h2>
                    Gráfico de Páginas
                    <span>
                       no total, incluindos todas visitas de usuários cadastrados ou visitantes
                    </span>
                </h2>
                 <div id="table_div"></div>
            </div>
            
        </div>
    </section>
    <div id="snackbar">Talaka</div>
</main>
<script src="<?= base_url; ?>view/js/admin.js" type="text/javascript"></script>