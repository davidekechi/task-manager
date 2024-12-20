<?php

namespace App\Models;

class Task {
	private static $fileName = '/tmp/TasksFile.json';

	protected function getAllTasks() {
		// Find tasks file and read it
		if (!file_exists(self::$fileName)) {
			return [];
		}else{
			$handle = fopen(self::$fileName, 'r') or die("Unable to open file!");
			$tasks_data = fread($handle, filesize(self::$fileName));
			fclose($handle);

			return json_decode($tasks_data);
		}
	}

	protected function create(array $new_task, $type=null) {
		// Update json data if it exists on file
		if ($type == null && !empty($this->getAllTasks())) {
			$new_task = array_merge(((array) $this->getAllTasks()), $new_task);
		}

		// Create and write tasks to temp file
		$handle = fopen(self::$fileName, 'w') or die("Unable to open file!");
		fwrite($handle, json_encode($new_task));
		fclose($handle);
	}

	protected function update(array $task) {
		// Get all tasks from file and delete specific task
		$all_tasks = (array) $this->getAllTasks();
		unset($all_tasks[array_key_first($task)]);

		// Attach the updated file
		$all_tasks = array_merge($all_tasks, $task);

		// Update json file with new tasks
		$this->create($all_tasks, 'update');
	}

	protected function delete(array $task) {
		// Get all tasks from file and delete specific task
		$all_tasks = (array) $this->getAllTasks();
		unset($all_tasks[array_key_first($task)]);

		// Update json file with new tasks
		$this->create($all_tasks, 'update');
	}
}