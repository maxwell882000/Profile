import {ref} from "vue";

export default function () {
    const timerId = ref(null);

    function simpleDebounce(fn, delay = 300) {
        // caveat: only 1 timeout at a time because of the timerId;
        // that's why we leave this inside the component scope
        // and not as a global utility
        return ((...args) => {
            // only in browser
            clearTimeout(timerId.value)
            timerId.value = setTimeout(() => {
                timerId.value = null
                fn(...args)
            }, delay)
        })()
    }

    return {
        debounce: simpleDebounce
    }
}
