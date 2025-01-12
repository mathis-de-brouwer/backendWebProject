<x-mail::message>
#  Contact Form Submission

**From:** {{ $contactData->name }}  
**Email:** {{ $contactData->email }}  
**Subject:** {{ $contactData->subject }}

**Message:**  
{{ $contactData->message }}

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>