<?php
require_once 'framework/View.php';
require_once 'dao/UserDAO.php';

class UserEdit extends View
{

    function show()
    {
        $username = filter_input(INPUT_GET, 'username');
        $userDAO = new UserDAO;
        $user = $userDAO->get($username);
        ?>
        <h2>User</h2>
        <form id="user" method="post" action="?controller=UserController&username=<?= $user->getUsername() ?>&action=save">
            <label>Username
                <?php if (empty($username)) { ?>
                    <input name="username" value="<?= $username ?>">
                <?php } else { ?>
                    <input readonly name="username" value="<?= $username ?>">
                <?php } ?>
            </label>
            <label>Password<input type="password" name="password" value="<?= $user->getPassword() ?>"></label>
            <label>Role<input name="role" value="<?= $user->getRole() ?>"></label>
        </form>

        <nav>
            <button form="user" type="submit">Save</button>
            <a href="?view=UserList">Ignore</a>
        </nav>
        <?php
    }

}

new UserEdit;