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
                <form @submit.prevent="addUrl" class="bg-white overflow-hidden flex space-x-6 p-4 rounded-lg">
                    <input v-model="addUrlForm.redirect_to" type="text" placeholder="Enter here the url you want to short: ex. https://google.com/" class="flex-1 rounded-lg border-gray-200">
                    <button type="submit" class="bg-slate-800 text-white font-medium px-6 rounded-lg">Make it shorter</button>
                </form>
            </div>
        </div>
        <div class="pb-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h1 class="font-semibold text-xl pb-6">Currently active</h1>
                <div v-if="!urls || urls.length === 0" class="text-gray-400 flex items-center justify-center py-16 border border-dashed rounded-lg border-gray-300">
                    Nothing to show in here
                </div>
                <div v-else>
                    <ul v-for="url in urls" :key="url.id">
                        <li>
                            <a :href="url.url" class="hover:text-blue-500 hover:underline">{{url.url}}</a>
                            - {{ url.redirect_to }} (Visited {{ url.visit_count }} times)</li>
                    </ul>
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
        .transform(({ slug, ...rest }) => ({ ...rest, ...(slug !== null ? { slug } : {}) }))
        .post('/short-urls');
}
</script>
