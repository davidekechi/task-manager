<?php

namespace App\Models;

class Task {
	protected function getAllTasks() {
		// Find tasks file and read it
		$fileName = '/tmp/TasksFile.json';
		if (!file_exists($fileName)) {
			return [];
		}else{
			$handle = fopen($fileName, 'r') or die("Unable to open file!");
			$tasks_data = fread($handle, filesize($fileName));
			fclose($handle);

			return json_decode($tasks_data);
		}
	}

	protected function create(array $new_tasks) {
		// Update json data if it exists on file
		if (!empty($this->getAllTasks())) {
			$new_tasks = array_merge(((array) $this->getAllTasks()), $new_tasks);
		}

		// Create and write tasks to temp file
		$handle = fopen('/tmp/TasksFile.json', 'w') or die("Unable to open file!");
		fwrite($handle, json_encode($new_tasks));
		fclose($handle);
	}
}