<?php
defined("System-access") or header('location: /error');
use Talaka\Models\Project;
use Talaka\Controllers\Pagecon;
?>
    <?php

$proj = new Project($project);
$aux = (($proj->collected) * 100) / $proj->meta;
$percent = ( $aux > 100 )? 100 : $aux;
?>
        <main>
            <div id="headerProject" style="background-image: url( <?= base_url . 'proj-img/' . $proj->cover ;?> )"></div>
            <!-- Página de Projeto -->
            <section id="infosProject">
                <div class="wrapper">
                    <div id="projetoDestaque">
                        <div id="projetoCapa">
                            <div id="projetoDono" style="background-image: url(
                    <?= base_url . 'user-img/' . $proj->creator->img ;?> )">

                            </div>

                            <img src="<?= base_url . "proj-img/" . $proj->img ;?>" title="<?= $proj->title ;?>" alt="Capa do projeto <?= $proj->title ;?>">
                        </div>

                        <div id="projetoMeta">
                            <div id="projetoAcumulado">
                                <p id="projAcumulado">
                                    <i>R$</i>
                                    <?= $proj->collected ?>,00
                                        <span>
                                arrecadado
                            </span>
                                </p>
                                <p id="projMeta">
                                    meta <b>R$ <?= $proj->meta ?>,00</b>
                                </p>
                            </div>
                            <div id="projetoProgresso">
                                <div id="projetoBar" style="width:<?= $percent;?>%"></div>
                            </div>
                            <div id="projetoStatus">
                                <ul>
                                    <li>
                                        <b><?= $proj->visit;?></b> investidores
                                    </li>

                                    <li>
                                        <b><?= round($percent);?>%</b> arrecadado
                                    </li>

                                    <li>
                                        <b><?= round( ( strtotime($proj->dtF) - strtotime(date("Y-m-d")) ) / (60 * 60 * 24) ); ?></b> dias restando
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="projetoInformacoes">
                        <h1>
                            <?= $proj->title ?>
                        </h1>

                        <h2>
                            <i class="fa fa-user" aria-hidden="true"></i> Projeto criado por:
                            <a href=""><?= $proj->creator->name ;?></a>
                        </h2>

                        <?php if($proj->coauthor !== "no"){?>
                        <div class="coauthor">
                            <h2>
                                <i class="fa fa-users" aria-hidden="true"></i> Co-Autores:
                            </h2>
                            <ul id="coauthor">
                                <?php array_map(function($coauthor){
                                $co = explode(":",$coauthor);
                            ?>
                                <li data-title="<?= $co[0]; ?>" style="background-image:url(<?= base_url; ?>user-img/<?= $co[1] ; ?>)"></li>
                                <?php },explode(",",$proj->coauthor)); ?>
                            </ul>

                        </div>
                        <?php }?>
                        <p>
                            <span id="descricao">Descrição</span>
                            <?= $proj->ds ;?>
                        </p>
                        <ul id="categorias">
                            <a href="/explore/<?= urlencode($proj->category->name);?>/1">
                                <li id="categoriaPrincipal">
                                    <i class="fa fa-bookmark" aria-hidden="true"></i>
                                    <?= $proj->category->name ?>
                                </li>
                            </a>
                            <?php if($proj->tags !== "no"){ 
                                    array_map(function($tag){
                                        $t = explode(":",$tag);
                                    ?>
                            <li>
                                <i class="fa fa-tag" aria-hidden="true"></i>
                                <?= $t[1];//Name?>
                            </li>
                            <?php
                                    },explode(",",$proj->tags)) ;
                                    }?>
                        </ul>
                        <div id="botoes">
                            <div class="buttons" id="financiarProjeto">
                                Financiar projeto
                            </div>
                            <div class="buttons" id="visualizarDemonstracao">
                                Visualizar demonstração
                            </div>
                            <div id="social">
                                compartilhar campanha
                                <ul>
                                    <li></li>
                                    <li></li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="conhecerProjeto">
                <div class="wrapper">
                    <div id="projetoContain">
                        <ul id="menu">
                            <li data-tab="pc">Campanha</li>
                            <li data-tab="pg">Galeria</li>
                            <li data-tab="pa">Atualizações</li>
                            <li data-tab="">Apoiadores <b>(30)</b></li>
                            <li data-tab="">Comentários <b>(30)</b></li>
                            <li data-tab="">Comunidade</li>
                        </ul>

                        <div data-tab="pc" class="tabProject tabAtual" id="projetoConteudo">
                            <h1>
                                Conheça o projeto
                                <?= $proj->title ?>
                            </h1>
                            <p>
                                <?= $proj->resume ?>
                            </p>
                        </div>
                        <div data-tab="pg" class="tabProject" id="projetoGaleria">
                            <figure>
                                <figcaption>
                                    Confira imagens da campanha
                                    <?= $proj->title ?>
                                </figcaption>
                                <img src="https://vignette.wikia.nocookie.net/naruto/images/0/09/Naruto_newshot.png/revision/latest/scale-to-width-down/300?cb=20170621101134">
                                <img src="https://vignette.wikia.nocookie.net/naruto/images/0/09/Naruto_newshot.png/revision/latest/scale-to-width-down/300?cb=20170621101134">
                                <img src="https://vignette.wikia.nocookie.net/naruto/images/0/09/Naruto_newshot.png/revision/latest/scale-to-width-down/300?cb=20170621101134">
                                <img src="https://vignette.wikia.nocookie.net/naruto/images/0/09/Naruto_newshot.png/revision/latest/scale-to-width-down/300?cb=20170621101134">
                                <img src="https://vignette.wikia.nocookie.net/naruto/images/0/09/Naruto_newshot.png/revision/latest/scale-to-width-down/300?cb=20170621101134">
                                <img src="http://img1.ak.crunchyroll.com/i/spire1/3011e12b3395d39a18379d9e9fdc30671502581680_full.jpg">
                                <img src="http://www.thcgamers.com/wp-content/uploads/2016/12/22-9.jpg">
                            </figure>
                        </div>
                        <div data-tab="pa" class="tabProject" id="projetoAtualizacoes">
                            <div class="cadaAtt">
                                <div class="headerAtt">
                                    <p>
                                        Atualização #1
                                    </p>
                                    <p>
                                        21 de Outubro de 2017
                                    </p>
                                </div>
                                <div class="nameAtt">
                                    <p>
                                        Nome de cada atualização cadastrada
                                    </p>
                                </div>
                                <div class="socialAtt">
                                    <ul>
                                        <li>
                                            <i class="fa fa-commenting-o" aria-hidden="true"></i> 12 Comentários</li>
                                        <li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Curtir
                                        </li>
                                        <li>
                                            <i class="fa fa-hashtag" aria-hidden="true"></i> 12 Interações</li>
                                    </ul>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dignissim feugiat sem, in condimentum magna consequat nec. Vestibulum dapibus mauris eu finibus commodo. Mauris non massa vel risus semper gravida ac id orci. In nec varius lectus. Proin in ornare ex. Nullam suscipit risus eget congue bibendum. Pellentesque elementum posuere sem.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dignissim feugiat sem, in condimentum magna consequat nec. Vestibulum dapibus mauris eu finibus commodo. Mauris non massa vel risus semper gravida ac id orci. In nec varius lectus. Proin in ornare ex. Nullam suscipit risus eget congue bibendum. Pellentesque elementum posuere sem.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dignissim feugiat sem, in condimentum magna consequat nec. Vestibulum dapibus mauris eu finibus commodo. Mauris non massa vel risus semper gravida ac id orci. In nec varius lectus. Proin in ornare ex. Nullam suscipit risus eget congue bibendum. Pellentesque elementum posuere sem.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum dignissim feugiat sem, in condimentum magna consequat nec. Vestibulum dapibus mauris eu finibus commodo. Mauris non massa vel risus semper gravida ac id orci. In nec varius lectus. Proin in ornare ex. Nullam suscipit risus eget congue bibendum. Pellentesque elementum posuere sem.
                                    </p>
                                </div>
                                <div class="commentaryAtt">
                                    <h4>Comentários</h4>
                                    <div class="cadaComentario">
                                        <div class="header">
                                            asd
                                        </div>
                                        <p>asldjkasdd</p>
                                    </div>
                                </div>
                            </div>
                            <div class="cadaAtt">

                            </div>
                            <div class="cadaAtt">

                            </div>
                        </div>
                    </div>

                    <aside id="recompensas">
                        <h3>Incentive este projeto!</h3>
                        <h4>Recompensas</h4>
                        <div class="cadaRecompensa">
                            <div class="selecionarRecompensa">
                                <p>Escolher essa recompensa</p>
                            </div>
                            <p class="recompensaValor"><b>R$</b> 20,00 ou mais</p>
                            <p class="recompensaApoiadores">3 usuários apoiando</p>
                            <p class="recompensaDescricao">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget magna sit amet mi luctus egestas et vel ante.
                            </p>
                        </div>

                        <div class="cadaRecompensa">
                            <div class="selecionarRecompensa">
                                <p>Escolher essa recompensa</p>
                            </div>
                            <p class="recompensaValor"><b>R$</b> 40,00 ou mais</p>
                            <p class="recompensaApoiadores">3 usuários apoiando</p>
                            <p class="recompensaDescricao">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget magna sit amet mi luctus egestas et vel ante.
                            </p>
                        </div>

                        <div class="cadaRecompensa">
                            <div class="selecionarRecompensa">
                                <p>Escolher essa recompensa</p>
                            </div>
                            <p class="recompensaValor"><b>R$</b> 100,00 ou mais</p>
                            <p class="recompensaApoiadores">3 usuários apoiando</p>
                            <p class="recompensaDescricao">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget magna sit amet mi luctus egestas et vel ante.
                            </p>
                        </div>
                    </aside>
                </div>
            </section>
            <div id="financiamento">
                <div class="wrapper">
                    <div id="areaFinanciamento">
                        <div id="nav">
                            <ul>
                                <li>Dados Pessoais</li>
                                <li>Contribuição</li>
                                <li>Pagamento</li>
                                <li>Compartilhe</li>
                            </ul>
                            <p>Você está apoiando o projeto de
                                <?= $proj->creator->name ?>! </p>
                            <h1>
                                <?= $proj->title ?>
                            </h1>
                        </div>
                        <div class="formulario" id="dadosPessoais">
                            <?php 
                                if(Pagecon::is_logged()){
                                ?>
                            <div id="usuariologado">
                                <div id="fotoUsuario" style="background-image: url(<?= base_url; ?>user-img/<?=$_SESSION['user']['img'];?> )"></div>
                                <div id="dadosUsuario">
                                    <p>
                                        <?= $_SESSION['user']['name'] ?><br>
                                            <?= $_SESSION['user']['email'] ?><br>
                                                <span>
                                                   Não é você? <a href="#">Deslogar.</a>
                                               </span>
                                    </p>
                                </div>
                            </div>
                            <?php 
                                }else{ 
                                ?>

                            <?php 
                                } 
                        ?>
                            <div id="contribuicao">
                                <h2>Escolher forma de contribuição</h2>
                                <p>
                                    Escolha o nome que será mostrado, publicamente, próximo a sua contribuição na página de campanha.
                                </p>

                                <form>
                                    <label class="area">
                                    <input name="modoPagante" type="radio" />
                                    <i class="fa fa-user" aria-hidden="true"></i> <?= $_SESSION['user']['name'] ?>
                                </label>

                                    <label class="area">
                                    <input name="modoPagante" type="radio" />
                                    <i class="fa fa-user-secret" aria-hidden="true"></i> Anônimo
                                </label>
                                    <input type="button" value="Continuar" class="acoes" id="continuar">
                                    <input type="button" value="Cancelar" class="acoes" id="cancelar">
                                </form>
                            </div>
                        </div>
                        <div class="formulario" id="dadosContribuicao">
                            <div id="recompensaWrapper">
                                <ul>
                                    <li class="cadaRecompensa">
                                        <div class="valor">
                                            <i class="fa fa-chevron-left" aria-hidden="true" title="voltar" id="voltar"></i>
                                            <span>
                                            até
                                        </span> R$ 25
                                        </div>
                                        <div class="recompensaDescricao">
                                            <p class="descricao">
                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare ligula nibh, eget placerat libero pellentesque vitae. Vestibulum consectetur sodales mi nec iaculis. Pellentesque bibendum dolor vitae nulla aliquet, vel faucibus lectus egestas. In luctus, lacus quis fringilla commodo, turpis nisl pellentesque dui, quis ultricies erat tellus vitae nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare ligula nibh, eget placerat libero pellentesque vitae. Vestibulum consectetur sodales mi nec iaculis. Pellentesque bibendum dolor vitae nulla aliquet, vel faucibus lectus egestas. In luctus, lacus quis fringilla commodo, turpis nisl pellentesque dui, quis ultricies erat tellus vitae nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ornare ligula nibh, eget placerat libero pellentesque vitae. Vestibulum consectetur sodales mi nec iaculis. Pellentesque bibendum dolor vitae nulla aliquet, vel faucibus lectus egestas. In luctus, lacus quis fringilla commodo, turpis nisl pellentesque dui, quis ultricies erat tellus vitae nisl.
                                            </p>
                                            <p><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Digital download of the full-length
                                            </p>
                                            <p><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Digital download
                                            </p>
                                            <p><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Digital download of the full-length album EVEREST 3 copies of CD + original artwork of EVEREST mailed to your home
                                            </p>
                                            <div class="donate">
                                                <form method="post" name="contribuicao">
                                                    <label for="valorDoado">
                                                    Quanto você deseja doar?
                                                    <span>
                                                        Valor entre <b>$valorMinimo</b> e <b>$valorMaximo</b> desta recompensa
                                                    </span>
                                                </label>
                                                    <input id="valorDoado" type="number" name="valorDoado" placeholder="Digite aqui o valor da sua doação">
                                                    <input type="button" id="continuarContribuicao" value="Continuar">
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="cadaRecompensa">
                                        <div class="valor">
                                            R$ 25
                                            <span>
                                            ou mais
                                        </span>
                                        </div>
                                    </li>
                                    <li class="cadaRecompensa">
                                        <div class="valor">
                                            R$ 50
                                            <span>
                                            ou mais
                                        </span>
                                        </div>
                                    </li>
                                    <li class="cadaRecompensa">
                                        <div class="valor">
                                            R$ 100
                                            <span>
                                            ou mais
                                        </span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="formulario" id="dadosPagamento">
                            <h2>
                                Escolha a melhor forma de pagamento
                            </h2>
                            <ul id="escolherForma">
                                <li>
                                    <input type="radio" id="cartao" name='pagamento'>
                                    <label for="cartao" class="escolha">
                                    <i class="fa fa-credit-card" aria-hidden="true"></i> 
                                    Pagamento com cartões de crédito
                                </label>
                                    <div class="efetuarPagamento" id="opCartao">
                                        <div class="credit-card-box">
                                            <div class="flip">
                                                <div class="front">
                                                    <div class="chip"></div>
                                                    <div class="logo">
                                                        <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">-->
                                                <g>
                                                  <g>
                                                    <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                                                             c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                                                             c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                                                             M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                                                             c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                                                             c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                                                             l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                                                             C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                                                             C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                                                             c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                                                             h-3.888L19.153,16.8z"/>
                                                  </g>
                                                </g>
                                              </svg>
                                                    </div>
                                                    <div class="number"></div>
                                                    <div class="card-holder">
                                                        <label>Card holder</label>
                                                        <div></div>
                                                    </div>
                                                    <div class="card-expiration-date">
                                                        <label>Expires</label>
                                                        <div></div>
                                                    </div>
                                                </div>
                                                <div class="back">
                                                    <div class="strip"></div>
                                                    <div class="logo">
                                                        <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
                                                <g>
                                                  <g>
                                                    <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                                                             c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                                                             c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                                                             M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                                                             c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                                                             c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                                                             l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                                                             C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                                                             C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                                                             c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                                                             h-3.888L19.153,16.8z"/>
                                                  </g>
                                                </g>
                                              </svg>

                                                    </div>
                                                    <div class="ccv">
                                                        <label>CCV</label>
                                                        <div></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="credit-formulario">
                                            <fieldset>
                                                <label>
                                                Número do cartão
                                            </label>
                                                <div id="creditNumero">
                                                    <input type="text" name="cardNumber[]" class="input-cart-number" maxlength="4">
                                                    <input type="text" name="cardNumber[]" class="input-cart-number" maxlength="4">
                                                    <input type="text" name="cardNumber[]" class="input-cart-number" maxlength="4">
                                                    <input type="text" name="cardNumber[]" class="input-cart-number" maxlength="4">
                                                </div>
                                                <label>
                                                Titular do Cartão
                                            </label>
                                                <div id="creditDono">
                                                    <input type="text" name="cardName" id="cardName">
                                                </div>

                                                <div id="creditFinal">
                                                    <div>
                                                        <label>Expira</label>
                                                        <select name="cardDate[]" id="cardMonth">
                                                            <option></option>
                                                            <?php foreach(range(1, 12) as $month){?>
                                                            <option value="<?= $month;?>"><?= $month;?></option>
                                                            <?php }?>
                                                        </select>
                                                        <select name="cardDate[]" id="cardYear">
                                                            <option></option>
                                                            <?php foreach(range(date("Y"), date("Y") + 20) as $month){?>
                                                            <option value="<?= $month;?>"><?= $month;?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <label>Código de Segurança</label>
                                                        <input type="text" maxlength="3" name="cardCvv" id="cardCcv">
                                                    </div>
                                                    <div id="finalizar">
                                                        <input type="button" value="Financiar projeto">
                                                    </div>

                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                </li>
                                <li>
                                    <input type="radio" id="boleto" name='pagamento'>
                                    <label for="boleto" class="escolha">
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                    Pagamento com boleto
                                    <div class="efetuarPagamento" id="opBoleto">
                                    
                                    </div>
                                </label>
                                </li>
                            </ul>
                        </div>
                    </div>


                    <div id="areaPlataforma">

                        <div id="aviso">
                            <h2>
                                <i class="fa fa-info-circle" aria-hidden="true"></i> O Talaka não é uma loja.
                                <br>
                                <span>
                            É uma forma de incentivo à cultura
                        </span>
                            </h2>
                            <p>
                                Kickstarter does not guarantee projects or investigate a creator's ability to complete their project. It is the responsibility of the project creator to complete their project as promised, and the claims of this project are theirs alone.
                            </p>
                            <a href="#">
                        Learn more about accountability
                    </a>

                            <h2>
                                <i class="fa fa-question-circle" aria-hidden="true"></i> Dúvidas frequentes</h2>
                            <ul id="faq">
                                <a href="#">
                                    <li>
                                        Como faço para apoiar?
                                    </li>
                                </a>
                                <a href="#">
                                    <li>
                                        Quando a fatura chega ao meu cartão?
                                    </li>
                                </a>
                                <a href="#">
                                    <li>
                                        O que outras pessoas podem ver sobre minha doação?
                                        <span>
                                    dois
                                </span>
                                    </li>
                                </a>
                                <a href="#">
                                    <li>
                                        Se o projeto for financiado, como eu pego minha recompensa?
                                    </li>
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="bg"></div>

            </div>
        </main>
