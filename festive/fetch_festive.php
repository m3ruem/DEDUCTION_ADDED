<?php
require('../db/db_connection_festive.php');

// Fetch scores and calculate rankings
$sql = "SELECT entry_num, 
               AVG(festive_spirit_of_parade) AS avg_fsp, 
               AVG(costume_and_props) AS avg_cap, 
               AVG(relevance_to_theme) AS avg_rt, 
               (AVG(festive_spirit_of_parade) + AVG(costume_and_props) + AVG(relevance_to_theme)) AS avg_total 
        FROM scores 
        GROUP BY entry_num 
        ORDER BY avg_total DESC";

$result = $conn->query($sql);

$scores = [];
$ranking = 1;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $row['ranking'] = $ranking++;
        $scores[$row['entry_num']] = $row;
    }
}

$score_query = "SELECT entry_num, judge_name, total_score FROM scores";
$score_result = $conn->query($score_query);

$all_scores = [];
if ($score_result->num_rows > 0) {
    while ($score_row = $score_result->fetch_assoc()) {
        $all_scores[$score_row['entry_num']][$score_row['judge_name']] = $score_row['total_score'];
    }
}

$judge_query = "SELECT id, name FROM user WHERE role = 1 ORDER BY id";
$judge_result = $conn->query($judge_query);

$judges = [];
if ($judge_result->num_rows > 0) {
    while ($judge_row = $judge_result->fetch_assoc()) {
        $judges[] = $judge_row;
    }
}

$conn->close();
?>
