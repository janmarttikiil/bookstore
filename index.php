<?php

require "connection.php";

$stmt = $pdo->query('SELECT id, title, is_deleted FROM books WHERE is_deleted = 0');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
</head>
<body>
    <h1>books</h1>

    <ul>
        <?php while ($row = $stmt->fetch()): ?>
            <li>
                <a href="book.php?id=<?= (int) $row['id'] ?>">
                    <?= $row['title'] ?>
                </a>
            </li>
        <?php endwhile; ?>
    </ul>

</body>
</html>