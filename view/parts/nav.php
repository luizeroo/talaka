
<body>
    <a href="main">
        <div id="toTop"><i class="fa fa-angle-up" aria-hidden="true"></i></div>
    </a>

    <div id="menuFix">
        <div id="acessibility">
            <ul>
                <li>Teclado Virtual</li>
                <li id="contrast">Contraste</li>
                <li>
                    <i class="fa fa-minus-square" id="minus" aria-hidden="true"></i> Tamanho
                    <i class="fa fa-plus-square" id="plus" aria-hidden="true"></i>
                </li>
                <li>Ir ao conteúdo</li>
            </ul>
        </div>

        <nav>
            <div class="wrapper">
                <div class="siteNav-left">
                    <ul>
                        <li>
                            <i class="fa fa-book" aria-hidden="true"></i>Explorar
                        </li>
                        <li>Começar uma campanha</li>
                    </ul>
                </div>

                <div class="siteNav-middle">
                    <h1>talaka</h1>
                </div>

                <div class="siteNav-right">
                    <ul>
                        <li>
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </li>
                        <li>
                            Como funciona
                        </li>
                            <?php 
                            if(Pagecon::is_logged()){
                            ?>
                            <li>
                                <div id="userloginPhoto" style="background-image: url(/user-img/<?= $_SESSION[imgUser];?> )"></div>
                            </li>
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
    </div>