<!DOCTYPE html>
<html>

<head>
    <title>Task List</title>
</head>

<body>

    <h1>Task List</h1>

    <a href="/">Home</a> |
    <a href="/tasks">Task List</a> |
    <a href="/profile">Profile</a> |
    <a href="/about">About</a>
    <a href="/customers">Customer Accounts</a> |
    <a href="/users">User Accounts</a>

    <hr>
    <table border="1" cellpadding="8">
        <thead>
            <tr>
                <th>Title</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= esc($task['title']) ?></td>
                    <td><?= esc($task['status']) ?></td>
                    <td><?= esc($task['task_date']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>