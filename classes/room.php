<?php

class Room {
    private $type;
    private $content;
    private $visited = false;

    public function __construct($type, $content = null) {
        $this->type = $type;
        $this->content = $content;
    }

    public function interact($player) {
        if ($this->visited) {
            return;
        }

        switch ($this->type) {
            case 'treasure':
                $rarity = $this->content;
                $points = $this->generateTreasurePoints($rarity);
                $player->addScore($points);
                break;

            case 'monster':
                $monster = $this->content;
                $this->fightMonster($player, $monster);
                break;

            case 'empty':
                break;
        }

        $this->visited = true;
    }

    private function generateTreasurePoints($rarity) {
        switch ($rarity) {
            case 1:
                return rand(1, 10);
            case 2:
                return rand(11, 20);
            case 3:
                return rand(21, 30);
        }
        return 0;
    }

    private function fightMonster($player, &$monster) {
        while ($monster['strength'] > 0) {
            $roll = rand(1, 100);
            if ($roll > $monster['strength']) {
                $player->addScore($monster['strength']);
                break;
            } else {
                $monster['strength'] -= $monster['decrement'];
            }
        }
    }
}
