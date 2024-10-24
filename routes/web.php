<?php
session_start();

include 'autoload.php';
// include 'app/Views/TaskView.php';

// Check if user is on the index page and point to TaskView Class
$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(strpos($url, 'index.php')) {
	$tasks = isset($_SESSION['tasks']) ? $_SESSION['tasks'] : [];
}

// Instantiate task controller if a form is submitted
if(isset($_POST['task_id'])) {
	$task_driver = new Controllers\TaskController();

	// Create new task
	if(isset($_POST['add_task'])) {
		$task_driver->create($_POST);
	}

	// Update task
	if(isset($_POST['edit_task'])) {
		$task_driver->update($_POST);
	}

	// Delete task
	if(isset($_POST['delete_task'])) {
		$task_driver->delete($_POST);
	}

	header("Location: ../index.php");
}