<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-4 gap-6">
                <div class="bg-white px-6 py-7 rounded-xl flex flex-col items-center justify-center space-y-2">
                    <h1 class="text-3xl font-medium">{{ shortUrlCount }}</h1>
                    <span class="text-sm text-gray-400">Shorten Urls</span>
                </div>
                <div class="bg-white p-6 rounded-xl flex flex-col items-center justify-center space-y-2">
                    <h1 class="text-3xl font-medium">{{ visitCount }}</h1>
                    <span class="text-sm text-gray-400">Total Clicks</span>
                </div>
                <div class="border border-dashed border-gray-300 p-6 rounded-xl">
                </div>
                <div class="border border-dashed border-gray-300 p-6 rounded-xl">
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            </div>
        </div>
    </app-layout>
</template>

<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue'

    defineProps({
        shortUrlCount: {
            type: Number,
            default: () => 0,
        },
        visitCount: {
            type: Number,
            default: () => 0,
        }
    })
</script>
