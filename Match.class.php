<?php 
class Match {
    private $goal_t1 = 0;
    private $goal_t2 = 0;
    private $team_1, $team_2;


    public function __construct(object $team_1, object $team_2)
    {
        self::getGoal();
        $this->team_1 = $team_1;
        $this->team_2 = $team_2;
    }


    public function getGoal(){
        $this->goal_t1 = rand(1, 10);
        $this->goal_t2 = rand(1, 10);

        // do getGoal() again if goal_t1 is equal to goal_t2;
        return $this->goal_t1 !== $this->goal_t2 ?: self::getGoal();
    }


    public function getGoal_team_1(){
        return $this->goal_t1;
    }


    public function getGoal_team_2(){
        return $this->goal_t2;
    }


    public function getTeam_1(){
        return $this->team_1->getTeamAcronym();
    }


    public function getTeam_2(){
        return $this->team_2->getTeamAcronym();
    }


    public static function playLeague($roundName, array $round, &$winner,  array &$third_place = []){
        echo "__________ $roundName __________ <br>";
    
        for($i = 0; $i < count($round); $i++){
            $team_1 = new Team($round[0]);
            $team_2 = new Team($round[1]);
            $match = new Match($team_1, $team_2);

            // Puts the winner in the array
            self::setWinners($match, $winner, $third_place);

            echo '<p>' . $match->getTeam_1() . ' ' . $match->getTeam_2() . ' ' . $match->getGoal_team_1() . ' ' . $match->getGoal_team_2() . '</p>' ;
            array_shift($round);
            array_shift($round);

            $i = 0; // reset for the next match
        }
    }
    

    // Puts the winner in the array
    // Set third_place parameter only in the semi-final round
    public static function setWinners(object $match, &$winner, &$third_place = []) {
        // Team_1 is the winner
        if( $match->getGoal_team_1() > $match->getGoal_team_2() ){
            is_array($winner) ? array_push($winner, $match->getTeam_1()) : $winner = $match->getTeam_1();
            array_push($third_place, $match->getTeam_2()); // push loser to array $third_place

        // Team_2 is the winner
        } else if ( $match->getGoal_team_1() < $match->getGoal_team_2() ) {
            is_array($winner) ? array_push($winner, $match->getTeam_2()) : $winner = $match->getTeam_2();
            array_push($third_place, $match->getTeam_1()); // push loser to array $third_place
        }
    }

}
