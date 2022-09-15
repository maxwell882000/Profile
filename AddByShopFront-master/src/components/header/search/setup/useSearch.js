import {ref, watch} from "vue";
import simpleDebounceVueMixin from "simple-debounce-vue-mixin";
import {useStore} from "vuex";
import {useRoute} from "vue-router";

export default function () {
    const router = useRoute();
    const onFocus = ref(false);

    function leaveFocus() {
        setTimeout(() => onFocus.value = false, 150);
    }

    const search = ref(router.params.search || "");
    const store = useStore();
    const getSearchHelper = (val) => store.dispatch("searchModule/getSearchHelper", val);
    // eslint-disable-next-line no-unused-vars
    watch(search, (old, newVal) => {
        simpleDebounceVueMixin.methods.simpleDebounce(() => {
            getSearchHelper(newVal);
        })
    });
    watch(() => router.params, (val) => {
        search.value = val.search || "";
    })

    function clearSearch() {
        search.value = "";
    }

    function submitSearch() {
        console.log(search);
    }

    return {
        search: search,
        clearSearch: clearSearch,
        submitSearch: submitSearch,
        leaveFocus: leaveFocus,
        onFocus: onFocus
    }
}