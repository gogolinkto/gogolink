<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="pb-6">
            <slot name="logo" />
        </div>

        <div class="w-full sm:max-w-md mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-xl">
            <slot />
        </div>
    </div>
</template>
