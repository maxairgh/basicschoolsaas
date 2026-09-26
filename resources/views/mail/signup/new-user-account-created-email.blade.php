[x-mail::message](x-mail::message)

# 🎉 Welcome, {{ $user->first_name }}!

Your user account has been successfully created on **{{ config('app.name') }}**.

You can now access the platform using your account details below.

[x-mail::panel](x-mail::panel)
**Account Information**

**Name:** {{ $user->first_name }} {{ $user->last_name }}

**Email:** {{ $user->email }}

@if (!empty($user->username))
**Username:** {{ $user->username }}
@endif
</x-mail::panel>

## 🔐 Set Your Password

For your security, please set a password for your account by clicking the button below.

<x-mail::button :url="$passwordResetLink">
Set My Password
</x-mail::button>

Once your password has been set, you can sign in to your account.

<x-mail::button :url="$loginLink">
Sign In to Your Account
</x-mail::button>

[x-mail::panel](x-mail::panel)
**🛡️ Security Notice**

If you did not expect this account to be created, please contact your system administrator immediately.

For your security, never share your password or password-reset link with anyone.
</x-mail::panel>

If you're having trouble clicking the buttons above, copy and paste the following links into your browser:

**Password Reset:**
{{ $passwordResetLink }}

**Login:**
{{ $loginLink }}

Thank you,

**{{ config('app.name') }}**

</x-mail::message>
