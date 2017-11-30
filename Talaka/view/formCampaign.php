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
                    <div id="stepBasico">
                        <p class="step">
                            Informações Básicas
                            <b>primeiro passos da campanha </b>
                        </p>
                        <p>
                            Nesta etapa você irá falar as informações mais importantes da campanha do seu quadrinho como por exemplo o nome e a descrição dele. Preste bastante atenção na hora de preencher os campos.
                        </p>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>
                                    Título da Campanha
                                </p>
                                <p>
                                    Escreva o nome de seu projeto. Pense em bem como ele irá se chamar para que todos possam lembrar dele facilmente!
                                </p>
                            </div>
                            <div class="input">
                                <input type="text">
                            </div>    
                        </div>
                        
                        <div class="cadaCampo">
                            <div class="label">
                                <p>
                                    Resumo do Projeto
                                </p>
                                <p>
                                    O resumo é importante pois é o que pode despertar a atenção de alguém para financiar o seu projeto. Então escreva com muito carinho e vontade mas claro sem entregar todo o ouro. 
                                </p>
                            </div>
                            <div class="input">
                                <input type="text">
                            </div>    
                        </div>
                        
                        <div class="cadaCampo">
                            <div class="label">
                                <p>
                                    Descrição do Projeto
                                </p>
                                <p>
                                    Aqui você irá descrever todo o conteúdo do seu projeto, é o seu momento de brilhar. Conte a história do seu quadrinho, como você deseja realizar a campanha, qual material que pretende usar e muito mais. Seja claro no texto escrito para que as pessoas se interessem por seu projeto.
                                </p>
                            </div>
                            <div class="input">
                                <textarea></textarea>
                            </div>    
                        </div>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>Imagem do Projeto</p>
                                <p>Imagem que será disponibilizada como capa para o seu projeto! Use uma foto quee chame a atenção dos usuários!</p>
                            </div>
                            <div class="input">
                                <input type="file">
                            </div>
                        </div>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>Capa do Projeto (opcional)</p>
                                <p>Imagem que será disponibilizada como capa para o seu projeto! Use uma foto chamativa e chame a atenção dos usuários!
                                <br>
                                    <i>Se não houver capa, não fique preocupado! Usaremos a imagem do projeto para criar uma capa incrível para sua campanha.</i>
                                </p>
                            </div>
                            <div class="input">
                                <input type="file">
                            </div>
                        </div>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>
                                    Categoria da história
                                </p>
                                <p>
                                    Escolha o eixo que melhor se enquadra o tipo de quadrinho que você está criando! Isso ajuda a filtrar os gostos pessoais dos usuários e na busca por novas histórias.
                                </p>
                            </div>
                            <div class="input">
                                <select>
                                    <option>Ação</option>
                                    <option>Biográfico</option>
                                    <option>Comédia</option>
                                    <option>Drama</option>
                                    <option>Esporte</option>
                                    <option>Ficção Científica</option>
                                    <option>Literatura</option>
                                    <option>Super-Herói</option>
                                    <option>Terror</option>
                                    <option>Tirinha</option>
                                </select>
                            </div>
                        </div>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>Tags principais</p>
                                <p>
                                    Descreva as melhores tags para facilitar a busca da sua campanha na plataforma! Conte com características como preto e branco, mangás, tiroteio, como quiser!
                                </p>
                            </div>
                            <div class="input" id="addTag">
                                <input type="text" name="tags">
                                <input type="button" value="Adicionar">
                                <p>
                                    Separe as tags por vírgula, exemplo: Aventura romana, pós-apocalíptico, Aliens
                                </p>
                                <ul id="categorias">
                                    <li>1</li>
                                </ul>
                                
                            </div>
                        </div>
                        <!--<div class="visualizar">-->
                        <!--    <input type="button" id="visualizar" value="Visualizar campanha">-->
                        <!--</div>-->
                        <div class="cadaPasso">
                            <input type="button" id="cancelar" value="Cancelar">
                            <input type="button" id="continuar" value="Continuar">
                        </div>
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
                            <div class="label">
                                <p>Meta proposta</p>
                                <p>Quanto você precisa para retirar sua ideia do papel?</p>
                            </div>
                            <div class="input">
                                <input type="number">
                            </div>
                        </div>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>Tempo estimado</p>
                                <p>
                                    Quanto tempo de campanha dentro da plataforma? Lembrando que, após a data estipulada não haverá possibilidade de continuidade do projeto na plataforma.
                                </p>
                            </div>
                            <div class="input">
                                <input type="number" placeholder="Mínimo de 30 dias, máximo de 90">
                                <p>
                                    Término da campanha previsto para: __/__/____
                                </p>
                            </div>
                        </div>
                        <!--<div class="visualizar">-->
                        <!--    <input type="button" id="visualizar" value="Visualizar campanha">-->
                        <!--</div>-->
                        <div class="cadaPasso">
                            <input type="button" id="cancelar" value="Cancelar">
                            <input type="button" id="continuar" value="Continuar">
                        </div>
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
                            <div class="label">
                                <p>Página no Facebook</p>
                                <p>
                                    Sua campanha possui informações no Facebook? Se sim, insira o link no campo ao lado!
                                </p>
                            </div>
                            <div class="input">
                                <input type="text">
                            </div>
                        </div>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>Vídeo da campanha</p>
                                <p>
                                    Você produziu um vídeo para o seu projeto? Que incrível! Insira o link ao lado para os apoiadores conhecerem.
                                </p>
                            </div>
                            <div class="input">
                                <input type="text">
                            </div>
                        </div>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>Campanha no Instagram</p>
                                <p>
                                    É o tipo de autor com postagens no Stories? Sensacional! Insira o link ao lado para conhecermos mais o dia a dia do seu trabalho.
                                </p>
                            </div>
                            <div class="input">
                                <input type="text">
                            </div>
                        </div>
                        <p class="step">
                            Coautores
                            <b>Autores envolvidos</b>
                        </p>
                        <p>Você está desenvolvendo esse projeto com outros autores? Nesta etapa podemos conhecer um pouco mais as outras mentes por trás do projeto</p>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>
                                    Coautor
                                </p>
                                <p>
                                    Insira aqui os perfis dos dos outros ilustradores, autores, roteiristas e 
                                    idealizadores da sua campanha, afinal, toda ajuda é bem-vinda.
                                </p>
                            </div>
                                <div class="input" id="addAutor">
                                    <input type="text">
                                    <input type="button" value="Adicionar">
                                    <ul id="categorias">
                                        <li>Lucas Teixeira de Lima</li>
                                        <li>Luiz Reis</li>
                                        <li>Gustavo Rosario de Queroz</li>
                                        <li>Ruy Accioly</li>
                                        <li>Lucas Teixeira de Lima</li>
                                        <li>Luiz Reis</li>
                                        <li>Gustavo Rosario de Queroz</li>
                                        <li>Ruy Accioly</li>
                                    </ul>
                                </div>
                            </div>
                            <!--<div class="visualizar">-->
                            <!--    <input type="button" id="visualizar" value="Visualizar campanha">-->
                            <!--</div>-->
                            <div class="cadaPasso">
                                <input type="button" id="cancelar" value="Cancelar">
                                <input type="button" id="continuar" value="Continuar">
                            </div>
                        </div>
                        <div id="stepFinanciamento">
                        <p class="step">
                            Recompensas
                            <b>Retribua seus fãs</b>
                        </p>
                        <p>
                            Nesta etapa você poderá cadastrar as recompensas que as pessoas irão receber quando financiarem seu projeto. O ideal é que você inicie com algumas recompensas estabelecidas mas é possível cadastrar depois.
                        </p>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>Valor da recompensa</p>
                                <p>Quanto o usuário poderá oferecer?</p>
                            </div>
                            <div class="input">
                                <input type="number">
                            </div>
                        </div>
                        <div class="cadaCampo">
                            <div class="label">
                                <p>Prêmio</p>
                                <p>
                                    Defina o que você pode oferecer ao investir no seu projeto, de acordo com o valor doado.
                                </p>
                            </div>
                             <div class="input" id="addAutor">
                                    <input type="text">
                                    <input type="button" value="Adicionar">
                                    <div class='cadaRecompensa'>
                                        <h3>
                                            <b>R$ 50,00</b>
                                            - Título da recompensa</h3>
                                            <span>
                                                descrição da campanha
                                            </span>
                                    </div>
                                    <div class='cadaRecompensa'>
                                        <h3>
                                            <b>R$ 50,00</b>
                                            Título da recompensa</h3>
                                            <span>
                                                descrição da campanha
                                            </span>
                                    </div>
                                </div>
                        </div>
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
            </div>
        </div>
    </div>
</main>