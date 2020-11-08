<?php
$PAGE_NAME = "Statistics Page";
$PAGE_HEAD = "<link rel=\"stylesheet\" href=\"/css/statistics.css\" />";
include_once("../lib/head.php");




?>

<!-- Users section -->
<section id="section_user">
    <h3>A few statistics</h3>


    <table>
    <tr>
        <th>Number of registered users </th>
        <th>Average number of followed user by a user </th>
        <th>Average number of review written by a user </th>
    </tr>
        <tr>
    <td><?php
    //Prepare a MySQL request
    $req = $bdd->prepare("SELECT COUNT(*) FROM user;");
    // We execute it
    $req->execute();
    echo round($req->fetch()[0],3);
    ?></td>


    <td><?php
    $nb_follow_req = $bdd->prepare("SELECT COUNT(*) fROM follows");
    $nb_follow_req->execute();
    $nb_follow_res = $nb_follow_req->fetch();

    $nb_user_req = $bdd->prepare("SELECT COUNT(*) FROM user");
    $nb_user_req->execute();
    $nb_user_res = $nb_user_req->fetch();

    $avg = $nb_follow_res[0]/$nb_user_res[0];
    echo round($avg,3);
        ?></td>



    <td><?php
    $nb_review_req = $bdd->prepare("SELECT COUNT(*) fROM review");
    $nb_review_req->execute();
    $nb_review_res = $nb_review_req->fetch();

    $nb_user_req = $bdd->prepare("SELECT COUNT(*) FROM user");
    $nb_user_req->execute();
    $nb_user_res = $nb_user_req->fetch();

    $avg = $nb_review_res[0]/$nb_user_res[0];
    echo round($avg,3);
        ?></td>

    </tr>
    </table>
</section>

<br/>

<!-- Games section -->
<section id="section_game">
    <table>
       <tr><th> Number of registered games </th>
        <th>Average number of review on a game </th>
        <th>Average game score </th>
       </tr>
        <tr>
    <td><?php
    //Prepare a MySQL request
    $req = $bdd->prepare("SELECT COUNT(*) FROM game;");
    // We execute it
    $req->execute();
    echo round($req->fetch()[0],3);
        ?></td>


    <td><?php
    $nb_review_req = $bdd->prepare("SELECT COUNT(*) fROM review");
    $nb_review_req->execute();
    $nb_review_res = $nb_review_req->fetch();

    $nb_game_req = $bdd->prepare("SELECT COUNT(*) FROM game");
    $nb_game_req->execute();
    $nb_game_res = $nb_game_req->fetch();

    $avg = $nb_review_res[0]/$nb_game_res[0];
    echo round($avg,3);
        ?></td>

    <td><?php
    $req = $bdd->prepare("SELECT AVG(a.rcount) FROM (SELECT AVG(score) AS rcount FROM review r GROUP BY r.id_game) a");
    $req->execute();
    echo round($req->fetch()[0],3);
        ?></td>
        </tr>
    </table>
</section>

<!-- Charts section -->

<section>

    <h3>Chart</h3>

    <?php
    $req = $bdd->prepare("SELECT tag.tag_name, COUNT(*) FROM relation_tag INNER JOIN tag ON relation_tag.id_tag=tag.id GROUP BY id_tag;");
    $req->execute();
    ?>



    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {packages: ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            // Define the chart to be drawn.
            var data = new google.visualization.DataTable()
            data.addColumn('string', 'tag_name');
            data.addColumn('number', 'occurence');
            <?php
            while($res = $req->fetch())
            {
                echo "data.addRows([['$res[0]',$res[1]]]);\n";
            }
            ?>

            // Set chart options
            var options = {'title':'Tag occurrence',
                'width':450,
                'height':450};


            // Instantiate and draw the chart.
            var chart = new google.visualization.PieChart(document.getElementById('tag_piechart'));
            chart.draw(data, options);
        }
    </script>

    <table>
        <tr><th>
        <p id="tag_piechart"/>
        </th></tr>
    </table>


</section>


<?php
include_once("../lib/tail.php");
?>
