<?php

namespace App\Console\Commands;

use App\Models\Agenda;
use Illuminate\Console\Command;

class UpdateAgendaStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'agenda:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update agenda status based on current time';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating agenda status...');
        
        $updated = Agenda::batchUpdateStatus();
        
        $this->info("Updated {$updated} agenda(s) status.");
        
        return Command::SUCCESS;
    }
}