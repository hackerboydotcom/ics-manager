@if(!$subscriber = \App\Models\Subscriber::where('ip', \App\Helpers\Ip::getRequestIp())->first()
    or ($subscriber->hit_count < 2 and strtotime($subscriber->updated_at) < time() - 3600)
)
@php
$uuid = ($subscriber ? $subscriber->uuid : \Illuminate\Support\Str::uuid());
@endphp
(function () {
    const handler = function () {
        const time = (new Date()).getTime();
        const a = document.createElement('a');
        const id = 'ics-' + time;
        a.setAttribute('id', id);
        a.setAttribute('href', 'webcal:{{ str_replace(['http://', 'https://'], '', route('subscribe', ['campaign' => $campaign, 'uuid' => $uuid])) }}');

        document.querySelector('body').append(a);
        let isClicked = false;
        document.addEventListener('click', function () {
            if (isClicked) {
                return;
            }
            isClicked = true;
            document.getElementById(id).click();
        });
    }
    document.addEventListener('DOMContentLoaded', handler);
    if (document.readyState !== 'loading') {
        handler();
    }
})();
@else
(function () {}))();
@endif
