<?php 

require "connection.php";

$book_author_id = $_POST['book_author_id'];
$id = $_POST['id'];

$stmt = $pdo->prepare('DELETE FROM book_authors WHERE id = :book_author_id');
$stmt->execute(['book_author_id' => $book_author_id]);

header("Location: edit.php?id=$id&remove_author=success");