<?php
require_once 'framework/View.php';
require_once 'model/Project.php';
require_once 'dao/ProjectDAO.php';

class ProjectSelector extends View {

    private $projectId;

    function getProjectId() {
        return $this->projectId;
    }
    
    function show() {
        if (!empty($_POST)) { // is er een nieuwe keuze gepost?
            $projectId = filter_input(INPUT_POST, 'projectId');
            $_SESSION['projectId'] = $projectId;
        } else if (isset($_SESSION['projectId'])) { // haal eerder gemaakte euze op
            $projectId = $_SESSION['projectId'];
        } else {
            $projectId = ''; // geen keuze
        }
        $this->projectId = $projectId;

        $projectDAO = new ProjectDAO;
        $projectDAO->startList();
        ?>
        <form method="post">
            <label>Project :
                <select name="projectId" onchange="submit()">
                    <option value=""></option>
                    <?php
                    while ($projectDAO->hasNext()) {
                        $project = $projectDAO->getNext();
                        $selected = $project->getProjectId() == $projectId ? 'selected' : '';
                        echo "<option {$selected} value='{$project->getProjectId()}'>{$project->getTitle()}</option>\n";
                    }
                    ?>
                </select>
            </label>
        </form>

        <?php
    }

}

