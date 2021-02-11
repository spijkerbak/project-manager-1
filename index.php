<?php
session_start();
ini_set('display_errors', 1);
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies
// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');


$title = 'Task Manager';

$controller = filter_input(INPUT_GET, 'controller');
if (!empty($controller)) {
    require "controller/{$controller}.php";
    exit;
}

$view = filter_input(INPUT_GET, 'view');
if (empty($view)) {
    $view = 'Home';
}
$menu = [
    'Home' => '?view=Home',
    'Projects' => '?view=ProjectList',
    'Tasks' => '?view=TaskList',
];
?><!doctype html>
<html lang='nl'>
    <head>
        <title><?= $title ?></title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="style/style.css">
    </head>
    <body>
        <header>
            <h1><?= $title ?></h1>
        </header>
        <nav>
            <?php foreach ($menu as $title => $action) { ?>
                <a href="<?= $action ?>"><?= $title ?></a>
            <?php } ?>
             <a href="?controller=ResetController" 
                onclick="return confirm('Alle gegevens wissen en vervangen door defaults?')">
                 Reset</a>
        </nav>
        <main>
            <?php
            require "view/{$view}.php";
            ?>
        </main>
        <footer>
            <p>&copy; Frans Spijkerman 2020 - Sources staan op <a target="github" href="https://github.com/spijkerbak/project-manager-1">Github</a></p>
        </footer>
    </body>
</html>