<?php
declare(strict_types=1);

namespace App\Core;

/**
 * Aviso por email usando mail() de PHP. Se puede desactivar con MAIL_ENABLED=false
 * (util en desarrollo o en hostings sin servidor de correo).
 */
final class Mailer
{
    public static function notifyNewLead(array $lead): bool
    {
        if (!Config::bool('MAIL_ENABLED')) {
            return false;
        }

        $to      = (string) Config::get('MAIL_TO', '');
        $from    = (string) Config::get('MAIL_FROM', 'web@localhost');
        $subject = 'Nueva consulta desde el sitio: ' . $lead['name'];

        $body = "Nombre: {$lead['name']}\n"
              . "Email: {$lead['email']}\n"
              . "Negocio: {$lead['company']}\n"
              . "Servicio: {$lead['service']}\n\n"
              . "Mensaje:\n{$lead['message']}\n";

        $headers = [
            'From: ' . $from,
            'Reply-To: ' . $lead['email'],
            'Content-Type: text/plain; charset=UTF-8',
        ];

        return @mail($to, '=?UTF-8?B?' . base64_encode($subject) . '?=', $body, implode("\r\n", $headers));
    }
}
