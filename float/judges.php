<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judge Tabulation Sheet</title>
    <link rel="stylesheet" href="/float/css/float.css?v=1.0">
    <style>
        .top10 {
            background-color: white;
            color: black;
        }

        .judge-signatures {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
        }

        .judge-signature {
            text-align: center;
            width: 45%;
        }

        .judge-signature .line {
            border-bottom: 1px solid black;
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="tnalaklogo">
        <img src="../tnalak.png" alt="t'nalak image">
    </div>
    <div class="emblem">
        <img src="../emblem.png" alt="t'nalak image">
    </div>

    <div class="container">
        <h1>Judge Tabulation Sheet</h1>

        <?php
        // Include database connection
        require('../db/db_connection.php');

        // Function to fetch scores for a specific judge
        function fetchScoresForJudge($conn, $judgeName)
        {
            // Prepare SQL query to fetch scores for the judge
            $query = "SELECT entry_num, overall_appearance, artistry_design, craftsmanship, relevance_theme FROM scores WHERE judge_name = ?";
            $stmt = $conn->prepare($query);
            if ($stmt === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }

            // Bind parameters and execute query
            $stmt->bind_param("s", $judgeName);
            $stmt->execute();
            $stmt->bind_result($entry_num, $overall_appearance, $artistry_design, $craftsmanship, $relevance_theme);

            // Fetch results into an array
            $scores = [];
            while ($stmt->fetch()) {
                $total_score = $overall_appearance + $artistry_design + $craftsmanship + $relevance_theme;
                $scores[$entry_num] = [
                    'total_score' => $total_score
                ];
            }

            // Close statement
            $stmt->close();
            return $scores;
        }

        // Array of judges and their respective column headers
        $judges = [
            'Ben Florence' => 'JUDGE 1',
            'CJ Buendicho' => 'JUDGE 2',
            'Stanley Gonatice' => 'JUDGE 3' // Adjust if you have a third judge
        ];

        // Get unique entry numbers across all judges
        $unique_entry_nums = [];
        foreach ($judges as $judgeName => $columnName) {
            $scores = fetchScoresForJudge($conn, $judgeName);
            foreach ($scores as $entry_num => $score) {
                if (!isset($unique_entry_nums[$entry_num])) {
                    $unique_entry_nums[$entry_num] = [
                        'scores' => [],
                        'total_score' => 0
                    ];
                }
                $unique_entry_nums[$entry_num]['scores'][$columnName] = $score['total_score'];
                $unique_entry_nums[$entry_num]['total_score'] += $score['total_score'];
            }
        }

        // Sort entries by total score in descending order
        usort($unique_entry_nums, function ($a, $b) {
            return $b['total_score'] - $a['total_score'];
        });

        // Assign ranks
        $rank = 1;
        foreach ($unique_entry_nums as &$entry) {
            $entry['rank'] = $rank++;
        }

        // Start table
        echo "<table>";
        echo "<thead><tr><th>Entry No.</th><th>JUDGE 1</th><th>JUDGE 2</th><th>JUDGE 3</th><th>Total</th><th>Rank</th></tr></thead>";
        echo "<tbody>";

        // Display each unique entry number with scores and rank
        foreach ($unique_entry_nums as $entry_num => $data) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($entry_num) . "</td>";
            echo "<td>" . (isset($data['scores']['JUDGE 1']) ? htmlspecialchars($data['scores']['JUDGE 1']) : '') . "</td>";
            echo "<td>" . (isset($data['scores']['JUDGE 2']) ? htmlspecialchars($data['scores']['JUDGE 2']) : '') . "</td>";
            echo "<td>" . (isset($data['scores']['JUDGE 3']) ? htmlspecialchars($data['scores']['JUDGE 3']) : '') . "</td>";
            echo "<td>" . htmlspecialchars($data['total_score']) . "</td>";
            echo "<td>" . htmlspecialchars($data['rank']) . "</td>";
            echo "</tr>";
        }

        // End table
        echo "</tbody></table>";

        // Close database connection
        $conn->close();
        ?>

    </div>

</body>

</html>
