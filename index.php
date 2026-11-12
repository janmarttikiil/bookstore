<?php

require "connection.php";

$search = $_GET["search"] ?? "";

if ($search === "") {
    $stmt = $pdo->query(
        "SELECT id, title FROM books WHERE is_deleted = 0"
    );
} else {
    $stmt = $pdo->prepare(
        "SELECT id, title FROM books
         WHERE is_deleted = 0 AND title LIKE :search"
    );

    $stmt->execute(["search" => "%" . $search . "%"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookstore</title>
</head>
<body>

    <form method="get" action="index.php">
        <label for="search">Search book by name:</label>

        <input
            type="search"
            id="search"
            name="search"
            value="<?= $search ?>"
        >

        <button type="submit">Search</button>
    </form>

    <button onclick="window.location.href='author.php'">Create Author</button>

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