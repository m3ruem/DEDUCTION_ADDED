<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JUDGING SHEET</title>
    <link rel="stylesheet" href="/float/css/float.css?v=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        .top10 {
            background-color: blue;
            color: white;
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

        .button {
            display: inline-block;
            border-radius: 4px;
            background-color: #e7ecef;
            border: none;
            color: #030404;
            text-align: center;
            font-size: 28px;
            padding: 20px;
            width: 200px;
            transition: all 0.5s;
            cursor: pointer;
            margin: 5px;

        }

        .button span {
            cursor: pointer;
            display: inline-block;
            position: relative;
            transition: 0.5s;
        }

        .button span:after {
            content: '\00bb';
            position: absolute;
            opacity: 0;
            top: 0;
            right: -20px;
            transition: 0.5s;
        }

        .button:hover span {
            padding-right: 25px;
        }

        .button:hover span:after {
            opacity: 1;
            right: 0;
        }

        .no-underline {
            text-decoration: none;

        }
    </style>
</head>

<body>

    <div class="tnalaklogo">
        <img src="../tnalak.png" alt="t'nalak image">

    </div>
    <div class="twobuttons" style="margin-bottom:83vh; margin-top:0vh">
        <a href="/float/overallranking.php"><button class="button" style="margin-bottom:10%;"><strong>Overall Results</strong></button></a>

        <!-- <button class="button button5">BACK</button> -->
    </div>
    <div class="emblem">
        <img src="../emblem.png" alt="t'nalak image">
    </div>

    <div class="container_ranking">
        <h1>FLOAT COMPETITION</h1>
        <h1>JUDGING SHEET</h1>
        <!-- <table>
            <thead>
                <tr>
                    <th>Entry No.</th>
                    <th>Overall Appearance and Impact (30%)
                        <p>(Overall look, aesthetic value, and attractiveness of the float)</p>
                    </th>
                    <th>Artistry/Design (20%)
                        <p>(Concept and artistic merits of the design and costumes if there is/are any taking into account balance, proportion, emphasis, harmony as primarily reflected in shapes/image and colors)</p>
                    </th>
                    <th>Craftsmanship (30%)
                        <p>(This pertains to how the design is realized and how the float is made. Such factors to be considered are the quality of the craftsmanship, stability of structure and decoration, choice, and creative use of materials)</p>
                    </th>
                    <th>Relevance to the Festive Theme (20%)
                        <p>"Onward South Cotabato: Dreaming Big, Weaving more progress. Rising above challenges"</p>
                    </th>
                    <th>Total</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'fetch_scores.php';
                foreach ($scores as $score) {
                    $class = $score['ranking'] <= 10 ? 'top10' : '';
                    echo "<tr class='{$class}'>";
                    echo "<td>" . htmlspecialchars($score['entry_num']) . "</td>";
                    echo "<td>" . htmlspecialchars($score['avg_oa']) . "</td>";
                    echo "<td>" . htmlspecialchars($score['avg_ad']) . "</td>";
                    echo "<td>" . htmlspecialchars($score['avg_cr']) . "</td>";
                    echo "<td>" . htmlspecialchars($score['avg_rt']) . "</td>";
                    echo "<td>" . htmlspecialchars($score['avg_total']) . "</td>";
                    echo "<td>" . htmlspecialchars($score['ranking']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table> -->
        <div class="judge-signatures">
            <?php $judgeCount = 1;
            foreach ($judges as $judge) : ?>
                <div class="judge-signature" style="font-family:Kanit, sans-serif; text-decoration:none">
                    <a href="/float/indivscores.php?judge=<?php echo $judge; ?>" class="no-underline">
                        <img src="/images/tnalakfest.png" style="height:auto; width:70%" alt="">
                        <p style="font-size:100%"><?php echo htmlspecialchars($judge); ?></p>
                    </a>
                    <p style="font-size:20px">judge <?php echo $judgeCount; ?></p>
                </div>
            <?php $judgeCount++;
            endforeach; ?>
        </div>
    </div>

</body>

</html>