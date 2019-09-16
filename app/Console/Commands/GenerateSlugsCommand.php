<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use App\Models\Channel;
use App\Models\Character;
use App\Models\Npc;
use App\Models\Session;
use App\Models\User;
use Illuminate\Console\Command;

class GenerateSlugsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:slugs';

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
        $clases = [
            Character::class,
            Npc::class,
            User::class,
            Campaign::class,
            Channel::class,
            Session::class,
        ];

        $items = collect();
        foreach($clases as $class) {
            $this->line("Generando para $class");
            $items = $items->merge($class::all());
        }

        foreach($items as $item) {
            $item->generateTag();
        }

        $this->info('done');
    }
}
