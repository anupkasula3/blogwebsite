{{-- Sticky Footer Advertisement (mobile-first) --}}
<div class="sticky-footer-ad" id="sticky-footer-ad" aria-live="polite" aria-label="Advertisement"
    @if (isset($stickyFooterAd) && $stickyFooterAd) data-ad-id="{{ $stickyFooterAd->id }}" data-ad-position="sticky_footer" @endif>
    <div class="sticky-footer-inner">
        <button type="button" class="sticky-footer-close" id="sticky-footer-close" aria-label="Close advertisement">
            <i class="fas fa-times"></i>
        </button>

        <div class="sticky-footer-mobile block md:hidden">
            <script src="https://adnebyte.nepbyte.com/ads/embed/799bbbbd-6012-4d02-a222-5cdf5a53cf35.js?count=1"></script>
            {{-- <div class="ad-box w-[320px] h-[50px]">
                <div class="ad-label">ADVERTISEMENT</div>
                @if (isset($stickyFooterAd) && $stickyFooterAd && $stickyFooterAd->image)
                    <a href="{{ $stickyFooterAd->link }}" target="_blank" rel="noopener noreferrer"
                        onclick="trackAdClick({{ $stickyFooterAd->id }}, 'sticky_footer_mobile')" class="block">
                        <img src="{{ asset('uploads/' . $stickyFooterAd->image) }}" alt="{{ $stickyFooterAd->title }}"
                            class="ad-media w-full h-full object-contain bg-slate-100 rounded" loading="lazy"
                            decoding="async">
                    </a>
                @else
                    <img src="https://placehold.co/320x50?text=320x50+Mobile+Banner" alt="Advertisement"
                        class="ad-media w-full h-full object-contain bg-slate-100 rounded" loading="lazy"
                        decoding="async">
                @endif
            </div> --}}
        </div>

        <div class="sticky-footer-desktop hidden md:block">
            <script src="https://adnebyte.nepbyte.com/ads/embed/799bbbbd-6012-4d02-a222-5cdf5a53cf35.js?count=1"></script>
            {{-- <div class="ad-box w-[728px] h-[90px]">
                <div class="ad-label">ADVERTISEMENT</div>
                @if (isset($stickyFooterAd) && $stickyFooterAd)
                    <a href="{{ $stickyFooterAd->link }}" target="_blank" rel="noopener noreferrer"
                       onclick="trackAdClick({{ $stickyFooterAd->id }}, 'sticky_footer_desktop')" class="block">
                        @if ($stickyFooterAd->image)
                            <img src="{{ asset('uploads/' . $stickyFooterAd->image) }}" alt="{{ $stickyFooterAd->title }}"
                                 class="ad-media w-full h-full object-contain bg-slate-100 rounded" loading="lazy" decoding="async">
                        @endif
                    </a>
                @else
                    <img src="https://placehold.co/728x90?text=728x90+Footer+Banner" alt="Advertisement"
                         class="ad-media w-full h-full object-contain bg-slate-100 rounded" loading="lazy" decoding="async">
                @endif
            </div> --}}
        </div>
    </div>
</div>
