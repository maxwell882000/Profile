import {useStore} from "vuex";
import {computed} from "vue";

export default function () {
    const store = useStore();
    const selectComponent = computed(() => store.getters['productModule/selectComponent']);
    const path = computed(() => store.getters['productModule/path']);
    const name = computed(() => store.getters['productModule/name']);

    return {
        selectComponent: selectComponent,
        path: path,
        name: name,
    }
}