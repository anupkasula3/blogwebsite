<style>
    /* Sticky footer ad */
    .sticky-footer-ad {
        position: fixed;
        left: 0;
        right: 0;
        bottom: -140px;
        z-index: 1000;
        display: flex;
        justify-content: center;
        transition: bottom .25s ease;
        pointer-events: none;
    }

    .sticky-footer-ad .sticky-footer-inner {
        pointer-events: auto;
        background: #ffffff;
        border: 2px dashed #ffb4c1;
        border-radius: 14px 14px 0 0;
        padding: 10px 14px 6px 14px;
        box-shadow: 0 10px 30px rgba(255, 41, 83, 0.18);
    }

    .sticky-footer-ad.show {
        bottom: 0;
    }

    .sticky-footer-close {
        position: absolute;
        top: -16px;
        right: 8px;
        background: #111827;
        color: #fff;
        border: none;
        width: 28px;
        height: 28px;
        border-radius: 9999px;
        display: grid;
        place-items: center;
        cursor: pointer;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
    }

    .sticky-footer-mobile { display: block; }
    .sticky-footer-desktop { display: none; }

    @media (min-width: 768px) {
        .sticky-footer-mobile { display: none; }
        .sticky-footer-desktop { display: block; }
        .sticky-footer-ad .sticky-footer-inner { padding: 12px 16px 8px 16px; }
    }
</style>
