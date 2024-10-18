<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Title Here</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to CSS -->
</head>
<body>
    <header>
        <h1>Welcome to Your Website</h1>
    </header>

    <main>
        <section>
            <h2>Task Manager</h2>
            <form action="includes/server.php" method="POST">
                <div>
                    <label for="taskTitle">Task Title:</label>
                    <input type="text" id="taskTitle" name="task_title" required>
                </div>
                <div>
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <div>
                    <button type="submit">Add Task</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Your Name</p>
    </footer>

    <script src="js/script.js"></script> <!-- Link to JS -->
</body>
</html>
