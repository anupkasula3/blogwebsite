@if(isset($storyGroups) && $storyGroups->isNotEmpty())
<section class="py-6">
    <div class="max-w-screen-2xl mx-auto px-4">
        <!-- Header -->
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-2xl sm:text-3xl font-extrabold text-primary">Blog Stories</h3>
            <div class="flex gap-2">
                <button type="button" id="storiesPrevBtn" class="h-9 w-9 grid place-items-center rounded-full bg-white border border-gray-200 shadow hover:bg-gray-50">
                    <i class="fas fa-chevron-left text-gray-600 text-sm"></i>
                </button>
                <button type="button" id="storiesNextBtn" class="h-9 w-9 grid place-items-center rounded-full bg-white border border-gray-200 shadow hover:bg-gray-50">
                    <i class="fas fa-chevron-right text-gray-600 text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Stories rail (Facebook/Instagram style) -->
        <div class="relative">
            <div id="storiesRail" class="flex gap-4 overflow-x-auto snap-x snap-mandatory pb-2 scrollbar-hide"
                 style="scrollbar-width: none; -ms-overflow-style: none;">
                @foreach($storyGroups as $idx => $group)
                    @php $first = $group->first(); @endphp
                    <button type="button" class="snap-start group outline-none cursor-pointer flex-none w-[70%] sm:w-[45%] md:w-[30%] lg:w-[20%] xl:w-[20%]"
                            data-story-index="{{ $idx }}">
                        <div class="relative h-[330px] sm:h-[370px] rounded-2xl overflow-hidden ring-1 ring-gray-200 shadow-md group-hover:shadow-lg transition-all">
                            <img src="{{ asset('uploads/' . ($first->featured_image ?? '')) }}" alt="{{ $first->title ?? '' }}"
                                 class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            <div class="absolute bottom-3 left-3 right-3">
                                <h4 class="text-white font-bold text-base sm:text-lg leading-tight line-clamp-2 mb-2">{{ $first->title ?? '' }}</h4>
                                <span class="inline-flex items-center text-[11px] font-semibold px-2 py-1 rounded-full bg-white/90 text-primary ring-1 ring-primary/20">
                                    {{ $group->count() }} STORIES
                                </span>
                            </div>
                            <!-- progress placeholders at bottom -->
                            <div class="absolute bottom-0 left-0 right-0 flex gap-1 p-2 opacity-70">
                                @for($i=0; $i<$group->count(); $i++)
                                    <div class="h-1 flex-1 rounded bg-white/40"></div>
                                @endfor
                            </div>
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal Viewer -->
    <div id="storiesModal" class="fixed inset-0 z-[99999] hidden">
        <div id="storiesOverlay" class="absolute inset-0 bg-white"></div>
        <div class="relative h-full w-full flex items-center justify-center p-0 md:p-0">
            <!-- Top white bar with logo (left) and close (right) -->
            <div class="absolute top-0 left-0 right-0 z-30 flex items-center justify-between px-4 py-3 ">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-2 cursor-pointer">
                    <img src="{{ asset('images/favicon.jpg') }}" alt="Logo" class="h-7 w-7 rounded" />
                    <span class="hidden sm:inline text-gray-800 font-semibold">Stories</span>
                </a>
                <button type="button" id="storiesCloseTop" class="h-9 w-9 grid place-items-center rounded-full bg-white text-gray-700 shadow hover:bg-gray-100 cursor-pointer">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="relative h-[78vh] md:h-[80vh] max-h-[85vh] aspect-[9/16] w-auto bg-white rounded-3xl overflow-hidden shadow-2xl ring-1 ring-gray-200">
                <!-- progress bars -->
                <div id="storiesProgress" class="absolute top-3 md:top-4 left-4 md:left-6 right-4 md:right-6 flex gap-1 z-30"></div>
                <!-- slide content wrapped to create top/bottom gaps and rounded inner -->
                <div class="absolute inset-0 p-2 md:p-3">
                    <a id="storiesSlideLink" href="#" class="block w-full h-full relative rounded-2xl overflow-hidden" target="_self">
                        <img id="storiesSlideImage" src="" alt="story" class="w-full h-full object-cover" />
                        <!-- top gradient to make timer visible -->
                        <div class="absolute inset-x-0 top-0 h-14 md:h-16 bg-gradient-to-b from-black/40 to-transparent"></div>
                        <!-- bottom gradient overlay with title -->
                        <div class="absolute inset-x-0 bottom-0 p-3 md:p-5 bg-gradient-to-t from-black/80 via-black/30 to-transparent">
                            <h4 id="storiesSlideTitle" class="text-white text-xl md:text-2xl font-extrabold leading-tight"></h4>
                        </div>
                    </a>
                </div>
                <!-- nav buttons -->
                <button type="button" id="storiesPrev" class="absolute left-2 md:left-3 top-1/2 -translate-y-1/2 z-20 h-10 w-10 grid place-items-center rounded-full bg-white text-gray-800 shadow hover:bg-gray-100 cursor-pointer">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button type="button" id="storiesNext" class="absolute right-2 md:right-3 top-1/2 -translate-y-1/2 z-20 h-10 w-10 grid place-items-center rounded-full bg-white text-gray-800 shadow hover:bg-gray-100 cursor-pointer">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>
