<?php

namespace App\Console\Commands;

use App\Http\Controllers\PostsController;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class nn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nn';

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
        return Command::SUCCESS;
    }
}
