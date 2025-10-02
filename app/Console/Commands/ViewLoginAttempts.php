<?php

namespace App\Console\Commands;

use App\Models\AdminLoginAttempt;
use Illuminate\Console\Command;

class ViewLoginAttempts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:view-login-attempts {--recent : Afficher seulement les 24 dernières heures}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Affiche l\'historique des tentatives de connexion admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('📊 Historique des tentatives de connexion admin');
        $this->newLine();

        $query = AdminLoginAttempt::query()->orderBy('attempted_at', 'desc');

        if ($this->option('recent')) {
            $query->where('attempted_at', '>=', now()->subDay());
        }

        $attempts = $query->take(50)->get();

        if ($attempts->isEmpty()) {
            $this->warn('Aucune tentative de connexion enregistrée.');
            return Command::SUCCESS;
        }

        $headers = ['ID', 'IP', 'Status', 'Date', 'User Agent'];
        $rows = [];

        foreach ($attempts as $attempt) {
            $rows[] = [
                $attempt->id,
                $attempt->ip_address,
                $attempt->success ? '✅ Succès' : '❌ Échec',
                $attempt->attempted_at->format('Y-m-d H:i:s'),
                substr($attempt->user_agent ?? 'N/A', 0, 50) . '...'
            ];
        }

        $this->table($headers, $rows);

        // Statistiques
        $this->newLine();
        $totalAttempts = $attempts->count();
        $successCount = $attempts->where('success', true)->count();
        $failCount = $attempts->where('success', false)->count();

        $this->info("Total: {$totalAttempts} tentatives");
        $this->info("✅ Réussies: {$successCount}");
        $this->error("❌ Échouées: {$failCount}");

        return Command::SUCCESS;
    }
}
