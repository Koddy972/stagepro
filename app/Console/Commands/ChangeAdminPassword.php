<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ChangeAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:change-password';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change le mot de passe administrateur';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔐 Changement du mot de passe administrateur');
        $this->newLine();
        
        $password = $this->secret('Entrez le nouveau mot de passe');
        $confirmPassword = $this->secret('Confirmez le nouveau mot de passe');

        if ($password !== $confirmPassword) {
            $this->error('❌ Les mots de passe ne correspondent pas!');
            return Command::FAILURE;
        }

        if (strlen($password) < 8) {
            $this->error('❌ Le mot de passe doit contenir au moins 8 caractères!');
            return Command::FAILURE;
        }

        // Générer le hash
        $hash = Hash::make($password);

        // Mettre à jour le fichier .env
        $envPath = base_path('.env');
        $envContent = File::get($envPath);

        // Remplacer l'ancien hash
        $pattern = "/ADMIN_PASSWORD_HASH='[^']*'/";
        $replacement = "ADMIN_PASSWORD_HASH='" . $hash . "'";
        $newContent = preg_replace($pattern, $replacement, $envContent);

        File::put($envPath, $newContent);

        $this->info('✅ Mot de passe changé avec succès!');
        $this->newLine();
        $this->warn('⚠️  N\'oubliez pas de redémarrer votre serveur Laravel pour appliquer les changements.');
        
        return Command::SUCCESS;
    }
}
