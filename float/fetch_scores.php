
<?php
require('../db/db_connection.php');

$sql = "SELECT entry_num, 
               AVG(overall_appearance) AS avg_oa, 
               AVG(artistry_design) AS avg_ad, 
               AVG(craftsmanship) AS avg_cr, 
               AVG(relevance_theme) AS avg_rt,
               (AVG(overall_appearance) + AVG(artistry_design) + AVG(craftsmanship) + AVG(relevance_theme)) AS avg_total 
        FROM scores 
        GROUP BY entry_num 
        ORDER BY avg_total DESC";

$result = $conn->query($sql);

$scores = [];
$ranking = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['ranking'] = $ranking++;
        $scores[] = $row;
    }
}


$judge_query = "SELECT name FROM user WHERE role = 1"; 
$judge_result = $conn->query($judge_query);

$judges = [];
if ($judge_result->num_rows > 0) {
    while ($judge_row = $judge_result->fetch_assoc()) {
        $judges[] = $judge_row['name'];
    }
}

$conn->close();
?>
