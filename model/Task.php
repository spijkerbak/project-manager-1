<?php

require_once 'framework/Model.php';

class Task extends Model {
    
    protected $projectId = null;
    protected $taskNumber = null;
    protected $title = '';
    protected $description = '';
    protected $worker = '';
    protected $status = 'to do';
    
    protected $project = '';
    
    function __construct(?array $data = null) {
        parent::__construct($data);
    }
    
    function getTaskNumber() {
        return $this->taskNumber;
    }

    function getProjectId() {
        return $this->projectId;
    }

    function getProject() {
        return $this->project;
    }

    function getTitle() {
        return $this->title;
    }

    function getDescription() {
        return $this->description;
    }

    function getWorker() {
        return $this->worker;
    }

    function getStatus() {
        return $this->status;
    }


}
