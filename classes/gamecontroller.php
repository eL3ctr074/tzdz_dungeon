<?php

require 'room.php';
require 'dungeon.php';
require 'player.php';

class GameController {
    private $dungeon;
    private $path = [];

    public function __construct($dungeonData) {
        $layout = $this->parseDungeonData($dungeonData);
        $this->dungeon = new Dungeon($layout);
    }

    private function parseDungeonData($data) {
        $layout = [];
        foreach ($data as $coords => $roomData) {
            $coords = explode(',', $coords);
            $x = (int)$coords[0];
            $y = (int)$coords[1];
            $content = isset($roomData['content']) ? $roomData['content'] : null;
            $layout[$y][$x] = new Room($roomData['type'], $roomData['content']);
        }
        return $layout;
    }

    public function movePlayer($direction) {
        try {
            $this->dungeon->move($direction);
            $this->path[] = $direction;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getScore() {
        return $this->dungeon->getPlayerScore();
    }

    public function getPath() {
        return $this->path;
    }
}
