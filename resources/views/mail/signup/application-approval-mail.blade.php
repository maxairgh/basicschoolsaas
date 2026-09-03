```blade
<x-mail::message>
# 🎉 Your School Has Been Approved!

Dear **{{ $school->contact_person_firstname }} {{ $school->contact_person_lastname }}**,

We are pleased to inform you that the application for **{{ $school->school_name }}** has been reviewed and **successfully approved**.

Welcome to **Penonline** — a modern school management platform designed to help schools manage their academic and administrative activities efficiently.

<x-mail::panel>
**School Information**

**School Name:** {{ $school->school_name }}

**School Type:** {{ $school->school_type }}

**Location:** {{ $school->location }}

**Region:** {{ $school->region?->region_name ?? 'N/A' }}

**District:** {{ $school->district?->district_name ?? 'N/A' }}
</x-mail::panel>

### What's Next?

Your school is now approved and ready to get started.

You can proceed to access Penonline and complete your school setup, including configuring your academic structure, adding staff, registering learners, and managing your school's activities.

<x-mail::button :url="$password_reset_link" color="primary">
Change Password and Access Penonline
</x-mail::button>

If you need any assistance getting started, please contact our support team. We will be happy to help.

Thank you for choosing **Penonline**.

We look forward to helping your school simplify its management and improve efficiency.

Regards,<br>
**The Penonline Team**

<x-mail::subcopy>
This email was sent to {{ $school->email }} because a school application was submitted using this email address.
</x-mail::subcopy>

</x-mail::message>
```
