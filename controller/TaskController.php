<?php

require_once 'framework/Controller.php';
require_once 'dao/TaskDAO.php';

SqlProvider::$debug = false;

class TaskController extends Controller {

    function run() {
        $action = filter_input(INPUT_GET, 'action');
        $taskDAO = new TaskDAO();
        switch ($action) {
            case 'insert':
                $task = new Task($_POST);
                $taskDAO->insert($task);
                break;
            case 'update':
                $task = new Task($_POST);
                $taskNumberOrg = filter_input(INPUT_POST, 'taskNumberOrg');
                $taskDAO->update($taskNumberOrg, $task);
                break;
            case 'delete':
                $projectId = filter_input(INPUT_GET, 'projectId');
                $taskNumber = filter_input(INPUT_GET, 'taskNumber');
                $taskDAO->delete($projectId, $taskNumber);
                break;
        }
        return 'view=TaskList';
    }

}

new TaskController;


