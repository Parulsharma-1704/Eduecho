@component('mail::message')
# Welcome to EduEcho, {{ $user->name }}!

We are pleased to inform you that your therapist application has been **approved**!

You now have full access to your therapist dashboard, where you can:
- Manage therapy sessions with students.
- Update behavioral notes and progress reports.
- Access student disability profiles for personalized care.
- Coordinate with educators and caregivers.

@component('mail::button', ['url' => route('dashboard')])
Access Your Dashboard
@endcomponent

We are excited to have your expertise on our platform to support our students' well-being.

Best regards,<br>
The EduEcho Team
@endcomponent
