<?php


namespace App\Models;


trait XpTrait
{
    public function currentXp()
    {
        if($this->currentLevel() == 1) return $this->quantityOfExperience();
        return $this->quantityOfExperience() - Progress::get($this->currentLevel() - 1);
    }

    public function quantityOfExperience()
    {
        $total = 0;
        foreach($this->experiences as $experience)
            $total += $experience->value;

        return $total;
    }

    public function xpForNextLevel($level)
    {
        if($level == 1) return Progress::get(1);
        return Progress::get($level) - Progress::get($level - 1);
    }

    public function currentLevel()
    {
        $actual = $this->quantityOfExperience();
        $ant = 1;
        foreach(Progress::get() as $key => $value) {
            $ant = $key;
            if ($actual < $value) {
                return $ant;
            }
        }
        return $ant;
    }
}