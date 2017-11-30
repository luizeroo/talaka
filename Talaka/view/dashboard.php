<?php
defined("System-access") or header('location: /error');
?>
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
                <li data-tab='visaoGeral'>
                    <i class="fa fa-eye" aria-hidden="true"></i>
                    Visão Geral
                </li>
                <li data-tab='campanha'>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    Campanhas / Projetos
                </li>
                <!--<li>-->
                <!--    <i class="fa fa-comments-o" aria-hidden="true"></i>-->
                <!--    Comentários-->
                <!--</li>-->
                <li data-tab='paginasVisitadas'>
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
                    Visão Geral
                    <span>
                        Painel de Controle - Talaka
                    </span>
                </h1>
            </div>
        </header>
        
        <div id="visaoGeral" class='tabAdmin' id='tabvisaoGeral'>
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
                                17
                            </b>
                        </p>
                    </div>
                    <div class='info shadow'>
                        <i class="fa fa-users usuarios" aria-hidden="true"></i>
                        <p>
                            Novos Usuários
                            <b>
                                100
                            </b>
                        </p>
                    </div>
                    <div class='info shadow'>
                        <i class="fa fa-comments comentarios" aria-hidden="true"></i>
                        <p>
                            Comentários realizados
                            <b>29</b>
                        </p>
                    </div>
                    <div class='info shadow'>
                        <i class="fa fa-bookmark tags" aria-hidden="true"></i>
                        <p>
                            Novas Tags
                            <b>112</b>
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
                
                ..inserir grafico..
            </div>
            
            <div id="categoria" class='shadow container'>
                <h2>
                    Veja a categoria
                    <span>
                        mais cadastrada
                    </span>
                </h2>
                <p>
                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                    Drama
                </p>
            </div>
            
            <div id="tags" class='shadow container'>
                <h2>
                    Veja a tag
                    <span>
                        mais cadastrada
                    </span>
                </h2>
                <p>
                    <i class="fa fa-tag" aria-hidden="true"></i>
                    Anime
                </p>
            </div>
        </div>
        
        <div id='campanhasEprojetos' class='tabAdmin' id='tabcampanha'>
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
                    <li>
                        <p>
                            Título do Projeto
                            <span>
                                nome do autor
                            </span>
                        </p>
                        <ul class='item'>
                            <li class='visualizar'>
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </li>
                            <li class='aceitar'>
                                <i class="fa fa-check-circle"  aria-hidden="true"></i>
                            </li>
                            <li class='deletar'>
                                <i class="fa fa-trash-o"  aria-hidden="true"></i>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p>
                            Título do Projeto
                            <span>
                                nome do autor
                            </span>
                        </p>
                        <ul class='item'>
                            <li class='visualizar'>
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </li>
                            <li class='aceitar'>
                                <i class="fa fa-check-circle"  aria-hidden="true"></i>
                            </li>
                            <li class='deletar'>
                                <i class="fa fa-trash-o"  aria-hidden="true"></i>
                            </li>
                        </ul>
                    </li>
                </ul>
                
            </div>
            
            <div id="denuncias" class='shadow container'>
                <h2>
                    Denúncias de Projetos
                    <span>
                       no total, incluindos todas categorias e eixo
                    </span>
                </h2>
                ..inserir lista de projetos a serem denunciados..
                <ul class='lista'>
                    <li>
                        <p>
                            Título do Projeto
                            <span>
                                nome do autor
                            </span>
                        </p>
                        <ul class='item'>
                            <li class='visualizar'>
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </li>
                            <li class='aceitar'>
                                <i class="fa fa-check-circle"  aria-hidden="true"></i>
                            </li>
                            <li class='deletar'>
                                <i class="fa fa-trash-o"  aria-hidden="true"></i>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <p>
                            Título do Projeto
                            <span>
                                nome do autor
                            </span>
                        </p>
                        <ul class='item'>
                            <li class='visualizar'>
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </li>
                            <li class='aceitar'>
                                <i class="fa fa-check-circle"  aria-hidden="true"></i>
                            </li>
                            <li class='deletar'>
                                <i class="fa fa-trash-o"  aria-hidden="true"></i>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        
        <div id='paginasVisitadas' class='tabAdmin' id='tabpaginasVisitadas'>
            <div class="principalInfo">
                <h1>
                   Páginas mais visitadas
                    <span>
                        Conheça as páginas do TCC que são vistas com maior frequência
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
                ..inserir graficos..
            </div>
            
        </div>
    </section>
</main>