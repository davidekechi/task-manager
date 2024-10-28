<?php
session_start();

include 'autoload.php';

// Check if user is on the index page and point to TaskView Class
$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(strpos($url, 'index.php')) {

	// Check if a session id has been set for specific user and call tasks view class
	if (isset($_SESSION['uid']) && isset($_SESSION['tasks'])) {
		$uid = $_SESSION['uid'];
		
		$tasks_list = new Views\TaskView();
		$tasks = $tasks_list->getTasks($uid);

		// Divide tasks into pending and complete tasks
		$pending_tasks = array_filter((array)$tasks, function($task) {
			return $task->status == 'pending';
		});

		$complete_tasks = array_filter((array)$tasks, function($task) {
			return $task->status == 'complete';
		});

		uasort($pending_tasks, function($a, $b) {
			return $b->count <=> $a->count;
		});

		uasort($complete_tasks, function($a, $b) {
			return $b->count <=> $a->count;
		});
	}else{
		// Create uid and tasks in session
		$uid = $_SESSION['uid'] = bin2hex(random_bytes(10));
		$tasks = $_SESSION['tasks'] = [];
	}

}

// Instantiate task controller if a form is submitted
if(isset($_POST['task_id'])) {
	$task_driver = new Controllers\TaskController();

	// Create new task
	if(isset($_POST['add_task'])) {
		$task_driver->addTask($_POST);
	}

	// Update task
	if(isset($_POST['edit_task'])) {
		$task_driver->editTask($_POST);
	}

	// Delete task
	if(isset($_POST['delete_task'])) {
		$task_driver->deleteTask($_POST);
	}

	header("Location: ../index.php");
}