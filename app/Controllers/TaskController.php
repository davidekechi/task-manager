<?php

namespace Controllers;

use app\Models\Task;

class TaskController extends Task {
	private $tasks;

	public function __construct() {

		// Create or update tasks depending on if tasks exists in session
	}

	// Add task function
	public function addTask(array $form_data) {
		$allTasks = $this->getAllTasks();

		$this->tasks[(count((array)$allTasks) + 1)] = [
			'uid' => $_SESSION['uid'],
			'id' => (count((array)$allTasks) + 1),
			'title' => $form_data['task_title'],
			'description' => $form_data['description']
		];

		$createTask = $this->create($this->tasks);
	}

	// Update task function
	public function update(array $form_data) {
		$this->tasks[$form_data['task_id']] = [
			'id' => $form_data['task_id'],
			'title' => $form_data['task_title'],
			'description' => $form_data['description']
		];
	}

	// Delete task function
	public function delete(array $form_data) {
		unset($this->tasks[$form_data['task_id']]);
	}
}