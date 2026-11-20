<?php

namespace App\Filament\Admin\Resources\Users\Actions;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Js;

class UserPasswordResetLinkAction
{
    public static function make(): Action
    {
        return Action::make('generatePasswordResetLink')
            ->label('Reset password')
            ->icon(Heroicon::OutlinedKey)
            ->visible(fn (User $record): bool => ! $record->trashed() && filled($record->email))
            ->schema([
                TextInput::make('reset_url')
                    ->label('Password reset link')
                    ->readOnly()
                    ->suffixAction(
                        Action::make('copyResetLink')
                            ->label('Copy reset link')
                            ->icon(Heroicon::OutlinedClipboard)
                            ->alpineClickHandler(function (mixed $state): string {
                                $copyableState = Js::from($state);

                                return <<<JS
                                    const text = {$copyableState};
                                    const showResult = (message) => \$tooltip(message, {
                                        theme: \$store.theme,
                                        timeout: 2000,
                                    });
                                    const fallbackCopy = () => {
                                        const textarea = document.createElement('textarea');
                                        textarea.value = text;
                                        textarea.setAttribute('readonly', '');
                                        textarea.style.position = 'fixed';
                                        textarea.style.opacity = '0';
                                        document.body.appendChild(textarea);
                                        textarea.select();
                                        const copied = document.execCommand('copy');
                                        textarea.remove();
                                        showResult(copied ? 'Reset link copied' : 'Could not copy reset link');
                                    };

                                    if (window.isSecureContext && window.navigator.clipboard?.writeText) {
                                        window.navigator.clipboard.writeText(text)
                                            .then(() => showResult('Reset link copied'))
                                            .catch(fallbackCopy);
                                    } else {
                                        fallbackCopy();
                                    }
                                    JS;
                            })
                    ),
            ])
            ->fillForm(fn (User $record): array => [
                'reset_url' => self::generateUrl($record),
            ])
            ->modalHeading('Password reset link')
            ->modalDescription('Copy this link and share it with the user. Generating another link will invalidate this one.')
            ->modalSubmitAction(false);
    }

    private static function generateUrl(User $user): string
    {
        $panelId = match (true) {
            $user->isSystemUser() => 'admin',
            $user->isParent() => 'parent',
            default => 'school',
        };

        $token = Password::broker()->createToken($user);

        return Filament::getPanel($panelId)->getResetPasswordUrl($token, $user);
    }
}
