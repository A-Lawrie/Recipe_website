<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'recipe_website';

$mysqli = new mysqli($servername, $username, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$results_per_page = 20;

$sql_count = "SELECT COUNT(*) AS total FROM users";
$result_count = $mysqli->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_results = $row_count['total'];

$total_pages = ceil($total_results / $results_per_page);

if (!isset($_GET['page']) || !is_numeric($_GET['page'])) {
    $page = 1;
} else {
    $page = (int)$_GET['page'];
    if ($page < 1) {
        $page = 1;
    } elseif ($page > $total_pages) {
        $page = $total_pages;
    }
}

$start_from = ($page - 1) * $results_per_page;

$sql_users = "SELECT * FROM users ORDER BY name DESC LIMIT $start_from, $results_per_page";
$result_users = $mysqli->query($sql_users);

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
    <link rel="stylesheet" href="view-users.css">
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
            </tr>
            <?php while ($row = $result_users->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['profile_photo']); ?></td>
                    <td><?php echo htmlspecialchars($row['role']); ?></td>
                </tr>
            <?php } ?>
        </table>

        <div class="links">
            <a href="edit-users.php">Update user data</a>
            <a href="index.html">Back to home</a>
        </div>

        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?php echo $page - 1; ?>">Previous</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <?php if ($i == $page): ?>
                    <strong><?php echo $i; ?></strong>
                <?php else: ?>
                    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <a href="?page=<?php echo $page + 1; ?>">Next</a>
            <?php endif; ?>
        </div>
    </section>
</body>
</html>
