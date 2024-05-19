<?php
class Player {
    private $score = 0;

    public function addScore($points) {
        $this->score += $points;
    }

    public function getScore() {
        return $this->score;
    }
}
