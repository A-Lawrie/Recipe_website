<?php

include('db-connect.php');

$sql = "SELECT * FROM users ORDER BY name DESC";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/view-users.css">
</head>
<body>
    <section>
        <h1>User Data</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Profile Photo</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php
            while($rows=$result->fetch_assoc())
            {
            ?>
            <tr>
                <form action="update_user.php" method="post">
                    <td><input type="text" name="name" value="<?php echo $rows['name'];?>"></td>
                    <td><input type="email" name="email" value="<?php echo $rows['email'];?>"></td>
                    <td><input type="text" name="username" value="<?php echo $rows['username'];?>"></td>
                    <td><input type="text" name="profile_photo" value="<?php echo $rows['profile_photo'];?>"></td>
                    <td>
                        <select name="role">
                            <option value="user" <?php if($rows['role'] == 'user') echo 'selected'; ?>>User</option>
                            <option value="admin" <?php if($rows['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                        </select>
                    </td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $rows['id']; ?>">
                        <button type="submit">Update</button>
                        <a href="delete_user.php?id=<?php echo $rows['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </form>
            </tr>
            <?php
            }
            ?>
        </table>
    </section>
</body>
</html>
