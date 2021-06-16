BEGIN:VCALENDAR

VERSION:2.0
CALSCALE:GREGORIAN
PRODID:{{ \Illuminate\Support\Str::uuid() }}
NAME:{{ $campaign->title }}
X-WR-CALNAME:{{ $campaign->title }}
DESCRIPTION:{{ $campaign->title }}

BEGIN:VTIMEZONE
TZID:Asia/Jakarta
TZURL:http://tzurl.org/zoneinfo-outlook/Asia/Jakarta
X-LIC-LOCATION:Asia/Jakarta
BEGIN:STANDARD
TZOFFSETFROM:+0700
TZOFFSETTO:+0700
TZNAME:WIB
DTSTART:19700101T000000
END:STANDARD
END:VTIMEZONE

@foreach($campaign->messages()->where('trigger_at', '>=', now())->get() as $message)
@php $triggerAtInt = strtotime($message->trigger_at); @endphp
BEGIN:VEVENT
DTSTAMP:{{ date('Ymd\THis\Z', $triggerAtInt) }}
UID:{{ $campaign->id }}-{{ $message->id }}
DTSTART;TZID=Asia/Jakarta:{{ date('Ymd\THis', $triggerAtInt) }}
DTEND;TZID=Asia/Jakarta:{{ date('Ymd\THis', strtotime($message->trigger_at->addMinute())) }}
SUMMARY:{{ $message->title }}
DESCRIPTION:{{ $message->description }}
BEGIN:VALARM
TRIGGER:PT0H
REPEAT:1
DURATION:PT15M
ACTION:DISPLAY
DESCRIPTION:Reminder
END:VALARM
END:VEVENT
@endforeach

END:VCALENDAR
