import { readonly, ref } from 'vue';

export function useClipboard() {
    const copied = ref(false);

    function copy(text) {
        navigator.clipboard.writeText(text);
        copied.value = true;
        setTimeout(() => {
            copied.value = false;
        }, 1500);
    }

    return {
        copied: readonly(copied),
        copy
    };
}
