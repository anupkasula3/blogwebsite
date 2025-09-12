<script>
    (function(){
      const loadAd = (el) => {
        const key = el.getAttribute('data-ad-key');
        if (!key || el.dataset.loaded) return;
        el.dataset.loaded = '1';
        fetch(`/ads/render/${encodeURIComponent(key)}`, { credentials: 'same-origin' })
          .then(r => r.text())
          .then(html => { el.innerHTML = html; })
          .catch(() => { el.innerHTML = '<div class="ad-empty" style="display:none"></div>'; });
      };

      const observer = 'IntersectionObserver' in window ? new IntersectionObserver((entries)=>{
        entries.forEach(entry => { if (entry.isIntersecting) { loadAd(entry.target); observer.unobserve(entry.target); } });
      }, { rootMargin: '200px 0px' }) : null;

      const init = () => {
        document.querySelectorAll('[data-ad-key]')
          .forEach(el => {
            if (observer) observer.observe(el); else loadAd(el);
          });
      };

      if (document.readyState !== 'loading') init();
      else document.addEventListener('DOMContentLoaded', init);
    })();
    </script>
