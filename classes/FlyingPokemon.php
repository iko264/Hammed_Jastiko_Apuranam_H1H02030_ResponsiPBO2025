<?php
require_once __DIR__ . '/Pokemon.php';

class FlyingPokemon extends Pokemon {
    protected $wingPower;

    public function __construct() {
        $this->wingPower = 10;
    }

    public function flyBoost() {
        $this->speed += 3;
    }

    public function specialMove() {
        return "Fly (base) - a flying move.";
    }
}
