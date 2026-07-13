<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Message;

class ContactService
{
    /**
     * Envoie le message du formulaire de contact par email.
     *
     * @param array{name: string, email: string, subject: string, message: string} $data
     * @throws \Exception
     */
    public function send(array $data): void
    {
        // Destinataire configuré dans les paramètres (ligne unique), sinon repli sur la config/.env
        $adminEmail = Setting::query()->value('contact_email') ?: config('mail.admin_email', env('MAIL_ADMIN_EMAIL'));

        if (!$adminEmail) {
            throw new \RuntimeException('Admin email not configured');
        }

        try {
            // Email à l'admin (Sylvinhio reçoit le message)
            Mail::raw(
                $this->buildAdminMessage($data),
                function (Message $mail) use ($data, $adminEmail): void {
                    $mail->to($adminEmail)
                         ->replyTo($data['email'], $data['name'])
                         ->subject("[Portfolio] {$data['subject']}");
                }
            );

            // Email de confirmation au visiteur
            Mail::raw(
                $this->buildConfirmationMessage($data),
                function (Message $mail) use ($data): void {
                    $mail->to($data['email'], $data['name'])
                         ->subject('Votre message a bien été reçu');
                }
            );

            Log::info('Contact message sent', [
                'from' => $data['email'],
                'subject' => $data['subject'],
            ]);

        } catch (\Exception $e) {
            Log::error('Contact email failed', [
                'from' => $data['email'],
                'error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    /**
     * Construit le message pour l'administrateur
     */
    private function buildAdminMessage(array $data): string
    {
        return <<<TEXT
            Nouveau message depuis le portfolio.

            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            Informations du contact
            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            Nom    : {$data['name']}
            Email  : {$data['email']}
            Sujet  : {$data['subject']}

            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            Message
            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

            {$data['message']}

            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            Ce message a été envoyé depuis le formulaire de contact du portfolio.
        TEXT;
    }

    /**
     * Construit le message de confirmation pour le visiteur
     */
    private function buildConfirmationMessage(array $data): string
    {
        return <<<TEXT
            Bonjour {$data['name']},

            Je vous remercie pour votre message. Je l'ai bien reçu et je vous répondrai dans les plus brefs délais.

            En attendant, n'hésitez pas à consulter mon portfolio pour découvrir mes projets :
            https://sylvinhio.dev

            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            Récapitulatif de votre message :
            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
            Sujet : {$data['subject']}

            {$data['message']}
            ━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

            Cordialement,
            Negoue Tamo Sylvinhio
            Full Stack Software Engineer & Mobile Developer
        TEXT;
    }
}