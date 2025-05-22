<?php

require_once 'framework/Controller.php';
require_once 'dao/ProjectDAO.php';

class ProjectController extends Controller {

    function run() {
        $action = filter_input(INPUT_GET, 'action');
        $projectDAO = new ProjectDAO();
        switch ($action) {
            case 'save':
                $project = new Project($_POST);
                $projectDAO->save($project);
                break;
            case 'delete':
                $projectId = filter_input(INPUT_GET, 'projectId');
                $projectDAO->delete($projectId);
                break;
        }
        return 'view=ProjectList';
    }

}

new ProjectController;
