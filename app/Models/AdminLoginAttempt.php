<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminLoginAttempt extends Model
{
    protected $fillable = [
        'ip_address',
        'success',
        'user_agent',
        'attempted_at'
    ];

    protected $casts = [
        'success' => 'boolean',
        'attempted_at' => 'datetime'
    ];

    /**
     * Enregistrer une tentative de connexion
     */
    public static function logAttempt(string $ipAddress, bool $success, ?string $userAgent = null)
    {
        return self::create([
            'ip_address' => $ipAddress,
            'success' => $success,
            'user_agent' => $userAgent,
            'attempted_at' => now()
        ]);
    }

    /**
     * Obtenir le nombre de tentatives échouées récentes pour une IP
     */
    public static function getRecentFailedAttempts(string $ipAddress, int $minutes = 15): int
    {
        return self::where('ip_address', $ipAddress)
            ->where('success', false)
            ->where('attempted_at', '>=', now()->subMinutes($minutes))
            ->count();
    }

    /**
     * Vérifier si une IP est bloquée
     */
    public static function isBlocked(string $ipAddress, int $maxAttempts = 5, int $minutes = 15): bool
    {
        return self::getRecentFailedAttempts($ipAddress, $minutes) >= $maxAttempts;
    }

    /**
     * Nettoyer les anciennes tentatives (plus de 24h)
     */
    public static function cleanOldAttempts()
    {
        return self::where('attempted_at', '<', now()->subDay())->delete();
    }
}
