<?php

require "connection.php";

$id = $_GET['id'];

$stmt = $pdo->prepare('SELECT id, title, release_date, cover_path, language, summary, price, stock_saldo, pages, type FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$stmt = $pdo->prepare('
    SELECT book_authors.id AS book_author_id, authors.first_name, authors.last_name
    FROM authors
    JOIN book_authors ON authors.id = book_authors.author_id
    WHERE book_authors.book_id = :id
');

$stmt->execute(['id' => $id]);
$authors = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
  <body>
    <button onclick="window.location.href='book.php?id=<?= $book['id'] ?>'">Back</button>
    <h1>Id: <?= $book['id'] ?></h1>
      <form method="post" action="update_book.php">
        <input type="hidden" name="id" value="<?= $book['id'] ?>">
          <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="<?= $book['title'] ?>"><br><br>
          <label for="release_date">Release date:</label>
        <input type="text" id="release_date" name="release_date" value="<?= $book['release_date'] ?>"><br><br>
          <label for="cover_path">Cover path:</label>
        <input type="text" id="cover_path" name="cover_path" value="<?= $book['cover_path'] ?>"><br><br>
          <label for="language">Language:</label>
        <input type="text" id="language" name="language" value="<?= $book['language'] ?>"><br><br>
          <label for="summary">Summary:</label>
        <input type="text" id="summary" name="summary" value="<?= $book['summary'] ?>"><br><br>
          <label for="price">Price:</label>
        <input type="text" id="price" name="price" value="<?= round($book['price'], 2) ?>"><br><br>
          <label for="stock_saldo">Stock saldo:</label>
        <input type="text" id="stock_saldo" name="stock_saldo" value="<?= $book['stock_saldo'] ?>"><br><br>
          <label for="pages">Pages:</label>
        <input type="text" id="pages" name="pages" value="<?= $book['pages'] ?>"><br><br>
        <input type="submit" value="Submit">
      </form>
      <br>
      <h1>Authors</h1>

      <ul>
        <?php foreach ($authors as $author) { ?>
          <form method="post" action="remove_author.php">
            <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <li>
              <input type="hidden" name="book_author_id" value="<?= (int) $author['book_author_id'] ?>">
              <?= $author['first_name'] ?> <?= $author['last_name'] ?> 
              <button type="submit">X</button>
            </li>
          </form>
        <?php } ?>
      </ul>

  </body>
</html>