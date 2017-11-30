<?php
defined("System-access") or header('location: /error');
?>

<body>
    <main>
        <div id="signup">
            <div class="wrapper">
                <h1><i class="fa fa-user-o" aria-hidden="true"></i> Cadastro de Pessoa física
                </h1>


                <ul>
                    <li>
                        <i class="fa fa-user-circle-o dadospessoais" aria-hidden="true"></i> Dados pessoais</li>
                    <li>
                        <i class="fa fa-money dadosfinanciamento" aria-hidden="true"></i> Dados sobre financiamento</li>
                    <li>
                        <i class="fa fa-pencil dadosartista" aria-hidden="true"></i> Artista / Portfolio</li>
                </ul>

        <div id='signupDadosPessoais'>
                <h2>Junte-se ao Talaka</h2>
                <p>A plataforma de financiamento criada pensando em quadrinistas, ilustradores e amantes de quadrinhos.</p>

                <form>
                    <label for="name">Nome *</label>
                    <input type="text" id="name" placeholder="Insira seu nome" required>

                    <label for="namelogin">Nome de Usuário *</label>
                    <input type="text" id="namelogin" placeholder="Insira seu nome de usuário" required>
                    
                    <label for="birthday">Data de aniversário *</label>
                    <input type="date" id="birthday" placeholder="Insira sua data de aniversário" required>
                    
                    <label for="local">Localidade *</label>
                    <input type="text" id="local" placeholder="Insira seu estado" required>

                    <label for="email">Email *</label>
                    <input type="email" id="email" placeholder="Insira seu email" required>

                    <label for="password">Senha *</label>
                    <input type="passwrod" id="password" placeholder="Insira sua senha" required>

                    <label for="password">Confirme sua senha *</label>
                    <input type="passwrod" id="password" placeholder="Redigite sua senha" required>

                    <label for="bio">Biografia / Status </label>
                    <textarea id="bio" placeholder="Escreva um pouco sobre você!" required></textarea>

                    <input type="submit" value="Próximo">
                    <a href="/">Cancelar</a>
                </form>
            </div>
            
            
            <div id='signupFinanciamento'>
                <h2>Dados para pagamento</h2>
                <p>Forneça as informações pedidas para, futuramente, realizar pagamentos dentro da plataforma</p>

                <form>
                    <label for="name">Nome *</label>
                    <input type="text" id="name" placeholder="Insira seu nome" required>

                   <input type="submit" value="Próximo">
                    <a href="/">Cancelar</a>
                </form>
            </div>
            
            
            <div id='signupArtista'>
                <h2>Projetos pessoais</h2>
                <p>
                    Caso você seja um artista, ilustrador, quadrinista, mostre isso aos seus fãs com o cadastro de projetos pessoais.
                </p>

                <form>
                    <label for="name">Nome *</label>
                    <input type="text" id="name" placeholder="Insira seu nome" required>

                   <input type="submit" value="Finalizar">
                </form>
            </div>
            
            
           
            
            
            
        </div>
        </div>
    </main>
    <footer>
        <div class="wrapper">

            <ul>
                <li>Sobre</li>
                <li>Projetos</li>
                <li>Como funciona</li>
                <li>FAQ</li>
                <li>Dicas para campanha</li>
                <li>Termos de Uso</li>
            </ul>
            <div class="footer">
                <p>
                    Talaka &copy; 2017
                </p>
            </div>
        </div>
    </footer>
</body>

</html>
