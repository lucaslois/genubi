<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use Illuminate\Console\Command;
use Facades\App\WilsonConfidence;

class CalculateImportanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:importance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $campaigns = Campaign::all();
        foreach($campaigns as $campaign) {
            $up = $campaign->positives();
            $total = $campaign->positives() + $campaign->negatives();
            $score = WilsonConfidence::getScore($up, $total);
            $campaign->score = round($score, 3);
            $campaign->save();
        }
    }
}
