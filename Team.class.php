<?php 
class Team {
    private $name = '';
    private $acronym = '';


    public function __construct(string $name){
        $name = trim($name);
        $this->name = $name;

        if (strpos($name, ' ') !== false) {
            $words = explode(" ", $name);
            foreach ($words as $word) {
                $this->acronym .= strtoupper($word[0]);
            }
            
            // fill the acronym if length less then 3 Characters
            $this->acronym = strlen($this->acronym) < 2 ?: strtoupper(substr($this->acronym . $word[count($words)-1], 0, 3));

        }else {
            $this->acronym = strtoupper(substr($name, 0, 3));
        }
    }


    public function getTeamName() {
        return $this->name;
    }
    

    public function getTeamAcronym() {
        return $this->acronym;
    }
    
}

?>