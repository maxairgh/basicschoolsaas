<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use App\Mail\NewUserAccountCreatedEmail;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function handleRecordCreation(array $data): Model
{
    $user = static::getModel()::create($data);
    ///send password reset email to the user
     $token = Password::broker()->createToken($user);
     $password_reset_link = Filament::getPanel('school')->getResetPasswordUrl($token, $user); 
     $loginlink = Filament::getPanel('school')->getLoginUrl();
      Mail::to($user->email)->queue(new NewUserAccountCreatedEmail($user, $password_reset_link, $loginlink));
     return $user;
}

protected function mutateFormDataBeforeCreate(array $data): array
{
  
    $data['user_id'] = auth()->user()->id;
    $data['school_id'] = auth()->user()->school_id;
    $data['password'] = Hash::make(str()->random(8));
   
    return $data;
}
}
