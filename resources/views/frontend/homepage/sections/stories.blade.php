@if(isset($storyGroups) && $storyGroups->isNotEmpty())
<section class="py-8 md:py-12">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="border-b-2 border-primary mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pb-2">
                <div class="flex items-center gap-3">
                    <span class="inline-flex items-center text-xl gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary font-semibold">
                        <i class="fas fa-newspaper"></i>
                       Highlighted Stories
                    </span>
                </div>
                <div class="flex gap-2 w-full sm:w-auto justify-between sm:justify-end">
                    <button type="button" id="storiesPrevBtn"
                        class="h-10 w-10 grid place-items-center rounded-full bg-white border border-gray-200 shadow-md hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 cursor-pointer">
                        <i class="fas fa-chevron-left text-gray-600 text-sm"></i>
                    </button>
                    <button type="button" id="storiesNextBtn"
                        class="h-10 w-10 grid place-items-center rounded-full bg-white border border-gray-200 shadow-md hover:bg-primary hover:text-white hover:border-primary transition-all duration-300 cursor-pointer">
                        <i class="fas fa-chevron-right text-gray-600 text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Stories rail -->
        <div class="relative">
            <div id="storiesRail" class="flex gap-4 md:gap-6 overflow-x-auto snap-x snap-mandatory pb-6 scrollbar-hide"
                 style="scrollbar-width: none; -ms-overflow-style: none;">
                @foreach($storyGroups as $idx => $group)
                    @php $first = $group->first(); @endphp
                    <button type="button"
                            class="snap-start group outline-none cursor-pointer flex-none w-[85%] sm:w-[60%] md:w-[40%] lg:w-[30%] xl:w-[23%] "
                            data-story-index="{{ $idx }}">
                        <div class="relative h-[360px] sm:h-[380px] lg:h-[410px] rounded-2xl overflow-hidden ring-1 ring-gray-200 shadow-md group-hover:shadow-xl transition-all">
                            <div class="absolute inset-0">
                                <img src="{{ asset('uploads/' . ($first->featured_image ?? '')) }}"
                                     alt="{{ $first->title ?? '' }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 md:p-5">
                                <h4 class="text-white font-bold text-lg md:text-xl leading-tight line-clamp-2 mb-2 drop-shadow-md">
                                    {{ $first->title ?? '' }}
                                </h4>
                                <span class="inline-flex items-center text-xs font-semibold px-3 py-1 rounded-full bg-white/90 text-primary ring-1 ring-primary/20">
                                    {{ $group->count() }} {{ $group->count() > 1 ? 'STORIES' : 'STORY' }}
                                </span>
                            </div>
                            <!-- Progress indicators -->
                            <div class="absolute bottom-0 left-0 right-0 flex gap-1 p-2 opacity-90">
                                @for($i=0; $i<$group->count(); $i++)
                                    <div class="h-1 flex-1 rounded-full bg-white/40 overflow-hidden">
                                        <div class="h-full bg-white transition-all duration-300 {{ $i === 0 ? 'w-full' : 'w-0' }}"></div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal Viewer -->
    <div id="storiesModal" class="fixed inset-0 z-[99999] hidden bg-black/90">
        <div class="relative h-full w-full flex items-center justify-center p-4">
            <!-- Close button -->
            <button type="button" id="storiesClose"
                    class="absolute top-4 right-4 md:top-6 md:right-6 z-30 h-10 w-10 md:h-12 md:w-12 grid place-items-center rounded-full bg-white/10 text-white hover:bg-white/20 backdrop-blur-sm transition-all duration-300 cursor-pointer">
                <i class="fas fa-times text-lg"></i>
            </button>

            <!-- Main content container -->
            <div class="relative w-full max-w-md md:max-w-lg lg:max-w-2xl h-[80vh] bg-white rounded-2xl overflow-hidden shadow-2xl">
                <!-- Progress bars -->
                <div id="storiesProgress" class="absolute top-4 left-4 right-4 flex gap-1 z-30"></div>

                <!-- Slide content -->
                <div class="h-full w-full relative">
                    <a id="storiesSlideLink" href="#" class="block w-full h-full" target="_self">
                        <img id="storiesSlideImage" src="" alt="story"
                             class="w-full h-full object-contain" />
                        <!-- Bottom gradient overlay with title -->
                        <div class="absolute inset-x-0 bottom-0 p-4 md:p-6 bg-gradient-to-t from-black/90 via-black/30 to-transparent">
                            <h4 id="storiesSlideTitle" class="text-white text-xl md:text-2xl font-bold leading-tight"></h4>
                        </div>
                    </a>
                </div>

                <!-- Navigation buttons -->
                <div class="absolute inset-0 flex items-center justify-between p-2 z-20 pointer-events-none">
                    <button type="button" id="storiesPrev"
                            class="h-10 w-10 md:h-12 md:w-12 ml-2 grid place-items-center rounded-full bg-white/20 text-white hover:bg-white/30 backdrop-blur-sm transition-all duration-300 cursor-pointer pointer-events-auto">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button type="button" id="storiesNext"
                            class="h-10 w-10 md:h-12 md:w-12 mr-2 grid place-items-center rounded-full bg-white/20 text-white hover:bg-white/30 backdrop-blur-sm transition-all duration-300 cursor-pointer pointer-events-auto">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.progress-track {
    height: 3px;
    background: rgba(255,255,255,0.2);
    border-radius: 9999px;
    overflow: hidden;
}
.progress-fill {
    height: 100%;
    background: white;
    width: 0%;
    transition: width 0.1s linear;
}
#storiesRail {
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Build story data from Blade to JS
    const storyData = [
        @foreach($storyGroups as $group)
            [
                @foreach($group as $p)
                {
                    title: @json(Str::limit($p->title, 120)),
                    image: @json(asset('uploads/' . $p->featured_image)),
                    url: @json(route('post.show', $p->slug)),
                },
                @endforeach
            ],
        @endforeach
    ];

    // Elements
    const rail = document.getElementById('storiesRail');
    const prevBtn = document.getElementById('storiesPrevBtn');
    const nextBtn = document.getElementById('storiesNextBtn');
    const modal = document.getElementById('storiesModal');
    const closeBtn = document.getElementById('storiesClose');
    const slideImg = document.getElementById('storiesSlideImage');
    const slideTitle = document.getElementById('storiesSlideTitle');
    const slideLink = document.getElementById('storiesSlideLink');
    const progressWrap = document.getElementById('storiesProgress');
    const navPrev = document.getElementById('storiesPrev');
    const navNext = document.getElementById('storiesNext');

    let activeStory = 0;
    let activeIndex = 0;
    let timer = null;
    let touchStartX = 0;
    let touchEndX = 0;
    const DURATION = 5000; // 5s per item

    // Navigation functions
    function updateRailButtons() {
        if (!rail) return;
        const maxScroll = rail.scrollWidth - rail.clientWidth;
        prevBtn.style.opacity = rail.scrollLeft > 10 ? '1' : '0.5';
        nextBtn.style.opacity = rail.scrollLeft < maxScroll - 10 ? '1' : '0.5';
    }

    // Initialize rail buttons
    if (rail) {
        rail.addEventListener('scroll', updateRailButtons);
        updateRailButtons();
    }

    // Navigation event listeners
    if (prevBtn && nextBtn && rail) {
        prevBtn.addEventListener('click', () => {
            rail.scrollBy({ left: -300, behavior: 'smooth' });
        });
        nextBtn.addEventListener('click', () => {
            rail.scrollBy({ left: 300, behavior: 'smooth' });
        });
    }

    // Modal functions
    function buildProgressBars(count) {
        if (!progressWrap) return;
        progressWrap.innerHTML = '';
        for (let i = 0; i < count; i++) {
            const track = document.createElement('div');
            track.className = 'progress-track flex-1 cursor-pointer';
            const fill = document.createElement('div');
            fill.className = 'progress-fill';
            if (i < activeIndex) fill.style.width = '100%';
            track.appendChild(fill);
            track.addEventListener('click', () => goToIndex(i));
            progressWrap.appendChild(track);
        }
    }

    function goToIndex(index) {
        if (index >= 0 && index < storyData[activeStory].length) {
            activeIndex = index;
            render();
        }
    }

    function render() {
        if (!storyData[activeStory] || !storyData[activeStory][activeIndex]) {
            close();
            return;
        }

        const item = storyData[activeStory][activeIndex];
        if (slideImg) slideImg.src = item.image;
        if (slideTitle) slideTitle.textContent = item.title;
        if (slideLink) slideLink.href = item.url;

        buildProgressBars(storyData[activeStory].length);
        startTimer();
    }

    function startTimer() {
        stopTimer();
        const fills = progressWrap?.querySelectorAll('.progress-fill');
        const current = fills?.[activeIndex];
        if (!current) return;

        let start = performance.now();
        function tick(now) {
            const p = Math.min(1, (now - start) / DURATION);
            current.style.width = (p * 100) + '%';

            if (p < 1) {
                timer = requestAnimationFrame(tick);
            } else {
                next();
            }
        }
        timer = requestAnimationFrame(tick);
    }

    function stopTimer() {
        if (timer) {
            cancelAnimationFrame(timer);
            timer = null;
        }
    }

    function open(storyIdx) {
        if (storyIdx >= 0 && storyIdx < storyData.length) {
            activeStory = storyIdx;
            activeIndex = 0;
            if (modal) modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            render();
        }
    }

    function close() {
        stopTimer();
        if (modal) modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function next() {
        if (activeIndex < storyData[activeStory].length - 1) {
            activeIndex++;
        } else if (activeStory < storyData.length - 1) {
            activeStory++;
            activeIndex = 0;
        } else {
            close();
            return;
        }
        render();
    }

    function prev() {
        if (activeIndex > 0) {
            activeIndex--;
        } else if (activeStory > 0) {
            activeStory--;
            activeIndex = storyData[activeStory].length - 1;
        }
        render();
    }

    // Event listeners
    document.querySelectorAll('[data-story-index]')?.forEach(btn => {
        btn.addEventListener('click', () => open(parseInt(btn.getAttribute('data-story-index'))));
    });

    // Touch events for mobile swiping
    if (modal) {
        modal.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        }, false);

        modal.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        }, false);
    }

    function handleSwipe() {
        const swipeThreshold = 50;
        const swipeDiff = touchStartX - touchEndX;

        if (Math.abs(swipeDiff) > swipeThreshold) {
            if (swipeDiff > 0) {
                next();
            } else {
                prev();
            }
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (modal && !modal.classList.contains('hidden')) {
            e.preventDefault();
            if (e.key === 'Escape') close();
            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') next();
            if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') prev();
        }
    });

    // Close modal when clicking outside content
    modal?.addEventListener('click', (e) => {
        if (e.target === modal || e.target.id === 'storiesOverlay') {
            close();
        }
    });

    // Close button
    if (closeBtn) {
        closeBtn.addEventListener('click', close);
    }

    // Navigation buttons
    if (navNext) navNext.addEventListener('click', next);
    if (navPrev) navPrev.addEventListener('click', prev);
});
</script>
@endif
