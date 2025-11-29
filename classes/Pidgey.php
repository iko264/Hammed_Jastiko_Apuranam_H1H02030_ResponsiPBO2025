<?php
require_once __DIR__ . '/FlyingPokemon.php';

class Pidgey extends FlyingPokemon {

    public function __construct($level = 5) {
        $this->name = "Pidgey";
        $this->type = "Normal / Flying";
        $this->level = max(1, (int)$level);

        $this->hp = 40;
        $this->attack = 45;
        $this->defense = 40;
        $this->speed = 56;

        $this->specialMove = "Gust";
    }

    public function specialMove() {
        return "Pidgey uses " . $this->specialMove . " — flapping wings to create a gust of wind.";
    }

    public function train($type, $intensity) {
        if (strtolower($type) === 'speed') {
            $intensity = $intensity + intdiv($intensity, 5);
        }
        return parent::train($type, $intensity);
    }
}
