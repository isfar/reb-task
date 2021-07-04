<?php

$per_page = 10;
/** @var PDO $pdo */
$stmt = $pdo->query('SELECT COUNT(*) FROM largeTable');
$total_results = $stmt->fetchColumn();
$total_pages = ceil($total_results / $per_page);

$stmt = $pdo->prepare('SELECT * FROM largeTable ORDER BY id DESC LIMIT ? OFFSET ?');

foreach (range(1, $total_pages) as $current_page) {
    $offset = ($current_page - 1) * $per_page; 

    $stmt->execute([$per_page, $offset]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $result) {
        // manipulate the data here
    }
}
