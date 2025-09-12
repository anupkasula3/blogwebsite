@extends('admin.layouts.app')

@section('title', 'Edit Placement')
@section('header', 'Edit Placement')

@section('content')
<form action="{{ route('admin.placements.update', $placement) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')
    <div class="bg-white p-6 border border-gray-100 rounded-2xl shadow-sm space-y-4 max-w-xl">
        <h3 class="text-sm font-semibold text-gray-900">Placement Details</h3>
        <div>
            <label class="block text-sm font-medium text-gray-700">Name</label>
            <input name="name" value="{{ old('name', $placement->name) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" required />
            @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Key (identifier)</label>
            <input name="key" value="{{ old('key', $placement->key) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" required />
            @error('key')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Width</label>
                <input type="number" name="width" value="{{ old('width', $placement->width) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Height</label>
                <input type="number" name="height" value="{{ old('height', $placement->height) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" />
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Default display count</label>
                <input type="number" min="1" max="10" name="default_display_count" value="{{ old('default_display_count', $placement->default_display_count) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="e.g., 1" />
                <p class="text-xs text-gray-500 mt-1">How many ads to render when using the placement script without specifying count.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Default gap</label>
                <input type="text" name="default_gap" value="{{ old('default_gap', $placement->default_gap) }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="e.g., 12px or 0.75rem" />
                <p class="text-xs text-gray-500 mt-1">Spacing between multiple ads (CSS unit).</p>
            </div>
        </div>
        <div>
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_auto" value="1" class="mr-2 rounded border-gray-300" @checked(old('is_auto', $placement->is_auto)) />
                <span class="text-sm text-gray-700">Automatic rendering</span>
            </label>
        </div>
        <div class="pt-4 border-t">
            <h4 class="text-sm font-semibold text-gray-900 mb-2">Manual Embed (Placement Alias)</h4>
            <div class="grid gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600">Embed Token</label>
                    <div class="flex gap-2">
                        <input type="text" readonly value="{{ $placement->embed_token ?? '— generated on save —' }}" class="mt-1 w-full border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-gray-700" />
                        @if($placement->embed_token)
                        <button type="button" class="mt-1 px-3 py-2 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50" onclick="copyToClipboard('embed-script-rotate');">Copy Script</button>
                        @endif
                    </div>
                </div>
                @if($placement->embed_token)
                <div class="grid md:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-medium text-gray-600">Rotate one per reload</label>
                        <textarea id="embed-script-rotate" rows="2" readonly class="mt-1 w-full border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-gray-700 font-mono"><script src="{{ url('/ads/embed/'.$placement->embed_token.'.js') }}?count=1"></script></textarea>
                        <div class="flex gap-2 mt-2">
                            <button type="button" class="px-3 py-1.5 text-xs border border-gray-200 rounded-lg hover:bg-gray-50" onclick="copyToClipboard('embed-script-rotate');">Copy</button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600">Show all active (stacked)</label>
                        <textarea id="embed-script-all" rows="2" readonly class="mt-1 w-full border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-gray-700 font-mono"><script src="{{ url('/ads/embed/'.$placement->embed_token.'.js') }}?count=all&gap=12px"></script></textarea>
                        <div class="flex gap-2 mt-2">
                            <button type="button" class="px-3 py-1.5 text-xs border border-gray-200 rounded-lg hover:bg-gray-50" onclick="copyToClipboard('embed-script-all');">Copy</button>
                        </div>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-xs font-medium text-gray-600">Fixed-size example</label>
                        <textarea id="embed-script-fixed" rows="2" readonly class="mt-1 w-full border border-gray-200 rounded-lg px-3 py-2 bg-gray-50 text-gray-700 font-mono"><script src="{{ url('/ads/embed/'.$placement->embed_token.'.js') }}?w=728&h=90&count=1"></script></textarea>
                        <div class="flex gap-2 mt-2">
                            <button type="button" class="px-3 py-1.5 text-xs border border-gray-200 rounded-lg hover:bg-gray-50" onclick="copyToClipboard('embed-script-fixed');">Copy</button>
                            <span id="copy-toast" class="hidden text-xs text-green-700">Copied!</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">Tip: Omit <code>w</code>/<code>h</code> to use placement defaults. Use <code>count</code> and <code>gap</code> as needed.</p>
                    </div>
                </div>
                @endif
            </div>
            <script>
                function copyToClipboard(id){
                    try{
                        const el = document.getElementById(id);
                        el.focus(); el.select();
                        // Prefer modern clipboard when available
                        if (navigator.clipboard && window.isSecureContext){
                            navigator.clipboard.writeText(el.value).then(showCopied, showCopied);
                        } else {
                            document.execCommand('copy');
                            showCopied();
                        }
                    }catch(e){ showCopied(); }
                }
                function showCopied(){
                    const t = document.getElementById('copy-toast');
                    if(!t) return; t.classList.remove('hidden');
                    setTimeout(()=>t.classList.add('hidden'), 1200);
                }
            </script>
        </div>
    </div>

    <div class="flex ">
        <a href="{{ route('admin.placements.index') }}" class="px-3 py-2 border border-gray-200 rounded-lg mr-2 hover:bg-gray-50">Cancel</a>
        <button class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-sm">Save Changes</button>
    </div>
</form>
@endsection
