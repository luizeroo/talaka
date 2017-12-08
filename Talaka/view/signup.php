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
    
            <form method="post" id="formCad" enctype="multipart/form-data">
            <div id='signupDadosPessoais'>
                <h2>Junte-se ao Talaka</h2>
                <p>A plataforma de financiamento criada pensando em quadrinistas, ilustradores e amantes de quadrinhos.</p>

                
                    <fieldset>
                        <legend>
                            Dados de Usuários
                        </legend>
                        <label for="name">Nome *</label>
                        <input type="text" id="name" name='nm_user' placeholder="Insira seu nome" required>
    
                        <label for="namelogin">Nome de Usuário *</label>
                        <input type="text" id="namelogin" name='login_user' placeholder="Insira seu nome de usuário" required>
                        
                        <label for="cpf">CPF *</label>
                        <input type="text" id="cpf" name='cpf_user' placeholder="Insira seu CPF" required>
                        
                        <label for="birthday">Data de aniversário *</label>
                        <input type="date" id="birthday" name='birthday_user' placeholder="Insira sua data de aniversário" required>
                        
                        <label for="bio">Biografia / Status </label>
                    <textarea id="bio" name='bio_user' placeholder="Escreva um pouco sobre você!"></textarea>
                    </fieldset>
                    <fieldset>
                        <legend>
                            Dados de Conta
                        </legend>
                    
                        <label for="email">Email *</label>
                        <input type="email" id="email" name='email_user' placeholder="Insira seu email" required>
    
                        <label for="password">Senha *</label>
                        <input type="password" id="password" name='password_user' placeholder="Insira sua senha" required>
    
                        <label for="cpassword">Confirme sua senha *</label>
                        <input type="password" id="cpassword" placeholder="Redigite sua senha" required>
                    </fieldset>
            </div>
            
            
            <div id='signupFinanciamento'>
                <h2>Dados para pagamento</h2>
                <p>Forneça as informações pedidas para, futuramente, realizar pagamentos dentro da plataforma</p>

                    <fieldset>
                        <legend>
                            Dados sobre Endereço
                        </legend>
                        <label for="street">Rua *</label>
                        <input type="text" id="street" name='street_user' placeholder="Insira sua rua" required>
                        
                        <label for="neigh">Bairro *</label>
                        <input type="text" id="neigh" name='neigh_user' placeholder="Insira seu bairro" required>
                        
                        <label for="n">Nº *</label>
                        <input type="number" id="n" name='n_user' placeholder="Insira seu número" required>
                        
                        <label for="cep">CEP *</label>
                        <input type="text" id="cep" name='cep_user' placeholder="Insira seu CEP" required>
                        
                        <label for="state">Estado *</label>
                        <input type="text" id="state" name='state_user' placeholder="Insira seu estado" required>
                        
                        <label for="country">País *</label>
                        <input type="text" id="country" name='country_user' value="Brasil" required>
                    </fieldset>
                    <fieldset>
                        <legend>
                            Telefone para contato
                        </legend>
                        <label for="ddd"> Insira o DDD e o número de telefone*</label>
                        <input type="number" id="ddd" name='ddd' placeholder="13" pattern="{2}" maxlength='2' required style='float:left; width:10%'>
                        <input type="tel" id="tel" name='tel' placeholder="Insira esse formato: XXXXX-XXXX"  maxlength='9' pattern="[0-9]{4,5}-[0-9]{4}" required style='float:left; width:89%; margin-left:1%'>
                    </fieldset>
            </div>
                
                
                <div id='signupArtista'>
                    <h2>Foto</h2>
                    <p>
                       Insira a foto que será utilizada como imagem de perfil
                    </p>
                        <label for="fotos">Foto de Usuário</label>
                        <input type="file" id='fotos' name="fotos" accept="image/*">
                </div>
                <button type="button" value="Finalizar" id="cad">Finalizar
            </form>
            
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
