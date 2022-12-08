<?php
$title = 'Task Manager 1.2';

// show errors in browser during development
session_start();
ini_set('display_errors', -1);

// force refresh in browser during development
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// set include path to work from any directory level
set_include_path('./' . PATH_SEPARATOR . '../');

// requested controller should be in known controllers
$controller = filter_input(INPUT_GET, 'controller');
$controllers = [
    'TaskController',
    'ProjectController',
    'ResetController',
];
if (in_array($controller, $controllers)) {
    require("controller/$controller.php");
    exit;
}

// requested view should be in allowed
$view = filter_input(INPUT_GET, 'view');
$views = [
    // allowed views
    'Home',
    'ProjectList',
    'TaskList',
    'TaskEdit',
    'ProjectEdit',
];
if (!in_array($view, $views)) {
    header('location: ?view=Home');
}

// views available in menu
$menu = [
    // item => view
    'Home' => 'Home',
    'Projects' => 'ProjectList',
    'Tasks' => 'TaskList',
];
?>
<!doctype html>
<html lang='nl'>

<head>
    <title>
        <?= $title ?>
    </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>

<body>
    <header>
        <h1>
            <?= $title ?>
        </h1>
    </header>
    <nav>
        <?php foreach ($menu as $menu_item => $menu_view) { ?>
        <a href="?view=<?= $menu_view ?>">
            <?= $menu_item ?>
        </a>
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
        <p>&copy; Frans Spijkerman 2020-2022 - Sources staan op <a target="github"
                href="https://github.com/spijkerbak/project-manager-1">Github</a></p>
    </footer>
</body>

</html>