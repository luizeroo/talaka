<?php
defined("System-access") or header('location: /error');
use Talaka\Controllers\PageController;
?>
<main id="linkMain">
    <div id="fullCampaign">
        <div id="bg">
        </div>
        <div id="txt">
            <h1>Talaka é uma plataforma para incentivo de quadrinhos nacionais</h1>
            <h2>
                Inicie sua campanha. Incentive sua arte.
            </h2>
            <a href="<?= PageController::is_logged() ? "/cadastrar-campanha" : "/signin" ;?>"><input type="button" value="Começar campanha"></a>
        </div>
    </div>
    <div id="comecarCampanha">
        <section>
            <div class="wrapper">
                <div id="informacoesCampaign" class="ladoGrande" style='width:100%; text-align:center;'>
                    <h2>Bem-vindo<?= ($_SESSION["user"])?", " . $_SESSION["user"]["name"] : "" ?>!</h2>
                    <h3>
                        Nós do Talaka vamos te auxiliar na criação da sua campanha! Então, vamos lá!
                    </h3>  
                    <p>
                        Nesta página você irá receber algumas dicas para ter noção do que você precisa para começar a campanha de financiamento do seu quadrinh e transformar o seu sonho em realidade.
                    </p>
                    <p>
                        Então leia atentamente as dicas abaixo para que sua campanha seja um sucesso e todos tenham a oportunidade de conhecer a sua obra! 
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </section>  
        
        <section>
            <div class="wrapper">
                <div id="informacoesCampaign" class="ladoGrande">
                    <h2><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                    Planejamento e Orçamento</h2>
                    <h3>
                       É vital fazer o planejamento da campanha de financiamento coletivo antes de colocar o seu projeto no ar.
                    </h3>  
                    <p>
                        O ideal é que antes de você cadastrar o seu projeto no Talaka e que você já tenha se planejado anteriormente para que durante a realização da sua campanha, não acontece imprevistos(caso aconteça você já vai estar preparado). Esse planejamento não é só para enquanto a campanha estiver rolando mas sim para antes dela iniciar e para quando ela terminar. Por isso busque referências em outros projetos que já foram financiados na plataforma, pense no quanto você irá pedir e como você irá utilizar aquela grana, como o orçamento será dividido, exemplo: quantos porcentos vai para o Talaka, quanto você pretende gastar na impressão e quanto nas recompensas? E se o seu projeto passar do estimado, o que irá fazer com esse valor a mais? Aumentar o número de páginas? Pense em como irá divulgar o seu projeto, quais redes sociais irá utilizar além da plataforma, se você irá fazer um vídeo, imagens comemorativas.
Tudo isso é necessário para que durante a sua campanha você não tenha nenhum problema e assim o seu projeto será um sucesso e vai se tornar realidade.

                    </p>
                </div>
                
                <div id="imgCampaign2" class="ladoPequeno" style='background-image:url(/Talaka/resources/img/planejamento.png)'></div>
                <div class="clear"></div>
            </div>
        </section>
         <section>
            <div class="wrapper">
                <div id="imgCampaign" class="ladoPequeno" style='background-image:url(/Talaka/resources/img/pre_campanha.png)'></div>
                
                <div id="informacoesCampaign" class="ladoGrande">
                    <h2>
                        <i class="fa fa-map-signs" aria-hidden="true"></i>
                        Primeiros passos: Pré-campanha</h2>
                    <h3>
                        Nós do Talaka vamos te auxiliar na criação da sua campanha! Então, vamos lá!
                    </h3>  
                    <p>
                        A preparação para o lançamento da campanha é muito semelhante ao do planejamento. Mas com algumas ideias já estabelecidas, pense em que tipo de pessoas você ira divulgar o seu projeto, pense na abordagem que será utilizada para o público que já lhe conhece e o que ainda não, como será feito o vídeo, quais as recompensas que você irá fazer e quanto tempo elas irão demorar para serem realizadas. Pense também no quadrinho do seu projeto, ele é o mais importante, e como você irá trabalhar nele.

                    </p>
                </div>
                <div class="clear"></div>
            </div>
        </section>  
        
        <section>
            <div class="wrapper">
                <div id="informacoesCampaign" class="ladoGrande">
                    <h2><i class="fa fa-clock-o" aria-hidden="true"></i>Durante a campanha</h2>
                    <h3>
                        Nós do Talaka vamos te auxiliar na criação da sua campanha! Então, vamos lá!
                    </h3>  
                    <p>
                        É aqui que o filho chora e a mãe não vê! Chegado o grande dia do lançamento da sua campanha, o ideal é que até agora você já esteja com tudo planejado. Então divulgue nas redes sociais mesmo instante que sair na plataforma, entre em contato com as pessoas que você já escolheu para que elas já apoiem no primeiro dia, informe quanto tempo estará no ar e até quando elas poderão ajudar, crie metas diárias para que você consiga alcançar o valor pedido e que consiga até ultrapassar. 
Esse é o período que você deve estar mais atento e preparado.

                    </p>
                </div>
                
                <div id="imgCampaign2" class="ladoPequeno" style='background-image:url(/Talaka/resources/img/durante_campanha.png)'></div>
                <div class="clear"></div>
            </div>
        </section> 
        
        <section>
            <div class="wrapper">
                <div id="imgCampaign" class="ladoPequeno" style='background-image:url(/Talaka/resources/img/pos_campanha.png)'></div>
                
                <div id="informacoesCampaign" class="ladoGrande">
                    <h2>
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        Últimos passos: Pós-campanha</h2>
                    <h3>
                        Nós do Talaka vamos te auxiliar na criação da sua campanha! Então, vamos lá!
                    </h3>  
                    <p>
                       Se você chegou aqui e tudo deu certo, meus parabéns mas se caso algo tenha acontecido, não desista e se planeje melhor. É importante que após encerrar o período da sua campanha você ainda mantenha contato com todos aqueles que se comunicou durante ela, para que eles fiquem atentos a suas atualizações na plataforma envolvendo o envio do material e recompensas criadas. Ao receber o seu quadrinho no prazo estabelecido, pode ter certeza que as pessoas ficaram muito satisfeitas e dispostas a lhe ajudar mais uma vez caso seja necessário.
                    </p>
                </div>
                <div class="clear"></div>
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
    </div>
</main>