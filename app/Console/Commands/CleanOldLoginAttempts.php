<?php

namespace App\Console\Commands;

use App\Models\AdminLoginAttempt;
use Illuminate\Console\Command;

class CleanOldLoginAttempts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:clean-login-attempts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Nettoie les anciennes tentatives de connexion admin (plus de 24h)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧹 Nettoyage des anciennes tentatives de connexion...');
        
        $deleted = AdminLoginAttempt::cleanOldAttempts();
        
        $this->info("✅ {$deleted} tentative(s) supprimée(s) avec succès!");
        
        return Command::SUCCESS;
    }
}
