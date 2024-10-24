<?php

namespace Controllers;

class TaskController {
	private $tasks = [];

	public function __construct() {

		// Create or update tasks depending on if tasks exists in session
		if (!isset($_SESSION['tasks'])) {
			$_SESSION['tasks'] = [];
		}

		$this->tasks = &$_SESSION['tasks'];
	}

	// Add task function
	public function create(array $form_data) {
		$this->tasks[(count($this->tasks) + 1)] = [
			'id' => (count($this->tasks) + 1),
			'title' => $form_data['task_title'],
			'description' => $form_data['description']
		];
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