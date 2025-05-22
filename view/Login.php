<?php
require_once 'framework/View.php';
require_once 'dao/UserDAO.php';

class Login extends View {

    function show() {
        ?>
        <h2>Login</h2>
        <form id="login" method="post" action="?controller=UserController&action=login">
            <label>Username<input type="text" name="username"></label>   
            <label>Password<input type="password" name="password"></label>   
        </form>

        <nav>
            <button form="project" type="submit">Login</button>
        </nav>
        <?php
    }

}

new Login;