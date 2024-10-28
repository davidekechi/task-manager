<?php

namespace Views;

use app\Models\Task;

class TaskView extends Task {
	private $allTasks;

	public function getTasks($uid) {
		// Get data from parent class
		$this->allTasks = $this->getAllTasks();

		if (empty($this->allTasks)) {
			return $this->allTasks;
		}

		// Return only data belonging to specific user
		return array_filter((array)$this->allTasks, function($task) use ($uid) {
			return $task->uid == $uid;
		});
	}
}