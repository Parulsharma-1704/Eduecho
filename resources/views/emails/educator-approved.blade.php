@component('mail::message')
# Welcome to EduEcho, {{ $user->name }}!

We are thrilled to inform you that your educator application has been **approved**! 

You now have full access to your educator dashboard, where you can:
- Create and manage specialized courses.
- Track student progress and engagement.
- Access disability-aware teaching resources.
- Collaborate with students and other professionals.

@component('mail::button', ['url' => route('dashboard')])
Access Your Dashboard
@endcomponent

Thank you for joining our mission to provide inclusive education for everyone.

Best regards,<br>
The EduEcho Team
@endcomponent
