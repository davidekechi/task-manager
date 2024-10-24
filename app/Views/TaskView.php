<?php

namespace Views;

class TaskView {
	public $tasks = [];

	public function getTasks() {
		if(isset($_SESSION['tasks'])) {
			$this->tasks = $_SESSION['tasks'];
		}
	}
}