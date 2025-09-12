@extends('admin.layouts.app')
@section('title', 'Embed Code')
@section('header', 'Embed Code for "' . $ad->title . '"')

@section('content')
    <div class="bg-white p-6 border border-gray-100 rounded-2xl shadow-sm space-y-6">
        <div>
            <div class="font-medium text-gray-900 mb-2">Manual Embed (Auto-size HTML)</div>
            <div class="flex items-center justify-between gap-3">
                <pre id="code-auto" class="bg-gray-50 p-3 rounded-lg border border-gray-200 overflow-auto text-sm flex-1">&lt;script src="{{ route('ads.embed.script', ['token' => $ad->manual_embed_token]) }}"&gt;&lt;/script&gt;</pre>
                <button type="button" class="px-3 py-2 border border-gray-200 rounded-lg hover:bg-gray-50" onclick="navigator.clipboard.writeText(document.getElementById('code-auto').textContent)">Copy</button>
            </div>
            <p class="text-sm text-gray-600 mt-2">Writes the ad's HTML directly at the insertion point. Best for flexible content areas.</p>
        </div>
        <div>
            <div class="font-medium text-gray-900 mb-2">Clickthrough URL</div>
            <div class="flex items-center justify-between gap-3">
                <pre id="code-click" class="bg-gray-50 p-3 rounded-lg border border-gray-200 overflow-auto text-sm flex-1">{{ route('ads.click', ['ad' => $ad->id]) }}</pre>
                <button type="button" class="px-3 py-2 border border-gray-200 rounded-lg hover:bg-gray-50" onclick="navigator.clipboard.writeText(document.getElementById('code-click').textContent)">Copy</button>
            </div>
        </div>
        <div>
            <div class="font-medium text-gray-900 mb-2">Manual Embed with Size (Iframe)</div>
            <div class="grid grid-cols-1 md:grid-cols-6 gap-3 mb-2">
                <div>
                    <label class="block text-sm text-gray-700">Width</label>
                    <input id="w" type="text" class="mt-1 w-full border border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-200" value="728" />
                    <p class="text-xs text-gray-500 mt-1">Number = px (e.g., 728) or CSS value (e.g., 100%)</p>
                </div>
                <div>
                    <label class="block text-sm text-gray-700">Height</label>
                    <input id="h" type="text" class="mt-1 w-full border border-gray-300 rounded-lg px-2 py-1 focus:outline-none focus:ring-2 focus:ring-indigo-200" value="90" />
                    <p class="text-xs text-gray-500 mt-1">Number = px</p>
                </div>
                <div class="md:col-span-4 flex items-end gap-2">
                    <button type="button" id="updateSized" class="px-3 py-2 border border-gray-200 rounded-lg hover:bg-gray-50">Update snippet</button>
                    <button type="button" class="px-3 py-2 border border-gray-200 rounded-lg hover:bg-gray-50" onclick="navigator.clipboard.writeText(document.getElementById('code-sized').textContent)">Copy</button>
                </div>
            </div>
            <pre id="code-sized" class="bg-gray-50 p-3 rounded-lg border border-gray-200 overflow-auto text-sm">&lt;script src="{{ route('ads.embed.script', ['token' => $ad->manual_embed_token]) }}?w=728&amp;h=90"&gt;&lt;/script&gt;</pre>
            <p class="text-sm text-gray-600 mt-2">Renders the ad inside a sandboxed iframe at the provided size. Ideal for consistent layout and isolation.</p>
        </div>
        <div>
            <div class="font-medium text-gray-900 mb-2">Instructions for another AI (prompt)</div>
            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200 text-sm whitespace-pre-wrap">Create a section to embed an
                advertisement by inserting the following script tag where the ad should appear:

                <script src="{{ route('ads.embed.script', ['token' => $ad->manual_embed_token]) }}"></script>

                Requirements:
                - The ad may be an image or custom HTML/script. Do not sanitize or alter it.
                - If it is an image and has a destination URL, clicking should navigate via the provided click URL so
                tracking works.
                - Ensure the container is responsive and does not overflow its parent.
                - Place the ad where it is most visible to users (e.g., above the fold or near relevant content).
            </div>
        </div>
    </div>

    <script>
        (function() {
            const w = document.getElementById('w');
            const h = document.getElementById('h');
            const btn = document.getElementById('updateSized');
            const code = document.getElementById('code-sized');
            const base = @json(route('ads.embed.script', ['token' => $ad->manual_embed_token]));
            const update = () => {
                const ws = (w.value || '').trim();
                const hs = (h.value || '').trim();
                const params = [];
                if (ws) params.push('w=' + encodeURIComponent(ws));
                if (hs) params.push('h=' + encodeURIComponent(hs));
                const url = base + (params.length ? ('?' + params.join('&')) : '');
                code.textContent = `<script src="${url}"><\/script>`;
            };
            btn && btn.addEventListener('click', update);
        })();
    </script>
@endsection
