import {useStore} from "vuex";
import {computed} from "vue";

export default function (prefix) {
    const store = useStore();
    const iterate = computed(() => store.getters['productFilterByModule/' + prefix]);
    const addChosen = (value) => store.dispatch("productFilterByModule/addToChosenFilterAndGetProduct", value);
    const isCollected = computed({
        get() {
            return store.getters['productFilterByModule/getChosenItems']({
                values: iterate.value,
                prefix_key: prefix + "_id"
            })
        },
        set(val) {
            addChosen({prefix_key: prefix + "_id", chosen: val, old: iterate.value});
        }
    });
    return {
        isCollected: isCollected,
        iterate: iterate
    }
}