<?php
require_once 'framework/View.php';
require_once 'dao/TaskDAO.php';
require_once 'view/ProjectSelector.php';

class TaskEdit extends View {

    function show() {
        $action = filter_input(INPUT_GET, 'action');
        $projectId = filter_input(INPUT_GET, 'projectId');
        $taskNumber = filter_input(INPUT_GET, 'taskNumber');
        $taskDAO = new TaskDAO;
        $task = $taskDAO->get($projectId, $taskNumber);

        $ps = new ProjectSelector($projectId);
        $projectId = $ps->getProjectId();

        if (empty($projectId)) {
            $projectId = $task->getProjectId();
        }
        ?>
        <h2>Task</h2>
        <form id="task" method="post" action="?controller=TaskController&action=<?= $action ?>">
            <input type="hidden" name="projectId" value="<?= $projectId ?>">
            <input type="hidden" name="taskNumberOrg" value="<?= $task->getTaskNumber() ?>">
            <label>Nummer<input name="taskNumber" value="<?= $task->getTaskNumber() ?>"></label>
            <label>Title<input name="title" value="<?= $task->getTitle() ?>"></label>   
            <label>Description<textarea name="description"><?= $task->getDescription() ?></textarea></label>   
            <label>Worker<input name="worker" value="<?= $task->getWorker() ?>"></label>   
            <label>Status<input name="status" value="<?= $task->getStatus() ?>"></label>   
        </form>

        <nav>
            <button form="task" type="submit">Save</button>
            <a href="?view=TaskList">Ignore</a>
        </nav>
        <?php
    }

}

new TaskEdit;