<div class="bg-white p-4 border-2 group border-gray-300 shadow-lg rounded-xl ">
    <a href="{{ route('post.show', $post->slug) }}">
        <!-- image wrapper -->
        <div>
            <img class="rounded-lg h-56" src="{{ asset('uploads/' . $post->featured_image) }}" alt="{{ $post->title }}"
                alt="image" />
        </div>
        <!-- image wrapper end -->
        <!-- tag -->
        <div class="flex items-center justify-between w-full text-sm my-4">

            <div class="capitalize text-purple-900 font-semibold  bg-purple-200 w-fit px-3 rounded-lg">
                <p>{{ $post->category->name }}</p>
            </div>
            <div class="">
                {{ $post->published_at->diffForHumans() }}
            </div>
        </div>
        <!-- tag end -->
        <!-- article heading -->
        <div class="text-2xl group-hover:text-green-600 transition ease-in-out duration-700 font-bold my-2 ">
            <h2>{{ $post->title }}</h2>
        </div>
        <!-- article heading end -->
        <!-- article text -->
        <div class="">
            <p>{{ Str::limit(strip_tags($post->content, 50)) }}</p>
        </div>
        <!-- article text end -->
        <!-- blogger -->
        {{-- <div class="flex items-cente">
            <div class="mt-4">
                <img class="w-12 h-12 object-cover rounded-full"
                    src="https://images.unsplash.com/photo-1624188327913-e0c59aaaa3ae?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw2fHxibGFjayUyMG1hbnxlbnwwfDB8fHwxNzE5NjAxMzQ2fDA&ixlib=rb-4.0.3&q=80&w=1080"
                    alt="image" />
            </div>

            <div class="block mt-3.5">

                <div class="capitalize text-lg font-semibold pl-4 ">
                    <h3>{{ $post->author_name }}</h3>
                </div>

                <div class="capitalize text-sm text-gray-400 pl-4">
                    <p>{{ $post->published_at->diffForHumans() }}</p>
                </div>

            </div>

        </div> --}}

    </a>
</div>
