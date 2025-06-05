<?php



namespace App\Notifications;

use App\Models\Publicite;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class PubliciteValidee extends Notification
{
    use Queueable;

    public Publicite $publicite;

    /**
     * Crée une nouvelle instance de notification.
     */
    public function __construct(Publicite $publicite)
    {
        $this->publicite = $publicite;
    }

    /**
     * Canaux utilisés (base de données uniquement).
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Représentation en base de données.
     */
    public function toDatabase($notifiable): array
    {
        return [
            'message' => "🎉 Votre publicité « {$this->publicite->titre} » a été validée !",
            'publicite_id' => $this->publicite->id,
            'publicite_slug' => $this->publicite->slug ?? null,
        ];
    }
}
