<?php
defined("System-access") or header('location: /error');
?>
<main>
    <div id="cadastroCampanha">
        <div class="wrapper">
            <ul>
                <li>
                    Informações Básicas
                </li>
                <li>
                    Financiamento
                </li>
                <li>
                    Redes Sociais
                </li>
                <li>
                    Recompensas
                </li>
                <!--<li>-->
                <!--    Revisão de dados-->
                <!--</li>-->
            </ul>
            
            <div id="formArea">
                <div class="formInputs">
                    <form method='post' id='formCadProj' enctype='multipart/form-data'>
                        <div id="stepBasico">
                            <p class="step">
                                Informações Básicas
                                <b>primeiro passos da campanha </b>
                            </p>
                            <p>
                                Nesta etapa você irá falar as informações mais importantes da campanha do seu quadrinho como por exemplo o nome e a descrição dele. Preste bastante atenção na hora de preencher os campos.
                            </p>
                            <div class="cadaCampo">
                                <label class="label" for='titulocampanha'>
                                    <p>
                                        Título da Campanha
                                    </p>
                                    <p>
                                        Escreva o nome de seu projeto. Pense em bem como ele irá se chamar para que todos possam lembrar dele facilmente!
                                    </p>
                                </label>
                                <div class="input">
                                    <input type="text" id='titulocampanha' name='titulocampanha' placeholder='Título do seu projeto' maxlength="40">
                                    <p>
                                        No máximo de 40 caracteres
                                    </p>
                                </div>    
                            </div>
                            
                            <div class="cadaCampo">
                                <label class="label" for='resumocampanha'>
                                    <p>
                                        Resumo do Projeto
                                    </p>
                                    <p>
                                        O resumo é importante pois é o que pode despertar a atenção de alguém para financiar o seu projeto. Então escreva com muito carinho e vontade mas claro sem entregar todo o ouro. 
                                    </p>
                                </label>
                                <div class="input">
                                    <input type="text" id='resumocampanha' name='resumocampanha'  placeholder='Descreva seu projeto' maxlength="280">
                                    <p>
                                        No máximo, 300 caracteres
                                    </p>
                                </div>    
                            </div>
                            
                            <div class="cadaCampo">
                                <label class="label" for='descricaocampanha'>
                                    <p>
                                        Descrição do Projeto
                                    </p>
                                    <p>
                                        Aqui você irá descrever todo o conteúdo do seu projeto, é o seu momento de brilhar. Conte a história do seu quadrinho, como você deseja realizar a campanha, qual material que pretende usar e muito mais. Seja claro no texto escrito para que as pessoas se interessem por seu projeto.
                                    </p>
                                </label>
                                <div class="input">
                                    <textarea id='descricaocampanha' name='descricaocampanha'></textarea>
                                </div>    
                            </div>
                            <div class="cadaCampo">
                                <label class="label" for='imagemprojeto'>
                                    <p>Imagem do Projeto</p>
                                    <p>Imagem que será disponibilizada como capa para o seu projeto! Use uma foto que chame a atenção dos usuários!</p>
                                </label>
                                <div class="input">
                                    <input type="file" id='imagemprojeto' name='imagemcampanha'>
                                </div>
                            </div>
                            <div class="cadaCampo">
                                <label class="label" for='imagemcapa'>
                                    <p>Capa do Projeto (opcional)</p>
                                    <p>Imagem que será disponibilizada como capa para o seu projeto! Use uma foto chamativa e chame a atenção dos usuários!
                                    <br>
                                        <i>Se não houver capa, não fique preocupado! Usaremos a imagem do projeto para criar uma capa incrível para sua campanha.</i>
                                    </p>
                                </label>
                                <div class="input">
                                    <input type="file" id='imagemcapa' name='imagemcapa'>
                                </div>
                            </div>
                            <div class="cadaCampo">
                                <label class="label" for='categoriacampanha'>
                                    <p>
                                        Categoria da história
                                    </p>
                                    <p>
                                        Escolha o eixo que melhor se enquadra o tipo de quadrinho que você está criando! Isso ajuda a filtrar os gostos pessoais dos usuários e na busca por novas histórias.
                                    </p>
                                </label>
                                <div class="input">
                                    <select id='categoriacampanha' name='categoriacampanha'>
                                        <option value="1" >Ação</option>
                                        <option value="2" >Biográfico</option>
                                        <option value="3" >Comédia</option>
                                        <option value="4" >Drama</option>
                                        <option value="5" >Fantasia</option>
                                        <option value="6" >Ficção Científica</option>
                                        <option value="7" >Literatura</option>
                                        <option value="8" >Super-Herói</option>
                                        <option value="9" >Terror</option>
                                        <option value="10" >Tirinha</option>
                                    </select>
                                </div>
                            </div>
                            <div class="cadaCampo">
                                <label class="label" for='campotags'>
                                    <p>Tags principais</p>
                                    <p>
                                        Descreva as melhores tags para facilitar a busca da sua campanha na plataforma! Conte com características como preto e branco, mangás, tiroteio, como quiser!
                                    </p>
                                </label>
                                <div class="input" id="addTag">
                                    <input type="text" name="tags" id='campotags'>
                                    <input type="button" value="Adicionar">
                                    <p>
                                        Separe as tags por vírgula, exemplo: Aventura romana, pós-apocalíptico, Aliens
                                    </p>
                                    <ul id="categorias">
                                        
                                    </ul>
                                    
                                </div>
                            </div>
                            <!--<div class="visualizar">-->
                            <!--    <input type="button" id="visualizar" value="Visualizar campanha">-->
                            <!--</div>-->
                            <!--<div class="cadaPasso">-->
                            <!--    <input type="button" id="cancelar" value="Cancelar">-->
                            <!--    <input type="button" id="continuar" value="Continuar">-->
                            <!--</div>-->
                        </div>
                        <div id="stepFinanciamento">
                            <p class="step">
                                Financiamento
                                <b>Estabeleça suas metas</b>
                            </p>
                            <p>
                                Nesta etapa você irá informar quanto é necessário para que sua campanha vire realidade e quantos dias vão ser necessário para que ela seja financiada. Preencha com bastante atenção pois estas informações não poderão ser alteradas futuramente.
                            </p>
                            <div class="cadaCampo">
                                <label class="label" for='metaproposta'>
                                    <p>Meta proposta</p>
                                    <p>Quanto você precisa para retirar sua ideia do papel?</p>
                                </label>
                                <div class="input">
                                    <input type="number" id='metaproposta' name='metaproposta'>
                                </div>
                            </div>
                            <div class="cadaCampo">
                                <label class="label" for='tempoestimado'>
                                    <p>Tempo estimado</p>
                                    <p>
                                        Quanto tempo de campanha dentro da plataforma? Lembrando que, após a data estipulada não haverá possibilidade de continuidade do projeto na plataforma.
                                    </p>
                                </label>
                                <div class="input">
                                    <input type="date" id='tempoestimado' name='tempoestimado' placeholder="Mínimo de 30 dias, máximo de 90">
                                    <p>
                                        Término da campanha previsto para: __/__/____
                                    </p>
                                </div>
                            </div>
                            <!--<div class="visualizar">-->
                            <!--    <input type="button" id="visualizar" value="Visualizar campanha">-->
                            <!--</div>-->
                            <!--<div class="cadaPasso">-->
                            <!--    <input type="button" id="cancelar" value="Cancelar">-->
                            <!--    <input type="button" id="continuar" value="Continuar">-->
                            <!--</div>-->
                        </div>
                        <div id="stepTime">
                            <p class="step">
                                Redes Sociais
                                <b>conhecer mais a sua campanha</b>
                            </p>
                            <p>
                                Fale mais sobre as mentes pensantes por trás da campanha, além dos time que compõe todo o trabalho, dentro e fora do projeto!
                            </p>
                            <div class="cadaCampo">
                                <label class="label" for='facebook'>
                                    <p>Página no Facebook</p>
                                    <p>
                                        Sua campanha possui informações no Facebook? Se sim, insira o link no campo ao lado!
                                    </p>
                                </label>
                                <div class="input">
                                    <input type="text" id='facebook' name='facebook'>
                                </div>
                            </div>
                            <div class="cadaCampo">
                                <label class="label" for='video'>
                                    <p>Vídeo da campanha</p>
                                    <p>
                                        Você produziu um vídeo para o seu projeto? Que incrível! Insira o link ao lado para os apoiadores conhecerem.
                                    </p>
                                </label>
                                <div class="input">
                                    <input type="text" id='video' name='video'>
                                </div>
                            </div>
                            <div class="cadaCampo">
                                <label class="label" for='instagram'>
                                    <p>Campanha no Instagram</p>
                                    <p>
                                        É o tipo de autor com postagens no Stories? Sensacional! Insira o link ao lado para conhecermos mais o dia a dia do seu trabalho.
                                    </p>
                                </label>
                                <div class="input">
                                    <input type="text" id='instagram'  name='instagram'>
                                </div>
                            </div>
                            <p class="step">
                                Coautores
                                <b>Autores envolvidos</b>
                            </p>
                            <p>Você está desenvolvendo esse projeto com outros autores? Nesta etapa podemos conhecer um pouco mais as outras mentes por trás do projeto</p>
                            <div class="cadaCampo">
                                <label class="label" for='coautores'>
                                    <p>
                                        Coautor
                                    </p>
                                    <p>
                                        Insira aqui os perfis dos dos outros ilustradores, autores, roteiristas e 
                                        idealizadores da sua campanha, afinal, toda ajuda é bem-vinda.
                                    </p>
                                </label>
                                    <div class="input" id="addAutor">
                                        <input type="text" id='coautores' name='coautores'>
                                        <input type="button" value="Adicionar">
                                        <ul id="categorias">
                                        </ul>
                                    </div>
                                </div>
                                <!--<div class="visualizar">-->
                                <!--    <input type="button" id="visualizar" value="Visualizar campanha">-->
                                <!--</div>-->
                                <!--<div class="cadaPasso">-->
                                <!--    <input type="button" id="cancelar" value="Cancelar">-->
                                <!--    <input type="button" id="continuar" value="Continuar">-->
                                <!--</div>-->
                            </div>
                            <div id="stepFinanciamento">
                            <p class="step">
                                Finalizar
                                <b>Confira os Dados</b>
                            </p>
                            <!--<p class="step">-->
                            <!--    Recompensas-->
                            <!--    <b>Retribua seus fãs</b>-->
                            <!--</p>-->
                            <!--<p>-->
                            <!--    Nesta etapa você poderá cadastrar as recompensas que as pessoas irão receber quando financiarem seu projeto. O ideal é que você inicie com algumas recompensas estabelecidas mas é possível cadastrar depois.-->
                            <!--</p>-->
                            <!--<div class="cadaCampo">-->
                            <!--    <label class="label" for='recompensa'>-->
                            <!--        <p>Valor da recompensa</p>-->
                            <!--        <p>Quanto o usuário poderá oferecer?</p>-->
                            <!--    </label>-->
                            <!--    <div class="input">-->
                            <!--        <input type="number" id='recompensa' name='recompensa'>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <!--<div class="cadaCampo">-->
                            <!--    <label class="label" for='premio'>-->
                            <!--        <p>Prêmio</p>-->
                            <!--        <p>-->
                            <!--            Defina o que você pode oferecer ao investir no seu projeto, de acordo com o valor doado.-->
                            <!--        </p>-->
                            <!--    </label>-->
                            <!--     <div class="input" id="addAutor">-->
                            <!--            <input type="text" id='premio' name='premio'>-->
                            <!--            <input type="button" value="Adicionar">-->
                            <!--            <div class='cadaRecompensa'>-->
                            <!--                <h3>-->
                            <!--                    <b>R$ 50,00</b>-->
                            <!--                    - Título da recompensa</h3>-->
                            <!--                    <span>-->
                            <!--                        descrição da campanha-->
                            <!--                    </span>-->
                            <!--            </div>-->
                            <!--            <div class='cadaRecompensa'>-->
                            <!--                <h3>-->
                            <!--                    <b>R$ 50,00</b>-->
                            <!--                    Título da recompensa</h3>-->
                            <!--                    <span>-->
                            <!--                        descrição da campanha-->
                            <!--                    </span>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--</div>-->
                            <!--<div class="visualizar">-->
                            <!--    <input type="button" id="visualizar" value="Visualizar campanha">-->
                            <!--</div>-->
                            <div class="cadaPasso">
                                <input type="button" id="cancelar" value="Cancelar">
                                <input type="button" id="continuar" value="Finalizar">
                            </div>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>