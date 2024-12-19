<?php

namespace App\Helpers;

use App\Models\EmailConfiguration;

class MailHelper
{
    public static function setMailConfig()
    {
        // Fetch the first email configuration from the database
        $emailSetting = EmailConfiguration::first();

        if ($emailSetting) {
            // Define the mail configuration
            $mailConfig = [
                'transport' => $emailSetting->mail_mailer ?? 'smtp',
                'host' => $emailSetting->mail_host ?? 'smtp.mailtrap.io',
                'port' => $emailSetting->mail_port ?? 2525,
                'encryption' => $emailSetting->mail_encryption ?? null,
                'username' => $emailSetting->mail_username ?? null,
                'password' => $emailSetting->mail_password ?? null,
                'timeout' => null,
            ];

            // Apply mail configuration
            config([
                'mail.mailers.smtp' => $mailConfig,
                'mail.from.address' => $emailSetting->mail_from_address ?? 'example@example.com',
                'mail.from.name' => $emailSetting->mail_from_name ?? 'Example',
            ]);
        }
    }
}
