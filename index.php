<?php 
require('Team.class.php');
require('Match.class.php');

$eighth_round = [];
$semi_final = [];
$final = [];
$third_place = [];
$winner = '';
$third_place_winner = '';
$sixteenth_round = [
            'Germany', 'Italian', 'Uruguay', 'Ireland',
            'Argentina', 'Czech', 'England', 'Clube Atlético Mineiro',
            'City of Liverpool', 'Costa Rica','Brazil', 'Yugoslavia',
            'Rome', 'Spain','Netherland', 'Sweden'
        ];



$testCase = 0;
$totalCases = 0;

if(isset($_POST['submit-start'])){
    $totalCases = htmlspecialchars($_POST['testCase']);
}

while ($testCase < $totalCases){
    shuffle($sixteenth_round);
    echo "<h1>Case (" . ($testCase + 1) . ") </h1><br>";
    Match::playLeague('Sixteenth round', $sixteenth_round, $eighth_round);
    Match::playLeague('Eighth round', $eighth_round, $semi_final);
    Match::playLeague('Semi_final', $semi_final, $final, $third_place);
    Match::playLeague('Final', $final, $winner);
    Match::playLeague('Third_place', $third_place, $third_place_winner);

    echo "The FIFA World Cup Champion is :<strong> $winner </strong><br>";
    echo "The 3rd place is : <strong> $third_place_winner </strong><br>";

    $eighth_round = [];
    $semi_final = [];
    $final = [];
    $third_place = [];
    $winner = '';
    $third_place_winner = '';

    $testCase++;
}
?>

<!-- Bootstrap 5.0.2 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">

<div class="container bg-info fixed-top p-4">  
    <div class="mx-auto text-center">
        <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" name="form">
            <input type=number class="" name="testCase" min="1" max="100" value="<?= $totalCases; ?>" />
            <input type="submit" class="btn btn-success" value="Start" name="submit-start" />
        </form>
    </div>
</div>
