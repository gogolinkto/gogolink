<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                    ? 'inline-flex items-center px-1 pb-1 border-t-2 border-white text-sm font-medium leading-5 text-white focus:outline-none focus:border-indigo-700 transition'
                    : 'inline-flex items-center px-1 pb-1 border-t-2 border-transparent text-sm font-medium leading-5 text-white hover:text-white hover:border-slate-300 focus:outline-none focus:text-gray-700 focus:border-white transition'
            }
        }
    })
</script>
