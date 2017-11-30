<?php
defined("System-access") or header('location: /error');
?>
<main id="pageAdmin">
    <div id="bgAdmin">
        <div id="inputAdmin">
            <h1>
                <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                Realizar login como Administrador
            </h1>
            <form method="post" action="adminlogin">
                <input type="text" name="login" placeholder="Login de administrador" required>
                <input type="password" name="pwd" placeholder="Senha" required>
                <ul>
                    <li>
                        <input type="button" value="Cancelar" id="cancelarAdmin">
                    </li>
                    <li>
                        <input type="button" value="Logar" id="logar">
                    </li>
                </ul>
            </form>
        </div>
    </div>
</main>