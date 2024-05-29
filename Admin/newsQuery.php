<?php
require_once('../databaseConn.php');



// Search functionality
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($conn, $_POST['search']); // Sanitize user input
}

$sql = "SELECT * FROM news WHERE title LIKE '%$searchTerm%' OR feed LIKE '%$searchTerm%' ORDER BY date DESC";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<ul class='list-group'>";
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <li class='list-group-item'>
            <a data-bs-toggle='modal' data-bs-target='#viewModal<?php echo $row["id"] ?>'> <?php echo $row['title'] ?> </a> - <?php echo substr($row['feed'], 0, 100) . "</li>"; ?>
    <?php
    }
    echo "</ul>";
} else {
    echo "<p>No results found.</p>";
}
