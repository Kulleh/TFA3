<!DOCTYPE html>
<html>

<head>
    <title>New User</title>
</head>

<body>

    <h1>New User</h1>

    <nav>
        <a href="/">Home</a> |
        <a href="/tasks">Task List</a> |
        <a href="/profile">Profile</a> |
        <a href="/about">About</a>
        <a href="/customers">Customer Accounts</a> |
        <a href="/users">User Accounts</a>
    </nav>

    <hr>

    <form method="post" action="<?= site_url('/users') ?>">

        <?= csrf_field() ?>

        <label for="username">Username:</label><br>
        <input
            type="text"
            name="username"
            value="<?= old('username') ?>">
            <?= validation_show_error('username') ?>

        <br><br>

        <label for="full_name">Full Name:</label><br>
        <input
            type="text"
            name="full_name"
            value="<?= old('full_name') ?>">
            <?= validation_show_error('full_name') ?>

        <br><br>

        <button type="submit">Add User</button>
        <a href="<?= site_url('/users') ?>">Cancel</a>

    </form>

</body>

</html>