@endif

<style>
.scrollbar-hide::-webkit-scrollbar { display: none; }
.aspect-9\/16 { aspect-ratio: 9 / 16; }
.progress-track { height: 4px; background: rgba(255,255,255,0.35); border-radius: 9999px; overflow: hidden; }
.progress-fill { height: 100%; background: white; width: 0%; transition: width 0.2s linear; }
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

    const rail = document.getElementById('storiesRail');
    const prevBtn = document.getElementById('storiesPrevBtn');
    const nextBtn = document.getElementById('storiesNextBtn');
    prevBtn?.addEventListener('click', () => rail.scrollBy({left: -300, behavior: 'smooth'}));
    nextBtn?.addEventListener('click', () => rail.scrollBy({left:  300, behavior: 'smooth'}));

    const modal = document.getElementById('storiesModal');
    const closeBtn = document.getElementById('storiesClose');
    const closeBtnTop = document.getElementById('storiesCloseTop');
    const overlay = document.getElementById('storiesOverlay');
    const slideImg = document.getElementById('storiesSlideImage');
    const slideTitle = document.getElementById('storiesSlideTitle');
    const slideLink = document.getElementById('storiesSlideLink');
    const progressWrap = document.getElementById('storiesProgress');
    const navPrev = document.getElementById('storiesPrev');
    const navNext = document.getElementById('storiesNext');

    let activeStory = 0;
    let activeIndex = 0;
    let timer = null;
    const DURATION = 4000; // 4s per item

    function buildProgressBars(count){
        progressWrap.innerHTML = '';
        for(let i=0;i<count;i++){
            const track = document.createElement('div');
            track.className = 'progress-track flex-1';
            const fill = document.createElement('div');
            fill.className = 'progress-fill';
            if(i < activeIndex) fill.style.width = '100%';
            track.appendChild(fill);
            progressWrap.appendChild(track);
        }
    }

    function render(){
        const item = storyData[activeStory][activeIndex];
        slideImg.src = item.image;
        slideTitle.textContent = item.title;
        slideLink.href = item.url;
        buildProgressBars(storyData[activeStory].length);
        startTimer();
    }

    function startTimer(){
        stopTimer();
        const fills = progressWrap.querySelectorAll('.progress-fill');
        const current = fills[activeIndex];
        let start = performance.now();
        function tick(now){
            const p = Math.min(1, (now - start)/DURATION);
            if(current) current.style.width = (p*100)+'%';
            if(p < 1){
                timer = requestAnimationFrame(tick);
            } else {
                next();
            }
        }
        timer = requestAnimationFrame(tick);
    }

    function stopTimer(){ if(timer){ cancelAnimationFrame(timer); timer=null; } }

    function open(storyIdx){
        activeStory = storyIdx; activeIndex = 0; render();
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }
    function close(){
        stopTimer();
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }
    function next(){
        if(activeIndex < storyData[activeStory].length - 1){
            activeIndex++; render();
        } else if(activeStory < storyData.length - 1){
            activeStory++; activeIndex = 0; render();
        } else {
            close();
        }
    }
    function prev(){
        if(activeIndex > 0){
            activeIndex--; render();
        } else if(activeStory > 0){
            activeStory--; activeIndex = storyData[activeStory].length - 1; render();
        }
    }

    document.querySelectorAll('[data-story-index]')?.forEach(btn => {
        btn.addEventListener('click', () => open(parseInt(btn.getAttribute('data-story-index'))));
    });
    navNext.addEventListener('click', next);
    navPrev.addEventListener('click', prev);
    closeBtn?.addEventListener('click', close);
    closeBtnTop?.addEventListener('click', close);
    modal.addEventListener('click', (e) => { if(e.target === modal) close(); });
    overlay?.addEventListener('click', close);
    document.addEventListener('keydown', (e) => {
        if(modal.classList.contains('hidden')) return;
        if(e.key === 'Escape') close();
        if(e.key === 'ArrowRight') next();
        if(e.key === 'ArrowLeft') prev();
    });
});
</script>
