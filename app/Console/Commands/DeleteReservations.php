<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Réservation::where('created_at', '<=', now()->subDays(2))
        ->delete(); 

    $this->info('Reservations older than 2 days have been deleted.');    }
}
