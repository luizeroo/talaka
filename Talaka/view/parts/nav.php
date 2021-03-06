<?php
defined("System-access") or header('location: /error');
use Talaka\Controllers\PageController;
?>
    <div id="toTop"><i class="fa fa-angle-up" aria-hidden="true"></i></div>

    <div id="menuFix">
        <div id="acessibility">
            <ul>
                <!--<li>Teclado Virtual</li>-->
                <!--<li id="contrast">Contraste</li>-->
                <li>
                    <i class="fa fa-minus-square" id="minus" aria-hidden="true"></i> Tamanho
                    <i class="fa fa-plus-square" id="plus" aria-hidden="true"></i>
                </li>
                
                <li id='conteudo'>Ir ao conteúdo</li>
                
            </ul>
        </div>

        <nav>
            <div class="wrapper">
                <div class="siteNav-left">
                    <ul>
                        <a href="/explore">
                        <li>
                            Explorar
                        </li>
                        </a>
                        <a href='/criar-campanha'>
                            <li>Começar uma campanha</li>
                        </a>
                    </ul>
                </div>

                <div class="siteNav-middle">
                    <h1 onclick="window.self.location = '/';">talaka</h1>
                </div>

                <div class="siteNav-right">
                    <ul>
                        <li>
                            <i class="fa fa-search" aria-hidden="true" id="searchButton">
                                <div id="searchArea">
                                    <form onsubmit="return false;">
                                        <input type="search" class="search navSearch" name="pesquisa" placeholder="Pesquisar projetos">
                                        <input type="submit" id="doSearch" value="Pesquisar">
                                    </form>
                                </div>
                            </i>
                            
                        </li>
                        <!--<li>-->
                        <!--    Como funciona-->
                        <!--</li>-->
                            <?php 
                            if(PageController::is_logged()){
                            ?>
                            <a href="/perfil/<?= $_SESSION['user']['login'] ;?>">
                                <li class='usuarioLogado' data-user="<?= $_SESSION['user']['id'];?>">
                                    <div id="userloginPhoto" style="background-image: url(<?= base_url; ?>user-img/<?= $_SESSION['user']['img'];?> )"></div>
                                </li>
                            </a>
                            <a href="/signout">
                            <li>
                                sair
                            </li>
                            </a>
                            <?php 
                            }else{ 
                            ?>
                            <a href="/signin">
                                <li>
                                    Acessar
                                
                                </li>
                            </a>
                            <?php 
                            } 
                            ?>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div id="responsive_nav">
            <div class='wrapper'>
                <div class="area">
                    <h1 onclick="window.self.location = '/';">talaka</h1>
                    <div class='menuSite'>
                        <i title="Abrir menu" class="fa fa-bars" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class='listMenu'>
                <ul>
                    <a href="/explore">
                        <li>Explorar</li>
                    </a>
                    <a href='/criar-campanha'>
                        <li>Começar campanha</li>
                    </a>
                    <li id='searchButtonli'>
                        <i class="fa fa-search" aria-hidden="true" id="searchButton">
                        </i>
                    </li>
                    <div id="searchArea">
                        <form onsubmit="return false;">
                            <input type="search" class="search navSearch" name="pesquisa" placeholder="Pesquisar projetos">
                            <input type="submit" id="doSearch">
                        </form>
                    </div>
                    <?php 
                            if(PageController::is_logged()){
                            ?>
                            <a href="/perfil/<?= $_SESSION['user']['login'] ;?>">
                                <li>
                                    Meu Perfil
                                </li>
                            </a>
                            <a href="/signout">
                            <li>
                                Sair
                            </li>
                            </a>
                            <?php 
                            }else{ 
                            ?>
                            <a href="/signin">
                                <li>
                                    Acessar
                                
                                </li>
                            </a>
                            <?php 
                            } 
                            ?>
                </ul>
            </div>
        </div>
    </div>