<x-mail::message>
# Introduction

Hi <b>{{ $name }}</b>,
<p>Your trial has ended today.  To continue using our service, please click the button below to reactivate your membership.</p>


<x-mail::button url="{{ route('subscribe') }}">
Reactivate Membership
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
