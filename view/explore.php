<?php
//defined("System-access") or header('location: /error');
?>

<?php
//var_dump($data);

for($i = 0; $i < count($data) - 3; $i++) {
    $project = new Project($data["d".$i]);
    var_dump($project);
}
?>
<main>
    <div id="exploreHeader">
        <div class="wrapper">
            <h1><i class="fa fa-commenting" aria-hidden="true"></i> <br> Explore o Talaka</h1>
            <h2>Conheça os incríveis projetos criados pelos quadrinistas nacionais</h2>
        </div>
    </div>
    <section id="results">
        <div class="wrapper">
            <aside id="filter">
                <div class="filterSection" id="filterCampaign">
                    <h3>Tipos de Campanhas</h3>
                    <ul>
                        <li>Todas as campanhas</li>
                        <li>Campanhas Tudo ou Nada</li>
                        <li>Campanhas Flex</li>
                    </ul>
                </div>
                
                <div class="filterSection" id="filterTag">
                    <h3>Categorias</h3>
                    <ul>
                        <li>Todas as campanhas</li>
                        <li>Ação</li>
                        <li>Biográfico</li>
                        <li>Comédia</li>
                        <li>Drama</li>
                        <li>Esporte</li>
                        <li>Ficção Científica</li>
                        <li>Literatura</li>
                        <li>Super-Herói</li>
                        <li>Terror</li>
                        <li>Tirinha</li>
                    </ul>
                </div>
                
                 <div class="filterSection" id="filterDate">
                    <h3>Data de Término</h3>
                    <ul>
                       <li>Todos</li>
                       <li>Perto do fim</li>
                       <li>Recentes</li>
                    </ul>
                </div>
            </aside>
            <div class="resultsProject" id="listProjects">
                <div class="sortBy">
                    Organizar por: 
                    <select>
                        <option>Popularidade</option>
                        <option>Novos Autores</option>
                        <option>Novos Projetos</option>
                        <option>Mais comentados</option>
                        <option>Perto de mim</option>
                    </select>
                    <i class="fa fa-list" aria-hidden="true" id="list" title="Visualização em Lista"></i>
                </div>
                    <?php foreach($project as $proj){ 
                            $proj = new Project($proj);
                            $aux = (($proj->collected) * 100) / $proj->meta;
                            $percent = ( $aux > 100 )? 100 : $aux ;
                    ?>
                    <div class="projectsList">
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
                    </div>
                    <?php } ?>
            </div>
        </div>
        <a href="#"><div id="moreProjects"> Carregar mais campanhas </div></a>
    </section>
</main>
