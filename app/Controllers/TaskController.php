<?php

namespace Controllers;

use app\Models\Task;

class TaskController extends Task {
	private $task;

	public function __construct() {

		// Create or update tasks depending on if tasks exists in session
	}

	// Add task function
	public function addTask(array $form_data) {
		$allTasks = $this->getAllTasks();
		$task_id = 'tsk_'.bin2hex(random_bytes(3));

		$this->task[$task_id] = [
			'uid' => $_SESSION['uid'],
			'id' => $task_id,
			'count' => count((array) $allTasks) + 1,
			'title' => $form_data['task_title'],
			'description' => $form_data['description']
		];

		$this->create($this->task);
	}

	// Update task function
	public function editTask(array $form_data) {
		$this->task[$form_data['task_id']] = [
			'uid' => $_SESSION['uid'],
			'id' => $form_data['task_id'],
			'count' => $form_data['count'],
			'title' => $form_data['task_title'],
			'description' => $form_data['description']
		];

		$this->update($this->task);
	}

	// Delete task function
	public function deleteTask(array $form_data) {
		$this->task[$form_data['task_id']] = [];
		$this->delete($this->task);
	}
}