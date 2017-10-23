<?php
defined("System-access") or header('location: /error');
use Talaka\Models\Project;
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
                            <i>R$</i> <?= $proj->collected ?>,00
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
                                <b><?= $proj->visit;?></b>
                                investidores
                            </li>
                            
                            <li>
                                <b><?= round($percent);?>%</b>
                                arrecadado
                            </li>
                            
                            <li>
                                <b><?= round( ( strtotime($proj->dtF) - strtotime(date("Y-m-d")) ) / (60 * 60 * 24) ); ?></b>
                                dias restando
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
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Projeto criado por:
                        <a href=""><?= $proj->creator->name ;?></a>
                    </h2>
                    
                    <?php if($proj->coauthor !== "no"){?>
                    <div class="coauthor">
                        <h2>
                            <i class="fa fa-users" aria-hidden="true"></i> 
                            Co-Autores: 
                        </h2><ul id="coauthor">
                        <?php array_map(function($coauthor){
                                $co = explode(":",$coauthor);
                            ?>
                            <li data-title="<?= $co[0]; ?>" style="background-image:url(<?= base_url; ?>user-img/<?= $co[1] ; ?>)" ></li>
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
                                        <i class="fa fa-tag" aria-hidden="true"></i> <?= $t[1];//Name?>
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
                    <li data-tab="pc" >Campanha</li>
                    <li data-tab="pg" >Galeria</li>
                    <li data-tab="pa" >Atualizações</li>
                    <li data-tab="" >Apoiadores <b>(30)</b></li>
                    <li data-tab="" >Comentários <b>(30)</b></li>
                    <li data-tab="" >Comunidade</li>
                </ul>
                
                <div data-tab="pc" class="tabProject tabAtual" id="projetoConteudo">
                    <h1>
                        Conheça o projeto <?= $proj->title ?> 
                    </h1>
                    <p>
                        <?= $proj->resume ?>
                    </p>
                </div>
                <div data-tab="pg" class="tabProject" id="projetoGaleria">
                    <figure>
                        <figcaption>
                            Confira imagens da campanha <?= $proj->title ?>
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
                                    <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                    12 Comentários</li>
                                <li><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
                                Curtir</li>
                                <li>
                                    <i class="fa fa-hashtag" aria-hidden="true"></i>
                                    12 Interações</li>
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
    
    <!--<section id="projetosRelacionados">-->
    <!--    <div class="wrapper">-->
    <!--        <h3>Projetos relacionados</h3>-->
    <!--    </div>-->
    <!--</section>-->

</main>