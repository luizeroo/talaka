<main id="linkMain">
    <div id="headerUser">
        <div class="wrapper">
            <div id="userPhoto">
                <div id="usuarioFoto" style="background-image: url(<?= base_url; ?>user-img/<?= $user["img"]; ?>);background-size:cover"></div>
            </div>
            <div id="userInfos">
                <h1>
                    <?= $user["name"]; ?>
                    <span>
                        @<?= $user["login"]; ?>
                    </span>
                </h1>
                <h2>
                    <!--<i class="fa fa-briefcase" aria-hidden="true"></i>-->
                    <!--Desenvolvedor Front-end-->
                </h2>
                <p>
                    <i class="fa fa-birthday-cake" aria-hidden="true"></i>
                    <?php
                    // setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    // date_default_timezone_set('America/Sao_Paulo');
                    // echo strftime('%d de %B de %Y', strtotime($user["birth"]));
                    ?> <?= floor((time() - strtotime($user["birth"]) )/ (365*60*60*24)); ?> anos
                    
                    
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                    Localização
                </p>
                <p>
                    <?= $user["biography"]; ?>
                </p>
                <ul id="userSocial">
                    <li title="Acessar Behance do usuário"><i class="fa fa-behance-square behance" aria-hidden="true"></i></li>
                    <li title="Acessar Facebook do usuário"><i class="fa fa-facebook-square facebook" aria-hidden="true"></i></li>
                    <li title="Acessar Linkedin do usuário"><i class="fa fa-linkedin-square linkedin" aria-hidden="true"></i></li>
                    <li title="Acessar Twitter do usuário"><i class="fa fa-twitter-square twitter" aria-hidden="true"></i></li>
                    <li title="Acessar Pinterest do usuário"><i class="fa fa-pinterest-square pinterest" aria-hidden="true"></i></li>
                    <li title="Acessar Google+ do usuário"><i class="fa fa-google-plus-official googleplus" aria-hidden="true"></i></li>
                    <li title="Acessar Youtube do usuário"><i class="fa fa-youtube-play youtube" aria-hidden="true"></i></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="userInformacoes">
        <div class="wrapper">
            <div class="content">
                <ul id="contentMenu">
                    <li data-tab="Campanha" class='active' ><i class="fa fa-flag" aria-hidden="true"></i> Campanhas</li>
                    <li data-tab="Portfolio" ><i class="fa fa-paint-brush" aria-hidden="true"></i>Portfolio</li>
                    <li data-tab="Albuns" ><i class="fa fa-star" aria-hidden="true"></i>Álbuns favoritos</li>
                </ul>
                <div id="galeria">
                    <div class="tabUser" id="tabCampanha">
                        <h2>
                            Campanhas criadas (00)
                        </h2>
                        
                        <h2>
                            Campanhas Financiadas (00)
                        </h2>
                    </div>
                    <div class="tabUser" id="tabPortfolio">
                        <figure>
                            <img src="/Talaka/resources/img/scott2.jpg">
                            <img src="/Talaka/resources/img/scott1.jpg">
                            <img src="/Talaka/resources/img/scott3.jpg">
                        </figure>
                    </div>
                    <div class='tabUser' id="tabAlbuns">
                        <div class="cadaAlbum">
                            <div class="infoAlbum">
                                <h2>
                                    Boku no Hero Academia
                                </h2>
                                <p>
                                    Artes e conceitos iniciais para Boku no Hero Academia, um projeto pessoal criado por um grupo de desenvolvedores.
                                </p>
                                <p><i class="fa fa-user" aria-hidden="true"></i>Kohei Horikoshi</p>
                            </div>
                        </div>
                    </div>
                    <!--<div class="tabUser" id="tabAlbuns">-->
                    <!--    <div class="cadaAlbum">-->
                    <!--        <div class="infoAlbum">-->
                    <!--            <h2>-->
                    <!--                Nome do álbum-->
                    <!--            </h2>-->
                    <!--            <p>-->
                    <!--                 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id semper felis. Donec faucibus eros elementum, bibendum libero at, ultrices urna. Class aptent taciti sociosqu ad litora torquent per conubia nostra-->
                    <!--            </p>-->
                    <!--            <p><i class="fa fa-user" aria-hidden="true"></i> Nome do usuário</p>-->
                    <!--        </div>-->
                    <!--    </div>-->
                        
                    <!--    <div class="cadaAlbum">-->
                    <!--        <div class="infoAlbum">-->
                    <!--            <h2>-->
                    <!--                Nome do álbum-->
                    <!--            </h2>-->
                    <!--            <p>-->
                    <!--                 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id semper felis. Donec faucibus eros elementum, bibendum libero at, ultrices urna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam nunc neque, interdum ut accumsan vel, auctor vitae libero. Ut sem felis, aliquam sed mollis in, finibus in lectus. Nam bibendum ex ut orci auctor sodales. Morbi nec molestie libero, non convallis orci.-->
                    <!--            </p>-->
                    <!--            <p><i class="fa fa-user" aria-hidden="true"></i> Nome do usuário</p>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
            <aside>
                <div class="statusUser">
                    <ul>
                        <li>
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            Apoiadores
                            <span><?= $user["supporters"];?></span>
                        </li>
                        <li>
                            <i class="fa fa-users" aria-hidden="true"></i>
                            Seguidores
                            <span>607</span>
                        </li>
                        <li>
                            <i class="fa fa-user-circle" aria-hidden="true"></i>
                            Seguindo
                            <span>2</span>
                        </li>
                    </ul>
                    <div id="botoesUsuario">
                        <div id="userMensagem">
                            <i class="fa fa-commenting" aria-hidden="true"></i>
                            Enviar mensagem
                        </div>
                        <div id="userSeguir">
                           <i class="fa fa-user-plus" aria-hidden="true"></i>
                            Seguir
                        </div>
                        <div id="userApoiar">
                            <i class="fa fa-handshake-o" aria-hidden="true"></i>
                            Apoiar
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
    <div id="album">
        <div id="closeAlbum"></div>
        <div id="areaAlbum">
            <div id="contentAlbum">
                <div id="opcaoAlbum">
                    <i title="Curtir álbum" class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                    <i title="Comentar álbum" class="fa fa-commenting-o" aria-hidden="true"></i>
                    <i title="Compartilhar álbum" id="showShare" class="fa fa-share" aria-hidden="true"></i>
                    <i  title="Adicionar aos favoritos" class="fa fa-star-o" aria-hidden="true"></i>
                    <div id="share">
                        <p>
                            Compartilhe este álbum com seus amigos nas suas redes sociais favoritas!
                        </p>
                        <ul>
                            <li><i class="fa fa-facebook" aria-hidden="true"></i></li>
                            <li><i class="fa fa-twitter" aria-hidden="true"></i></li>
                            <li><i class="fa fa-google-plus" aria-hidden="true"></i></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
                <figure>
                    <figcaption>
                        <i class="fa fa-picture-o" aria-hidden="true"></i> Fotos do álbum "Boku no Hero Academia"
                    </figcaption>
                     <img src="/Talaka/resources/img/scott2.jpg">
                            <img src="/Talaka/resources/img/scott1.jpg">
                            <img src="/Talaka/resources/img/scott3.jpg">
                            <img src="/Talaka/resources/img/scott2.jpg">
                            <img src="/Talaka/resources/img/scott1.jpg">
                            <img src="/Talaka/resources/img/scott3.jpg">
                </figure>
            </div>
            <div id="descrAlbum">
                <div id="coverAlbum">
                    <h1>
                       Boku no Hero Academia
                    </h1>
                    <ul>
                        <li>
                            <i class="fa fa-eye" aria-hidden="true"></i>
                            12.213 visualizações
                        </li>
                        <li>
                            <i class="fa fa-user" aria-hidden="true"></i>
                            Kohei Hirokoshi
                        </li>
                        <li>
                            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                            12.222 curtis
                        </li>
                    </ul>
                </div>
                <p>
               Artes e conceitos iniciais para Boku no Hero Academia, um projeto pessoal criado por um grupo de desenvolvedores.
                </p>
                <ul id="categorias">
                    <li id="categoriaPrincipal"><i class="fa fa-bookmark" aria-hidden="true"></i>Ação</li>
                    <li><i class="fa fa-tag" aria-hidden="true"></i>mangá</li>
                    <li><i class="fa fa-tag" aria-hidden="true"></i>boku no hero academia</li>
                    <li><i class="fa fa-tag" aria-hidden="true"></i>scott pilgrim</li>
                    <li><i class="fa fa-tag" aria-hidden="true"></i>sketch</li>
                </ul>
                <p>
                    Álbum criado dia 03 de novembro de 2017
                </p>
            </div>
        </div>
    </div>
</main>