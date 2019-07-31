<?php

namespace App\Console\Commands;

use App\Models\Character;
use App\Models\Npc;
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
        $characters = Character::all();
        $npcs = Npc::all();
        $list = $characters->merge($npcs);
        foreach($list as $node) {
            $node->slug = $node->generateSlug();
            $node->save();
        }

        $this->info('done');
    }
}
