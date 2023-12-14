<?php
/**
 * All requests are sent to this index.php
 * Depending on requested view or controller, 
 * the needed class will be included (require)
 */

// show errors in browser during development
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// basic setup
$title = 'Project Manager 1.42';
session_start();
set_include_path('./' . PATH_SEPARATOR . '../'); // include from any level

// force refresh in browser during development
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

// requested controller ?
$controller = filter_input(INPUT_GET, 'controller');
if (!empty($controller)) {
    if (file_exists("controller/$controller.php")) {
        // include the controller and skip the html
        require("controller/$controller.php");
        exit;
    }
    header('location: ?view=Error'); // redirect!
    exit;
}

// requested view or nothing
$view = filter_input(INPUT_GET, 'view') ?? 'Home';
if (!file_exists("view/{$view}.php")) {
    $view = 'Error';
}

$menu = [
    // menu item => view
    'Home' => 'Home',
    'Login' => 'Login',
    'Projects' => 'ProjectList',
    'Tasks' => 'TaskList',
    'Users' => 'UserList',
    'Docs' => 'Docs',
    'Reset' => 'Reset',
];
?>
<!doctype html>
<html lang='nl'>

<head>
    <title>
        <?= $title ?>
    </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style/style.css?as">
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
    </nav>
    <main>
        <?php
        require "view/{$view}.php";
        ?>
    </main>
    <footer>
        <p>&copy; Frans Spijkerman 2020-2023 - Sources staan op <a target="github"
                href="https://github.com/spijkerbak/project-manager-1">Github</a></p>
    </footer>
</body>

</html>