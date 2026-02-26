<?php

namespace App\Console\Commands;

use App\Models\VideoRequest;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireVideoRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'video-request:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire approved video requests that passed access_end time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expiredCount = VideoRequest::where('status', 'approved')
            ->whereNotNull('access_end')
            ->where('access_end', '<', Carbon::now())
            ->update([
                'status' => 'expired',
            ]);

        $this->info("Expired {$expiredCount} video request(s).");

        return Command::SUCCESS;
    }
}
