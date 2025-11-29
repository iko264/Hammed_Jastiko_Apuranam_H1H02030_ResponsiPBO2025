<?php
abstract class Pokemon {
    protected $name;
    protected $type;
    protected $level;
    protected $hp;
    protected $attack;
    protected $defense;
    protected $speed;
    protected $specialMove;

    public function getData() {
        return [
            "name" => $this->name,
            "type" => $this->type,
            "level" => $this->level,
            "hp" => $this->hp,
            "attack" => $this->attack,
            "defense" => $this->defense,
            "speed" => $this->speed,
            "specialMove" => $this->specialMove
        ];
    }

    abstract public function specialMove();

    public function train($type, $intensity) {
        $before = [
            "level" => $this->level,
            "hp" => $this->hp
        ];

        $intensity = max(1, (int)$intensity);

        if ($type == "Attack") {
            $this->attack += intdiv($intensity, 2);
            $this->level += intdiv($intensity, 20) > 0 ? intdiv($intensity, 20) : 1;
            $this->hp += intdiv($intensity, 5);
        }

        if ($type == "Defense") {
            $this->defense += intdiv($intensity, 2);
            $this->level += intdiv($intensity, 20) > 0 ? intdiv($intensity, 20) : 1;
            $this->hp += intdiv($intensity, 4);
        }

        if ($type == "Speed") {
            $this->speed += intdiv($intensity, 2);
            $this->level += intdiv($intensity, 15) > 0 ? intdiv($intensity, 15) : 1;
            $this->hp += intdiv($intensity, 6);
        }

        $after = [
            "level" => $this->level,
            "hp" => $this->hp
        ];

        return [$before, $after];
    }
}
