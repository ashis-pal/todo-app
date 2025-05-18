<?php
require 'functions.php';

$tasks = loadTasks();

// Add Task
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task'])) {
    $task = trim($_POST['task']);
    if (!empty($task)) {
        $tasks[] = ['text' => htmlspecialchars($task), 'done' => false];
        saveTasks($tasks);
    }
    header('Location: index.php');
    exit;
}

// Delete Task
if (isset($_GET['delete'])) {
    $index = (int) $_GET['delete'];
    if (isset($tasks[$index])) {
        array_splice($tasks, $index, 1);
        saveTasks($tasks);
    }
    header('Location: index.php');
    exit;
}

// Toggle Task Done
if (isset($_GET['toggle'])) {
    $index = (int) $_GET['toggle'];
    if (isset($tasks[$index])) {
        $tasks[$index]['done'] = !$tasks[$index]['done'];
        saveTasks($tasks);
    }
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple To-Do App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>To-Do List</h2>
        <form method="POST" action="">
            <input type="text" name="task" placeholder="Enter a task">
            <button type="submit">Add</button>
        </form>

        <ul>
            <?php foreach ($tasks as $index => $task): ?>
                <li class="<?= $task['done'] ? 'done' : '' ?>">
                    <a href="?toggle=<?= $index ?>"><?= $task['text'] ?></a>
                    <a href="?delete=<?= $index ?>" class="delete">Delete</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>