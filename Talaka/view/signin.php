<?php
defined("System-access") or header('location: /error');
?>

<body>

    <div id="bgtypeRegister">
        <div id="typeRegister">
            <h2>Escolha o tipo de conta</h2>
            <ul>
                <a href="signup.html"><li id="person"></li></a>
                <a href="#"><li id="team"></li></a>
            </ul>
        </div>
    </div>

    <div id="loginInitial">
        <div id="register">
            <div class="wrapper">
                <h1>Bem-vindo!</h1>
                <h2>Crie uma conta Talaka aqui.</h2>
                <p>
                    Cadastre-se na MAIOR plataforma de crowdfunding de quadrinhos do país e contribua para que diversos projetos virem realidade.
                    Caso você seja um artista independente que deseja ter seu projeto financiado, basta se cadastrar no Talaka e criar a sua campanha na plataforma.
                    Assim ela poderá ser vista por diversas pessoas que irão se interessar e apoiar o seu sonho.
                </p>
                <a href="#" id="doRegister">Registrar</a>
                <a href="/">Voltar</a>
            </div>
        </div>
        <div id="login">
            <div class="wrapper">
                <h1>Fazer login</h1>
                <form onsubmit="return false">
                    <input type="text" name="login" placeholder="Seu email ou login" required>
                    <input type="password" name="pwd" placeholder="Sua senha" required>
                    <input id="login-button" type="submit" value="Login">
                    <a href="#">Esqueceu a senha?</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
