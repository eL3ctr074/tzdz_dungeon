<?php

class Dungeon {
    private $layout;
    private $player;
    private $position;

    public function __construct($layout) {
        $this->layout = $layout;
        $this->player = new Player();
        $this->position = [0, 0];
    }

    public function move($direction) {
        $x = $this->position[0];
        $y = $this->position[1];
        
        switch ($direction) {
            case 'up':
                $y--;
                break;
            case 'down':
                $y++;
                break;
            case 'left':
                $x--;
                break;
            case 'right':
                $x++;
                break;
            default:
                throw new Exception('Неверное направление');
        }

        if (isset($this->layout[$y][$x])) {
            $this->position = [$x, $y];
            $room = $this->layout[$y][$x];
            $room->interact($this->player);
        } else {
            throw new Exception('Невозможно двигаться в данном направлении');
        }
    }

    public function getPlayerScore() {
        return $this->player->getScore();
    }

    public function getPosition() {
        return $this->position;
    }
}
