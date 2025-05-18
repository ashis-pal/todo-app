<?php
function loadTasks() {
    $tasks = file_get_contents('tasks.json');
    return json_decode($tasks, true);
}

function saveTasks($tasks) {
    file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));
}
?>