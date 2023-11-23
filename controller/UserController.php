<?php

require_once 'framework/Controller.php';
require_once 'dao/UserDAO.php';

class UserController extends Controller {

    function run() {
        $action = filter_input(INPUT_GET, 'action');
        $userDAO = new UserDAO();
        switch ($action) {
            case 'login':
                $user = new User($_POST);
                $userDAO->login($user);
                break;
            case 'save':
                $user = new User($_POST);
                $userDAO->save($user);
                break;
            case 'delete':
                $username = filter_input(INPUT_GET, 'username');
                $userDAO->delete($username);
                break;
        }
        return 'view=UserList';
    }

}

new UserController;
