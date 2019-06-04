<?php

namespace App;

class WilsonConfidence
{
    /**
     * Computed value for confidence (z)
     *
     * These values were computed using Ruby's Statistics2.pnormaldist function
     * 1.959964 = 95.0% confidence
     * 2.241403 = 97.5% confidence
     */
    private const CONFIDENCE = 2.241403;
    public function getScore(int $positiveVotes, int $totalVotes, float $confidence = self::CONFIDENCE) : float
    {
        return (float) $totalVotes ? $this->lowerBound($positiveVotes, $totalVotes, $confidence) : 0;
    }
    private function lowerBound(int $positiveVotes, int $totalVotes, float $confidence) : float
    {
        $phat        = 1.0 * $positiveVotes / $totalVotes;
        $numerator   = $this->calculationNumerator($totalVotes, $confidence, $phat);
        $denominator = $this->calculationDenominator($totalVotes, $confidence);
        return $numerator / $denominator;
    }
    private function calculationDenominator(int $total, float $z) : float
    {
        return 1 + $z * $z / $total;
    }
    private function calculationNumerator(int $total, float $z, float $phat) : float
    {
        return $phat + $z * $z / (2 * $total) - $z * sqrt(($phat * (1 - $phat) + $z * $z / (4 * $total)) / $total);
    }
}