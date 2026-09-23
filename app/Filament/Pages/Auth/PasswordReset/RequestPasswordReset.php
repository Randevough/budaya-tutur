<?php

namespace App\Filament\Pages\Auth\PasswordReset;

use Filament\Auth\Pages\PasswordReset\RequestPasswordReset as BaseRequestPasswordReset;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;

class RequestPasswordReset extends BaseRequestPasswordReset
{
    protected string $view = 'filament.pages.auth.password-reset.request-password-reset';

    public bool $emailSent = false;
    public ?string $sentEmail = null;

    public function getHeading(): string | Htmlable | null
    {
        return '';
    }

    public function getSubheading(): string | Htmlable | null
    {
        return '';
    }

    public function hasLogo(): bool
    {
        return false;
    }

    public function request(): void
    {
        // Capture submitted email before executing the broker request
        $formData = $this->form->getState();
        $this->sentEmail = $formData['email'] ?? null;

        parent::request();
    }

    protected function getSentNotification(string $status): ?Notification
    {
        // When broker confirms link dispatch, activate the modal confirmation state
        $this->emailSent = true;

        return parent::getSentNotification($status);
    }

    public function resetConfirmation(): void
    {
        $this->emailSent = false;
    }
}
