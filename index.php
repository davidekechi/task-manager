<?php
    include 'routes/web.php';
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
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-solid.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-regular.css">

    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/sharp-light.css">
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
            <form action="routes/web.php" method="POST">
                <div>
                    <label for="taskTitle">Task Title:</label>
                    <input type="text" id="taskTitle" name="task_title" class="form-control" required>
                </div>
                <div class="mt-2">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" class="form-control" required></textarea>
                </div>
                <input type="hidden" name="task_id" value="">
                <div>
                    <button type="submit" class="mt-2 btn btn-primary" name="add_task">Add Task</button>
                </div>
            </form>
        </section>

        <!-- DISPLAY TASKS HERE -->
        <section class="displayTasks">
            <div class="flex justify-between">
                <h2 class="text-2xl font-semibold mb-2">Task Manager</h2>
                <?php  if (count((array) $tasks)): ?>
                    <button class="btn btn-primary btn-sm newTaskBtn rounded-lg">New Task</button>
                <?php endif ?>
            </div>
            <?php  if (!count((array) $tasks)): ?>
                <div class="grid justify-center">
                    <h2 class="text-xl">No tasks to show</h2>
                    <button class="mt-2 btn btn-primary align-center newTaskBtn rounded-lg">Create tasks</button>
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
                        <?php foreach ($pending_tasks as $key => $task): ?>
                            <tr>
                                <td><?php echo $key ?></td>
                                <td><?php echo $task->title ?></td>
                                <td><?php echo $task->description ?></td>
                                <td>
                                    <div class="flex justify-between">
                                        <div>
                                            <?php if($task->status == 'pending'): ?>
                                                <button class="btn btn-sm rounded-lg" style="border: 1px solid black !important;" onclick="openModal('complete', '<?php echo $task->id ?>')">
                                                    <i class="far fa-check"></i> Mark Complete
                                                </button>
                                            <?php else: ?>
                                                <i class="fas fa-circle-check text-primary"></i> Completed
                                            <?php endif ?>
                                        </div>
                                        <div>
                                            <i class="fas fa-ellipsis cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                            <ul class="dropdown-menu px-2">
                                                <?php if($task->status == 'pending'): ?>
                                                    <li class="border-b"><a class="dropdown-item" href="#" onclick="openModal('edit', '<?php echo $task->id ?>')">Edit</a></li>
                                                <?php endif ?>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="openModal('delete', '<?php echo $task->id ?>')">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>

                        <?php foreach ($complete_tasks as $key => $task): ?>
                            <tr>
                                <td><?php echo $key ?></td>
                                <td><?php echo $task->title ?></td>
                                <td><?php echo $task->description ?></td>
                                <td>
                                    <div class="flex justify-between">
                                        <div>
                                            <?php if($task->status == 'pending'): ?>
                                                <button class="btn btn-sm rounded-lg" style="border: 1px solid black !important;" onclick="openModal('complete', '<?php echo $task->id ?>')">
                                                    <i class="far fa-check"></i> Mark Complete
                                                </button>
                                            <?php else: ?>
                                                <i class="fas fa-circle-check text-primary"></i> Completed
                                            <?php endif ?>
                                        </div>
                                        <div>
                                            <i class="fas fa-ellipsis cursor-pointer" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                            <ul class="dropdown-menu px-2">
                                                <?php if($task->status == 'pending'): ?>
                                                    <li class="border-b"><a class="dropdown-item" href="#" onclick="openModal('edit', '<?php echo $task->id ?>')">Edit</a></li>
                                                <?php endif ?>
                                                <li><a class="dropdown-item text-danger" href="#" onclick="openModal('delete', '<?php echo $task->id ?>')">Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <?php foreach ($tasks as $key => $task): ?>
                    <!-- COMPLETE SECTION FOR TASKS -->
                    <div class="completeTask<?php echo $task->id ?> hidden">
                        <h2 class="text-lg font-semibold mb-2">Mark Task <span class="text-primary font-normal text-md">#<?php echo $key ?></span> as Complete</h2>
                        <form action="routes/web.php" method="POST">
                            <h2 class="justify-center">Are you sure you want to mark this task as complete?</h2>
                            <input type="hidden" name="task_title" class="form-control" value="<?php echo $task->title ?>" required>
                            <input type="hidden" name="task_id" value="<?php echo $task->id ?>">
                            <input type="hidden" name="status" value="complete">
                            <textarea hidden name="description" class="form-control" required><?php echo $task->description ?></textarea>
                            <input type="hidden" name="count" value="<?php echo $task->count ?>">
                            <div>
                                <button type="submit" class="mt-4 btn btn-primary" name="edit_task">Mark Task as Completed</button>
                            </div>
                        </form>
                    </div>

                    <!-- EDIT SECTION FOR TASKS -->
                    <div class="editTask<?php echo $task->id ?> hidden">
                        <h2 class="text-lg font-semibold mb-2">Edit Task <span class="text-primary font-normal text-md">#<?php echo $key ?></span></h2>
                        <form action="routes/web.php" method="POST">
                            <div>
                                <label for="taskTitle">Task Title:</label>
                                <input type="text" name="task_title" class="form-control" value="<?php echo $task->title ?>" required>
                            </div>
                            <div class="mt-2">
                                <label for="description">Description:</label>
                                <textarea name="description" class="form-control" required><?php echo $task->description ?></textarea>
                            </div>
                            <input type="hidden" name="task_id" value="<?php echo $task->id ?>">
                            <input type="hidden" name="count" value="<?php echo $task->count ?>">
                            <div>
                                <button type="submit" class="mt-2 btn btn-warning" name="edit_task">Edit Task</button>
                            </div>
                        </form>
                    </div>

                    <!-- DELETE SECTION FOR TASKS -->
                    <div class="deleteTask<?php echo $task->id ?> hidden">
                        <h2 class="text-lg font-semibold mb-2">Delete Task <span class="text-primary font-normal text-md">#<?php echo $key ?></span></h2>
                        <form action="routes/web.php" method="POST">
                            <h2 class="justify-center">Are you sure you want to delete this task?</h2>
                            <input type="hidden" name="task_id" value="<?php echo $task->id ?>">
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
