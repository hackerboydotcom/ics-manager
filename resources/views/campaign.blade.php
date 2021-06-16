(function () {
    const handler = function () {
        const time = (new Date()).getTime();
        const a = document.createElement('a');
        const id = 'ics-' + time;
        a.setAttribute('id', id);
        a.setAttribute('href', 'webcal:{{ str_replace(['http://', 'https://'], '', route('subscribe', ['campaign' => $campaign, 'uuid' => \Illuminate\Support\Str::uuid()])) }}');

        document.append(a);
        let isClicked = false;
        document.addEventListener('click', function () {
            if (isClicked) {
                return;
            }
            isClicked = true;
            document.getElementById(id).click();
        });
    }
    document.addEventListener('DOMContentLoaded', handle);
    if (document.readyState !== 'loading') {
        handler();
    }
})();
