<?php
defined("System-access") or header('location: /error');
use Talaka\Models\Project;
?>
<?php

$proj = new Project($project);
// var_dump($proj);
?>
<main>
    <div id="headerProject" style="background-image:"></div>
    <!-- Página de Projeto -->
    <section id="infosProject"> 
        <div class="wrapper">
                <div id="projetoCapa"></div>
        </div>
    </section>
</main>