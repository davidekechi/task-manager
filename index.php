<?php
    session_start();
    $tasks = isset($_SESSION['tasks']) ? $_SESSION['tasks'] : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css"> <!-- Link to CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                clifford: '#da373d',
              }
            }
          }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

    <main class="container px-48 mt-20">

        <!-- ADD TASKS HERE -->
        <section class="newTask hidden">
            <h2 class="text-lg font-semibold mb-2">Create New Task</h2>
            <form action="includes/server.php" method="POST">
                <div>
                    <label for="taskTitle">Task Title:</label>
                    <input type="text" id="taskTitle" name="task_title" class="form-control" required>
                </div>
                <div class="mt-2">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>
                <div>
                    <button type="submit" class="mt-2 btn btn-primary" name="add_task">Add Task</button>
                </div>
            </form>
        </section>

        <!-- DISPLAY TASKS HERE -->
        <section class="displayTasks">
            <div class="flex justify-between">
                <h2 class="text-2xl font-semibold mb-2">Task Manager</h2>
                <?php  if (count($tasks)): ?>
                    <button class="btn btn-primary btn-sm newTaskBtn">New Task</button>
                <?php endif ?>
            </div>
            <?php  if (!count($tasks)): ?>
                <div class="grid justify-center">
                    <h2 class="text-xl">No tasks to show</h2>
                    <button class="mt-2 btn btn-primary align-center newTaskBtn">Create tasks</button>
                </div>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $key => $task): ?>
                            <tr>
                                <td><?php echo $key ?></td>
                                <td><?php echo $task['title'] ?></td>
                                <td><?php echo $task['description'] ?></td>
                                <td>
                                    <div>
                                        <button href="#" class="btn btn-sm btn-warning" onclick="openModal('edit', '<?php echo $key ?>')">Edit</button>
                                        <button href="#" class="btn btn-sm btn-danger" onclick="openModal('delete', '<?php echo $key ?>')">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <?php foreach ($tasks as $key => $task): ?>
                    <!-- EDIT SECTION FOR TASKS -->
                    <div class="editTask<?php echo $key ?> hidden">
                        <h2 class="text-lg font-semibold mb-2">Edit Task <?php echo $key ?></h2>
                        <form action="includes/server.php" method="POST">
                            <div>
                                <label for="taskTitle">Task Title:</label>
                                <input type="text" name="task_title" class="form-control" value="<?php echo $task['title'] ?>" required>
                            </div>
                            <div class="mt-2">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control" required><?php echo $task['description'] ?></textarea>
                            </div>
                            <input type="hidden" name="task_id" value="<?php echo $key ?>">
                            <div>
                                <button type="submit" class="mt-2 btn btn-warning" name="edit_task">Edit Task</button>
                            </div>
                        </form>
                    </div>

                    <!-- DELETE SECTION FOR TASKS -->
                    <div class="deleteTask<?php echo $key ?> hidden">
                        <h2 class="text-lg font-semibold mb-2">Delete Task <?php echo $key ?></h2>
                        <form action="includes/server.php" method="POST">
                            <h2 class="justify-center">Are you sure you want to delete this task?</h2>
                            <input type="hidden" name="task_id" value="<?php echo $key ?>">
                            <div>
                                <button type="submit" class="mt-4 btn btn-danger" name="delete_task">Delete Task</button>
                            </div>
                        </form>
                    </div>
                <?php endforeach ?>
            <?php endif ?>
        </section>

        <!-- MODAL -->
        <div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-end">
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="font-semibold">x</span>
                        </button>
                    </div>
                    <div class="modal-body taskModalBody"></div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="js/script.js?v=1"></script> <!-- Link to JS -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
