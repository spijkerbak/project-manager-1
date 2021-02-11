<?php

require_once 'framework/DAO.php';
require_once 'model/Task.php';

class TaskDAO extends DAO {

    private static $select = "SELECT"
            . " `TM1_Task`.*, `TM1_Project`.`title` AS `project`"
            . " FROM `TM1_Task`"
            . " LEFT JOIN `TM1_Project`"
            . " ON `TM1_Task`.`projectId` = `TM1_Project`.`projectId`";

    function __construct() {
        parent::__construct('Task');
    }

    function startList(): void {
        $sql = self::$select;
        $sql .= " ORDER BY `TM1_Task`.`projectId`, `TM1_Task`.`taskNumber`";
        $this->startListSql($sql);
    }

    function startListForProject($projectId): void {
        $sql = self::$select;
        $sql .= " WHERE `TM1_Task`.`projectID` = ?";
        $sql .= " ORDER BY `TM1_Task`.`taskNumber`";
        $this->startListSql($sql, [$projectId]);
    }

    function get(?string $projectId, ?string $taskNumber) {
        if (empty($taskNumber)) {
            return new Task;
        } else {
            $sql = self::$select;
            $sql .= " WHERE `TM1_Task`.`projectId` = ? AND `TM1_Task`.`taskNumber` = ?";
            return $this->getObjectSql($sql, [$projectId, $taskNumber]);
        }
    }

    function delete(string $projectId, string $taskNumber) {
        $sql = "DELETE FROM `TM1_Task` WHERE `projectId` = ? AND `taskNumber` = ?";
        $args = [
            $projectId, $taskNumber
        ];
        $this->execute($sql, $args);
    }

    function insert(Task $task) {
        $sql = 'INSERT INTO `TM1_Task` '
                . ' (projectId, taskNumber, title, description, worker, status)'
                . ' VALUES (?, ?, ?, ?, ?, ?)';
        $args = [
            $task->getProjectId(),
            $task->getTaskNumber(),
            $task->getTitle(),
            $task->getDescription(),
            $task->getWorker(),
            $task->getStatus(),
        ];
        $this->execute($sql, $args);
    }

    function update(string $taskNumberOrg, Task $task) {
        $sql = 'UPDATE `TM1_Task` '
                . ' SET taskNumber = ?, title = ?, description = ?, worker = ?, status = ? '
                . ' WHERE projectId = ? AND taskNumber = ?';
        $args = [
            $task->getTaskNumber(),
            $task->getTitle(),
            $task->getDescription(),
            $task->getWorker(),
            $task->getStatus(),
            $task->getProjectId(),
            $taskNumberOrg
        ];
        $this->execute($sql, $args);
    }

}
