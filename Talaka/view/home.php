<?php
defined("System-access") or header('location: /error');
use Talaka\Models\Project;
use Talaka\Controllers\PageController;
?>

    <main id="linkMain">
        <script src="https://cdn.rawgit.com/kottenator/jquery-circle-progress/1.2.0/dist/circle-progress.js"></script>
        <div id="carousel">
            <div id="carouselWrapper">

                <div class="eachCarousel carOff atual" id="helloWrapper">
                    <div class="wrapper">
                        <div id="logo"></div>
                        <p>Conheça a plataforma de financiamento coletivo de quadrinhos nacionais</p>
                        <ul>
                            <li>
                                <a href='/criar-campanha'>Criar campanha</a></li>
                            <a href="#howItWorks">
                                <li>O que é financiamento coletivo?</li>
                            </a>
                        </ul>
                    </div>
                </div>
                <?php foreach($carousel as $key => $crsl){
                    $crsl = new Project((array) $crsl );
                    $aux = (($crsl->collected) * 100) / $crsl->meta;
                    $percent = ( $aux > 100 )? 100 : $aux ;
                ?>

                <div class="eachCarousel carOff <?= ($key == (count($carousel) - 1))? "last" : "" ;?>">
                    <div class="eachCarouselCover" style="background-image:url(<?= base_url; ?>proj-img/<?= $crsl->imgB ; ?>)"></div>
                    <div class="wrapper">
                        <div class="carouselLeft">
                            <div class="headerProjectCover" style="background-image:url(<?= base_url; ?>proj-img/<?= $crsl->img ; ?>)"></div>
                            <a href="https://<?= $_SERVER['HTTP_HOST'].'/campanha/'. str_replace(" ","+",$crsl->title); ?>"> <i class="fa fa-heart-o" aria-hidden="true"></i> Conheça o projeto </a>
                        </div>
                        <div class="carouselRight">
                            <h1><?= $crsl->title; ?></h1>

                            <div class="projectInfos">
                                <div class="projectGoal">
                                    
                                    <!--<?= round($percent); ?>%-->
                                    
                                    
                                    
                                    
                                    </div>
                                <div class="projectDescription">
                                    <p>
                                        <?= $crsl->ds ;  ?>
                                    </p>
                                </div>
                            </div>

                            <div class="authors">
                                <h2> Autores</h2>
                                <ul>
                                    <a href="/perfil/<?= $crsl->creator->username;?>">
                                        <li data-title="<?= $crsl->creator->name; ?>" style="background-image:url(<?= base_url; ?>user-img/<?= $crsl->creator->img ; ?>)">
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        </li>
                                    </a>
                                    <?php if($crsl->coauthor !== "no"){ 
                                    array_map(function($coauthor){
                                        $co = explode(":",$coauthor);
                                    ?>
                                    <a href="/perfil/<?= $co[2]; ?>">
                                        <li data-title="<?= $co[0]; ?>" style="background-image:url(<?= base_url; ?>user-img/<?= $co[1] ; ?>)" ></li>
                                    </a>
                                    <?php
                                    },explode(",",$crsl->coauthor)) ;
                                    }?>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <?php } ?>
            </div>
            <div id="carouselPosition">
                <ul>
                    <li class="selected"></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            <div id="carouselTimer">
                <div id="progress"></div>
            </div>
        </div>

        <section id="indexProjects">
            <div class="wrapper">
                <ul id="pTypes">
                    <li data-type="pop">
                        <i class="fa fa-star-o" aria-hidden="true"></i> Projetos populares
                    </li>
                    <li data-type="cmt">
                        <i class="fa fa-commenting-o" aria-hidden="true"></i> Projetos mais comentados
                    </li>
                    <li data-type="new">
                        <i class="fa fa-plus-square-o" aria-hidden="true"></i> Novos projetos
                    </li>
                    <li data-type="aut">
                        <i class="fa fa-user-o" aria-hidden="true"></i> Novos autores
                    </li>
                    <?php if(PageController::is_logged()){ ?>
                        <li>
                            <i class="fa fa-map-o" aria-hidden="true"></i> Populares Perto de você
                        </li>
                    <?php } ?>    
                    <li id="seeAll"><a href="/explore">Ver todos</a></li>
                </ul>

                <div id="listProjects">
                    
                    <?php foreach($project as $proj){ 
                            $proj = new Project($proj);
                            $aux = (($proj->collected) * 100) / $proj->meta;
                            $percent = ( $aux > 100 )? 100 : $aux ;
                    ?>
                    
                    
                        <div class="eachProject" onclick="toProject('<?= urlencode($proj->title);?>')">
                            <div class="eachProjectCover" style="background-image:url(<?= base_url; ?>proj-img/<?= $proj->img; ?>)" >
                                <!--<a href="/perfil/<?php /*$proj->creator->username*/?>" >-->
                                    <div class="eachProjectOwner" data-title="<?= $proj->creator->name ;?>" style="background-image:url(<?= base_url; ?>user-img/<?= $proj->creator->img; ?>)">
                                    </div>
                                <!--</a>-->
                            </div>
                            <div class="eachProjectInfo">
                                <div class="eachProjectTag">
                                    <a href="/explore/<?= urlencode($proj->category);?>/1">
                                        <i class="fa fa-tag" aria-hidden="true"></i><span> <?= $proj->category ;?> </span>
                                    </a>
                                    <h2><?= $proj->title ;?></h2>
                                    <p>
                                        <?= (strlen($proj->ds) > 300)? substr($proj->ds,0,300)." (...)" : $proj->ds ;?>
                                    </p>

                                    <div class="goal">
                                        <p><span>R$ <?= $proj->collected ;?>,00</span> acumulados</p>
                                        <div class="progressbar">
                                            <div class="value" style="width: <?= $percent; ?>%" ></div>
                                        </div>
                                        <ul>
                                            <li><?= round($aux); ?>%</li>
                                            <li>Aberto até <span><?= implode("/", array_reverse(explode("-",$proj->dtF)) ); ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php  } ?>
                    
                </div>
            </div>
        </section>

        <section id="howItWorks">
            <div class="wrapper">
                <i class="fa fa-commenting" aria-hidden="true"></i>
                <h1>O que é <b>financiamento coletivo?</b> </h1>

                <div class="worksArea">
                    <div class="worksInfo">
                        <p><b>Financiamento coletivo</b> nada mais é do que o ato de <b>financiar</b> com algum valor projetos de artistas ou grupos que você acredita que merecem ganhar vida. E caso esses projetos cumpram suas metas, com a sua ajuda, eles finalmente podem sair do papel!</p>
                        <p> O financiamento coletivo no <b>Talaka</b> dá chance para que os novos artistas se lancem no mercado e os já conhecidos possam criar novos materiais com ajuda dos seus queridos fãs.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section id="categories">
            <div class="wrapper">
                <i class="fa fa-tags" aria-hidden="true"></i>
                <h1>Conheça as categorias!</h1>
                <h2>
                    Saiba um pouco mais sobre as categorias disponíveis no Talaka.
                </h2>
                <!--<ul id="catIcons">-->
                <!--    <?php-->
                <!--    foreach ($cats as $cat) {-->
                <!--    ?>-->
                <!--        <li data-link="<?=$cat->nm;?>">-->
                <!--            <?= $cat->nm; ?>-->
                <!--        </li>-->
                <!--    <?php-->
                <!--    }-->
                <!--    ?>-->
                <!--</ul>-->
                <?php
                    foreach ($cats as $key=>$cat) {
                ?>
                    <div class="catInfo <?= explode("d",$key)[1] == (count($cats) - 1)? "last" : ((explode("d",$key)[1] == 0) ? "atual" :"");?>">
                        <div class='catCover' data-link="<?=$cat->nm;?>" style='background-image:url(/Talaka/resources/img/<?= $cat->img; ?>)' ></div>
                            <h3> <?= $cat->nm; ?> </h3>
                            <p>
                                <?= $cat->ds; ?>
                            </p>
                            <a href="/explore/<?= urlencode($cat->nm);?>/1">Explorar categoria de <?= $cat->nm ?></a>
                    </div>
                <?php
                }
                ?>
                
                
            </div>
        </section>
    </main>