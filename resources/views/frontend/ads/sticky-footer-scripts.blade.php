<script>
    // Sticky footer ad behavior (always show on each page load; allow closing per view)
    document.addEventListener('DOMContentLoaded', () => {
        const sticky = document.getElementById('sticky-footer-ad');
        const closeBtn = document.getElementById('sticky-footer-close');
        if (!sticky) return;

        // Show after a short delay
        setTimeout(() => {
            sticky.classList.add('show');

            // Track impression if ad id present
            const adId = sticky.getAttribute('data-ad-id');
            if (adId && typeof trackAdImpression === 'function') {
                trackAdImpression(adId, 'sticky_footer');
            }
        }, 800);

        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                sticky.classList.remove('show');
            });
        }
    });
</script>
