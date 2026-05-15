<x-mail::message>
# Application Received

Hello {{ $user->name }},

Thank you for applying to join **EduEcho** as a specialized educator. 

Your application is currently being reviewed by our administration team. This process typically takes 24-48 hours.

Once your application is approved, you will receive another email and gain full access to the educator dashboard.

In the meantime, you can log in to check your status, but you won't be able to access educational tools until approval.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
