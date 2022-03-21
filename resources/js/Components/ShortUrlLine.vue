<template>
    <div class="rounded-lg p-6 bg-white flex justify-between items-center">
        <div>
            <a :href="url.url" class="block hover:text-blue-500 font-medium hover:underline">{{url.url}}</a>
            <a :href="url.redirect_to" class="hover:text-blue-500 hover:underline break-all text-xs pt-1">{{ url.redirect_to }}</a>
        </div>
        <div>
            <button
                @click="copy(url.url)"
                class="text-white px-3 py-1 text-sm rounded-lg"
                :class="{
                    'bg-slate-900': !copied,
                    'bg-green-500 shadow-lg': copied,
                }"
            >
                {{ copied ? 'Copied' : 'Copy' }}
            </button>
        </div>
    </div>
</template>
<script setup>
import { ref } from 'vue';

defineProps({
    url: Object,
})

const copied = ref(false);

function copy(text) {
    navigator.clipboard.writeText(text);
    copied.value = true;
    setTimeout(() => {
        copied.value = false;
    }, 1500);
}
</script>
