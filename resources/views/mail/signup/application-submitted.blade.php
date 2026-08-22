<x-mail::message>
# New School Application Received

A new school has submitted an application to join the platform.

---

## School Information

| Field | Details |
| :--- | :--- |
| **School Name** | {{ $application->school_name }} |
| **School Type** | {{ $application->school_type }} |
| **Location** | {{ $application->location }} |
| **Region** | {{ $application->region?->region_name }} |
| **District** | {{ $application->district?->district_name }} |

---

## Contact Information

| Field | Details |
| :--- | :--- |
| **Contact Person** | {{ $application->contact_name }} |
| **Email Address** | {{ $application->email }} |
| **Phone Number** | {{ $application->phone }} |

---

## School Statistics

| Field | Value |
| :--- | :---: |
| **Students** | {{ number_format($application->student_count) }} |
| **Teachers** | {{ number_format($application->teacher_count) }} |

---

## Additional Message

@if($application->message)
{{ $application->message }}
@else
_No additional message was provided._
@endif

---

**Application Status:** {{ ucfirst($application->status->label()) }}

**Submitted On:** {{ $application->created_at->format('F d, Y \a\t h:i A') }}

<x-mail::button :url="config('app.url')">
Open Dashboard
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>