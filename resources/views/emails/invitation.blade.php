<x-mail::message>
# Welcome to EduEcosystem!

You have been invited to join the EduEcosystem platform as a **{{ ucfirst(str_replace('_', ' ', $invitation->role)) }}**.

To complete your registration and set up your account, please click the button below:

<x-mail::button :url="$registrationUrl">
Complete Registration
</x-mail::button>

This invitation link will expire in 7 days.

If you were not expecting this invitation, you can safely ignore this email.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
