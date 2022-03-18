<template>
    <Link :href="'/'">
        <h1 class="text-3xl font-semibold">{{ pageProps.appName }}</h1>
    </Link>
</template>

<script setup>
    import { Link, usePage } from '@inertiajs/inertia-vue3';

    const { props: pageProps } = usePage();
</script>
