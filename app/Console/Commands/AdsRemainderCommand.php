<?php

namespace App\Console\Commands;

use App\Mail\AdsRemainderMail;
use App\Models\Ad;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class AdsRemainderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads:remainder';

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
        Ad::whereDate('start_date', Carbon::now()->addDays(1)->format('Y-m-d'))->chunk(100, function ($ads) {
            foreach ($ads as $ad) {
                Mail::to($ad->user)->send(new AdsRemainderMail($ad));

                $this->info('AD #'.$ad->id);
            }
        });

        $this->info('Successfully sent daily email to everyone.');
    }
}
