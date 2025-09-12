@props([
    'key' => null,
    'width' => '100%',
    'height' => '160px',
    'class' => '',
    'style' => '',
])

@php
    // Normalize props
    $placementKey = $key ? trim($key, "'\"") : null;
    $a = \App\Models\AdPlacement::where('key', $placementKey)->first();
    $w = $a->width;
    $h = $a->height;
    $styleAttr = trim(
        ($style ? $style . '; ' : '') .
            'width: ' .
            (is_numeric($w) ? $w . 'px' : $w) .
            '; ' .
            'height: ' .
            (is_numeric($h) ? $h . 'px' : $h) .
            '; ' .
            'border:0; overflow:hidden;',
    );
@endphp

@if ($placementKey)
    <iframe src="{{ route('ads.render', ['placementKey' => $placementKey]) }}" loading="lazy" style="{{ $styleAttr }}"
        class="{{ $class }}" referrerpolicy="no-referrer-when-downgrade"
        sandbox="allow-scripts allow-forms allow-same-origin allow-popups"></iframe>
@else
    <!-- ad.placement: missing placement key -->
@endif
