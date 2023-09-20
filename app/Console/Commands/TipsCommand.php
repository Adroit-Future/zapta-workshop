<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TipsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Yes or no?
        if ($this->confirm('Do you wish to continue?')) {
            $name = $this->anticipate('What is your name?', ['Taylor', 'Dayle']);
            // One of the listed options with default index
            $choice = $this->choice('What is your name?', ['Taylor', 'Dayle'], 0);
            $this->info('Command Run.'.$name);
            $this->info('Choice.'.$choice);
        }
    }
}
