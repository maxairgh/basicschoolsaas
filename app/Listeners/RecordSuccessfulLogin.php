<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use Illuminate\Auth\Events\Login;
use Illuminate\Http\Request;

class RecordSuccessfulLogin
{
    public function __construct(
        protected Request $request
    ) {}

    public function handle(Login $event): void
    {
        LoginHistory::create([
            'user_id' => $event->user->id,

            'guard' => $event->guard,

            'authentication_method' => 'password',

            'login_type' => 'web',

            'successful' => true,

            'login_at' => now(),

            'session_id' => $this->request->session()->getId(),

            'ip_address' => $this->request->ip(),

            'user_agent' => $this->request->userAgent(),

            'device_type' => $this->getDeviceType(),

            'platform' => $this->getPlatform(),

            'browser' => $this->getBrowser(),

            'application' => 'Filament Admin',

            'metadata' => [
                'url' => $this->request->fullUrl(),
            ],
        ]);
    }

    protected function getDeviceType(): string
    {
        $userAgent = strtolower(
            $this->request->userAgent() ?? ''
        );

        if (str_contains($userAgent, 'mobile')) {
            return 'mobile';
        }

        if (str_contains($userAgent, 'tablet')) {
            return 'tablet';
        }

        return 'desktop';
    }

    protected function getPlatform(): ?string
    {
        $userAgent = strtolower(
            $this->request->userAgent() ?? ''
        );

        return match (true) {
            str_contains($userAgent, 'windows') => 'Windows',
            str_contains($userAgent, 'android') => 'Android',
            str_contains($userAgent, 'iphone') => 'iOS',
            str_contains($userAgent, 'ipad') => 'iPadOS',
            str_contains($userAgent, 'mac') => 'macOS',
            str_contains($userAgent, 'linux') => 'Linux',
            default => null,
        };
    }

    protected function getBrowser(): ?string
    {
        $userAgent = strtolower(
            $this->request->userAgent() ?? ''
        );

        return match (true) {
            str_contains($userAgent, 'edg') => 'Edge',
            str_contains($userAgent, 'chrome') => 'Chrome',
            str_contains($userAgent, 'firefox') => 'Firefox',
            str_contains($userAgent, 'safari') => 'Safari',
            default => null,
        };
    }
}