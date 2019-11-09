<?php


namespace App\Models;


use App\Models\Experiences\Progress;

trait XpTrait
{
    protected $progress = 'default';

    public function progress($number = null)  {
        return $this->campaign->progress($number);
    }

    public function currentXp()
    {
        if($this->currentLevel() == 1) return $this->quantityOfExperience();
        return $this->quantityOfExperience() - $this->progress($this->currentLevel() - 1);
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
        if($level == 1) return $this->progress(1);
        return $this->progress($level) - $this->progress($level - 1);
    }

    public function currentLevel()
    {
        $actual = $this->quantityOfExperience();
        $ant = 1;
        foreach($this->progress() as $key => $value) {
            $ant = $key;
            if ($actual < $value) {
                return $ant;
            }
        }
        return $ant;
    }
}
