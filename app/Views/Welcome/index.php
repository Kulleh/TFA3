<!DOCTYPE html>
<html>

<head>
    <title>Tasks for Today</title>
</head>

<body>

    <h1>Tasks for Today</h1>

    <a href="/">Home</a> |
    <a href="/tasks">Task List</a> |
    <a href="/profile">Profile</a> |
    <a href="/about">About</a>
    <a href="/customers">Customer Accounts</a> |
    <a href="/users">User Accounts</a>

    <hr>

    <?php foreach ($tasks as $task): ?>

        <div>
            <h3><?= esc($task['title']) ?></h3>
            <p>Status: <?= esc($task['status']) ?></p>
            <p>Date: <?= esc($task['task_date']) ?></p>
        </div>

        <hr>

    <?php endforeach; ?>

</body>

</html>