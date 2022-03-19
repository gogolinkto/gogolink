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
                <div v-else class="grid grid-cols-3 gap-4">
                    <div v-for="url in urls" :key="url.id" class="rounded-lg p-6 bg-white flex flex-col justify-between">
                        <div class="flex flex-col items-center pb-2">
                            <a :href="url.url" class="hover:text-blue-500 font-medium hover:underline">{{url.url}}</a>
                            <div class="py-2 text-gray-600 text-sm">redirects to</div>
                            <a :href="url.redirect_to" class="hover:text-blue-500 hover:underline break-all">{{ url.redirect_to }}</a>
                        </div>
                        <div class="flex justify-between text-xs border-t border-gray-200 -mx-6 pt-4 -mb-2 px-6 mt-6">
                            <div><button>Copy Url</button></div>
                            <div v-if="url.visit_count === 0">Never used</div>
                            <div v-else-if="url.visit_count === 1">Used {{ url.visit_count }} time</div>
                            <div v-else>Used {{ url.visit_count }} times</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/inertia-vue3'
import AppLayout from '../../Layouts/AppLayout';

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
