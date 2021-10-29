<?php

namespace App\Jobs;

use App\Models\Scooter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class removeBooking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $scooter_id;


    public function __construct($scooter_id)
    {
        $this->scooter_id = $scooter_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $scooter = Scooter::find($this->scooter_id);
        $scooter->is_booking = 0;
        $scooter->customerBook = null;
        $scooter->save();
    }
}
