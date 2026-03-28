<?php

namespace App\Console\Commands;

use App\Jobs\GeneratePostJob;
use Illuminate\Console\Command;

class GenerateDailyPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:generate-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a daily beer post using Gemini Flash AI';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Dispatching daily post generation job...');

        GeneratePostJob::dispatch();

        $this->info('Job dispatched successfully.');

        return 0;
    }
}
