<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'status',
        'admin_notes',
        'read_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    // Scope pour les devis non lus
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    // Scope pour les devis en attente
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // Marquer comme lu
    public function markAsRead()
    {
        if (!$this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }

    // Obtenir le badge de statut
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'pending' => 'warning',
            'in_progress' => 'info',
            'quoted' => 'primary',
            'accepted' => 'success',
            'rejected' => 'secondary'
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    // Obtenir le libellé du statut
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'En attente',
            'in_progress' => 'En cours',
            'quoted' => 'Devis envoyé',
            'accepted' => 'Accepté',
            'rejected' => 'Refusé'
        ];

        return $labels[$this->status] ?? 'Inconnu';
    }
}
