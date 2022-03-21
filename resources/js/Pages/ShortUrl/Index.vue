<template>
    <Head title="Short Urls" />
    <AppLayout>
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Manage your URL's
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="text-xl font-semibold pb-4">Let's make it shorter</h1>
                <form @submit.prevent="addUrl" class="bg-white overflow-hidden p-4 rounded-lg">
                    <div class="flex space-x-4">
                        <input v-model="addUrlForm.redirect_to" type="text" placeholder="Enter here the url you want to short: ex. https://google.com/" class="flex-1 rounded-lg border-gray-200">
                        <input v-model="addUrlForm.slug" type="text" placeholder="Want a custom slug?" class="w-64 rounded-lg border-gray-200">
                        <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-medium px-6 rounded-lg">Make it shorter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center pb-6">
                    <h1 class="font-semibold text-xl">Currently active</h1>
                    <p class="text-xs pl-3 pt-2 text-gray-500">Most recent first</p>
                </div>
                <div v-if="!urls || urls.length === 0" class="text-gray-400 flex items-center justify-center py-16 border border-dashed rounded-lg border-gray-300">
                    Nothing to show in here
                </div>
                <div v-else class="grid grid-cols-1 gap-4">
                    <ShortUrlLine v-for="url in urls" :key="url.id" :url="url" />
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3'
import AppLayout from '../../Layouts/AppLayout';
import ShortUrlLine from '@/Components/ShortUrlLine';

defineProps({ urls: Array })

const addUrlForm = useForm({ redirect_to: '', slug: null });

function addUrl() {
    addUrlForm
        .transform(({ slug, ...rest }) => {
            const sendSlug = slug !== null && slug.trim().length > 0;
            return { ...rest, ...(sendSlug ? { slug } : {}) };
        })
        .post('/short-urls');
    addUrlForm.reset();
}
</script>
