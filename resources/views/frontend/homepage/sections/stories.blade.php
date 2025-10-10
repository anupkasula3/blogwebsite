@if(isset($storyGroups) && $storyGroups->isNotEmpty())
<section class="py-2">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-6">
        <div class="relative">
            <!-- Stories Rail -->
            <div id="storiesRail" class="flex gap-3 overflow-x-auto snap-x snap-mandatory pb-4 scrollbar-hide"
                 style="scrollbar-width: none; -ms-overflow-style: none;">
                @foreach($storyGroups as $idx => $group)
                    @php $first = $group->first(); @endphp
                    <button type="button"
                            class="snap-start group outline-none cursor-pointer flex-none w-[35%] sm:w-[50%] md:w-[31%] lg:w-[25%] xl:w-[16%]"
                            data-story-index="{{ $idx }}">
                        <div class="relative h-[180px] sm:h-[220px] md:h-[260px] lg:h-[300px] rounded-2xl overflow-hidden ring-1 ring-gray-200 shadow-md group-hover:shadow-xl transition-all">
                            <div class="absolute inset-0">
                                <img src="{{ asset('uploads/' . ($first->featured_image ?? '')) }}"
                                     alt="{{ $first->title ?? '' }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 p-3 md:p-5">
                                <h4 class="text-white font-bold text-base sm:text-lg md:text-xl leading-tight line-clamp-2 mb-1 sm:mb-2 drop-shadow-md">
                                    {{ $first->title ?? '' }}
                                </h4>
                                <span class="inline-flex items-center text-[10px] sm:text-xs font-semibold px-2 py-1 rounded-full bg-white/90 text-primary ring-1 ring-primary/20">
                                    {{ $group->count() }} {{ $group->count() > 1 ? 'STORIES' : 'STORY' }}
                                </span>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 flex gap-1 p-1 sm:p-2 opacity-90">
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
        <div class="relative h-full w-full flex items-center justify-center p-2 sm:p-4">
            <button type="button" id="storiesClose"
                    class="absolute top-2 right-2 sm:top-4 sm:right-4 z-30 h-8 w-8 sm:h-10 sm:w-10 grid place-items-center rounded-full bg-white/10 text-white hover:bg-white/20 backdrop-blur-sm transition-all duration-300 cursor-pointer">
                <i class="fas fa-times text-sm sm:text-lg"></i>
            </button>

            <div class="relative w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-2xl h-[80vh] sm:h-[85vh] md:h-[90vh] bg-white rounded-2xl overflow-hidden shadow-2xl">
                <div id="storiesProgress" class="absolute top-3 left-3 right-3 flex gap-1 z-30"></div>
                <div class="h-full w-full relative">
                    <a id="storiesSlideLink" href="#" class="block w-full h-full" target="_self">
                        <img id="storiesSlideImage" src="" alt="story"
                             class="w-full h-full object-contain" />
                        <div class="absolute inset-x-0 bottom-0 p-3 sm:p-4 bg-gradient-to-t from-black/90 via-black/30 to-transparent">
                            <h4 id="storiesSlideTitle" class="text-white text-base sm:text-lg md:text-2xl font-bold leading-tight"></h4>
                        </div>
                    </a>
                </div>
                <div class="absolute inset-0 flex items-center justify-between p-1 sm:p-2 z-20 pointer-events-none">
                    <button type="button" id="storiesPrev"
                            class="h-8 w-8 sm:h-10 sm:w-10 ml-1 sm:ml-2 grid place-items-center rounded-full bg-white/20 text-white hover:bg-white/30 backdrop-blur-sm transition-all duration-300 cursor-pointer pointer-events-auto">
                        <i class="fas fa-chevron-left text-xs sm:text-lg"></i>
                    </button>
                    <button type="button" id="storiesNext"
                            class="h-8 w-8 sm:h-10 sm:w-10 mr-1 sm:mr-2 grid place-items-center rounded-full bg-white/20 text-white hover:bg-white/30 backdrop-blur-sm transition-all duration-300 cursor-pointer pointer-events-auto">
                        <i class="fas fa-chevron-right text-xs sm:text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.scrollbar-hide::-webkit-scrollbar { display: none; }
.progress-track { height: 3px; background: rgba(255,255,255,0.2); border-radius: 9999px; overflow: hidden; cursor: pointer; }
.progress-fill { height: 100%; background: white; width: 0%; transition: width 0.1s linear; }
#storiesRail { scroll-behavior: smooth; -webkit-overflow-scrolling: touch; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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

    const rail = document.getElementById('storiesRail');
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
    const DURATION = 5000;

    function buildProgressBars(count) {
        progressWrap.innerHTML = '';
        for (let i = 0; i < count; i++) {
            const track = document.createElement('div');
            track.className = 'progress-track flex-1';
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
        if (!storyData[activeStory] || !storyData[activeStory][activeIndex]) { close(); return; }
        const item = storyData[activeStory][activeIndex];
        slideImg.src = item.image;
        slideTitle.textContent = item.title;
        slideLink.href = item.url;

        buildProgressBars(storyData[activeStory].length);
        startTimer();
    }

    function startTimer() {
        stopTimer();
        const fills = progressWrap.querySelectorAll('.progress-fill');
        const current = fills[activeIndex];
        if (!current) return;

        let start = performance.now();
        function tick(now) {
            const progress = Math.min(1, (now - start) / DURATION);
            current.style.width = (progress * 100) + '%';
            if (progress < 1) {
                timer = requestAnimationFrame(tick);
            } else { next(); }
        }
        timer = requestAnimationFrame(tick);
    }

    function stopTimer() { if (timer) cancelAnimationFrame(timer); timer = null; }

    function open(storyIdx) {
        activeStory = storyIdx;
        activeIndex = 0;
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        render();
    }

    function close() { stopTimer(); modal.classList.add('hidden'); document.body.classList.remove('overflow-hidden'); }

    function next() {
        if (activeIndex < storyData[activeStory].length - 1) activeIndex++;
        else if (activeStory < storyData.length - 1) { activeStory++; activeIndex = 0; }
        else { close(); return; }
        render();
    }

    function prev() {
        if (activeIndex > 0) activeIndex--;
        else if (activeStory > 0) { activeStory--; activeIndex = storyData[activeStory].length - 1; }
        render();
    }

    document.querySelectorAll('[data-story-index]').forEach(btn => {
        btn.addEventListener('click', () => open(parseInt(btn.getAttribute('data-story-index'))));
    });

    modal.addEventListener('touchstart', (e) => touchStartX = e.changedTouches[0].screenX, false);
    modal.addEventListener('touchend', (e) => { touchEndX = e.changedTouches[0].screenX; handleSwipe(); }, false);

    function handleSwipe() {
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) diff > 0 ? next() : prev();
    }

    document.addEventListener('keydown', (e) => {
        if (!modal.classList.contains('hidden')) {
            if (e.key === 'Escape') close();
            if (e.key === 'ArrowRight' || e.key === 'ArrowDown') next();
            if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') prev();
        }
    });

    modal.addEventListener('click', (e) => { if (e.target === modal) close(); });
    closeBtn.addEventListener('click', close);
    navNext.addEventListener('click', next);
    navPrev.addEventListener('click', prev);
});
</script>
@endif
