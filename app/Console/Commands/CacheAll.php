<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CacheAll extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run config:cache, route:cache, and view:cache, config:clear';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('config:cache');
        $this->call('config:clear');
        $this->call('route:cache');
        $this->call('view:cache');
        
        $this->info('All caches have been refreshed!');
        return 0;
    }
}
