<?php
defined("System-access") or header('location: /error');
?>
    <main>
        <div id="carousel">
            <div id="carouselWrapper">

                <div class="eachCarousel" id="helloWrapper">
                    <div class="wrapper">
                        <div id="logo"></div>
                        <p>Conheça a plataforma de financiamento coletivo de quadrinhos nacionais</p>
                        <ul>
                            <li>Criar campanha</li>
                            <a href="#howItWorks">
                                <li>O que é financiamento coletivo?</li>
                            </a>
                        </ul>
                    </div>
                </div>
                <?php foreach($carousel as $crsl){
                    $crsl = new Project((array) $crsl );
                    $aux = (($crsl->collected) * 100) / $crsl->meta;
                    $percent = ( $aux > 100 )? 100 : $aux ;
                ?>

                <div class="eachCarousel">
                    <div class="eachCarouselCover" style="background-image:url(proj-img/<?= $crsl->imgB ; ?>)"></div>
                    <div class="wrapper">
                        <div class="carouselLeft">
                            <div class="headerProjectCover" style="background-image:url(proj-img/<?= $crsl->img ; ?>)"></div>
                            <a href="#"> <i class="fa fa-heart-o" aria-hidden="true"></i> Conheça o projeto </a>
                        </div>
                        <div class="carouselRight">
                            <h1><?= $crsl->title; ?></h1>

                            <div class="projectInfos">
                                <div class="projectGoal"><?= round($percent); ?>%</div>
                                <div class="projectDescription">
                                    <p>
                                        <?= $crsl->ds ;  ?>
                                    </p>
                                </div>
                            </div>

                            <div class="authors">
                                <h2> Autores</h2>
                                <ul>
                                    <li title="<?= $crsl->creator; ?>" style="background-image:url(user-img/<?= $crsl->imgU ; ?>)">
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </li>
                                    <?php if($crsl->coauthor !== "no"){ 
                                    array_map(function($coauthor){
                                        $co = explode(":",$coauthor);
                                    ?>
                                    <li title="<?= $co[0]; ?>" style="background-image:url(user-img/<?= $co[1] ; ?>)" ></li>
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
                    <li></li>
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
                    <li>
                        <i class="fa fa-map-o" aria-hidden="true"></i> Populares Perto de você
                    </li>
                    <li><a href="#">Ver todos</a></li>
                </ul>

                <div id="listProjects">
                    
                    <?php foreach($project as $proj){ 
                            $proj = new Project($proj);
                            $aux = (($proj->collected) * 100) / $proj->meta;
                            $percent = ( $aux > 100 )? 100 : $aux ;
                    ?>
                    
                    <a href="https://<?= $_SERVER['HTTP_HOST'].'/project/'.$proj->id; ?>" >
                        <div class="eachProject">
                            <div class="eachProjectCover" style="background-image:url(/proj-img/<?= $proj->img; ?>)" >
                                <div class="eachProjectOwner" title="<?= $proj->creator ;?>" style="background-image:url(/user-img/<?= $proj->imgU; ?>)"></div>
                            </div>
                            <div class="eachProjectInfo">
                                <div class="eachProjectTag">
                                    <a href="#">
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
                    </a>
                    <?php } ?>
                    
                </div>
            </div>
        </section>

        <section id="howItWorks">
            <div class="wrapper">
                <i class="fa fa-commenting" aria-hidden="true"></i>
                <h1>O que é <b>financiamento coletivo?</b> </h1>

                <div class="worksArea">
                    <div class="lozenge"></div>
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
                <ul id="catIcons">
                    <?php
                    foreach ($cats as $cat) {
                    ?>
                        <li>
                            
                            <?= $cat->nm; ?>
                            
                        </li>
                    <?php
                    }
                    ?>
                </ul>
                <div id="catInfo">
                    <div class="catCover"></div>
                    <h3>Ficção Científica</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse cursus iaculis metus et volutpat. Praesent sit amet sollicitudin erat, et molestie turpis. Curabitur tempor ipsum quis placerat commodo. Vestibulum lorem magna, consequat eu efficitur in, pharetra ac leo. Donec luctus, felis non ullamcorper sollicitudin, diam leo accumsan nisl, id mollis justo enim et nisl. Donec sed dapibus magna, eget gravida libero. Etiam rutrum mi eget justo molestie, ac viverra lorem laoreet.
                    </p>

                    <a href="#">Explorar categoria</a>
                </div>
            </div>
        </section>
    </main>