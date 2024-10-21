<?php
session_start();

// Capture form data and store
$form_data = $_POST;

// Create task array in the global session variable to store tasks if tasks doesn't exist
if (!isset($_SESSION['tasks'])) {
	$_SESSION['tasks'] = [];
}

$tasks = &$_SESSION['tasks'];

// Check what action to perform
if (isset($_POST['add_task'])) {
	addTask();
}elseif (isset($_POST['edit_task'])) {
	editTask($_POST['task_id']);
}else{
	deleteTask($_POST['task_id']);
}

// Add tasks to tasks array
function addTask() {
	global $tasks, $form_data;
	$tasks[(count($tasks) + 1)] = [
		'id' => (count($tasks) + 1),
		'title' => $form_data['task_title'],
		'description' => $form_data['description']
	];
}

// Edit tasks by id
function editTask($task_id) {
	global $tasks, $form_data;
	$tasks[$task_id] = [
		'id' => $task_id,
		'title' => $form_data['task_title'],
		'description' => $form_data['description']
	];
}

// Delete tasks by id
function deleteTask($task_id) {
	global $tasks;
	unset($tasks[$task_id]);
}

header("Location: ../index.php");