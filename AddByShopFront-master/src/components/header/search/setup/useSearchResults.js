import {useStore} from "vuex";
import {computed} from "vue";

export default function () {
    const store = useStore();
    const results = computed(() => store.getters["searchModule/searchHelpers"]);
    const isVisible = computed(() => results.value.length)
    return {
        searchHelpers: results,
        isVisible:isVisible
    }
}