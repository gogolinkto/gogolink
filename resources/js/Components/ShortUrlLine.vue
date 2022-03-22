<template>
    <div class="rounded-lg p-6 bg-white flex justify-between items-center">
        <div>
            <a :href="url.url" class="block hover:text-blue-500 font-medium hover:underline">{{url.url}}</a>
            <a :href="url.redirect_to" class="hover:text-blue-500 hover:underline break-all text-xs pt-1">{{ url.redirect_to }}</a>
        </div>
        <div class="space-x-2">
            <button
                @click="copy(url.url)"
                class="text-white px-2 py-1 text-xs rounded"
                :class="{
                    'bg-slate-900': !copied,
                    'bg-green-500 shadow-lg': copied,
                }"
            >
                {{ copied ? 'Copied' : 'Copy' }}
            </button>
            <button
                @click.prevent="removeUrl(url)"
                class="text-white px-2 py-1 text-xs rounded bg-red-500"
            >
                Delete
            </button>
        </div>
    </div>
</template>
<script setup>
import { useClipboard } from '@/Composables/useClipboard';
import { Inertia } from '@inertiajs/inertia';

defineProps({ url: Object })

const { copied, copy } = useClipboard();

function removeUrl(url) {
    if (confirm('Do you really want to delete this url and all its statistics?')) {
        Inertia.delete(route('short-urls.destroy', url.id));
    }
}
</script>
