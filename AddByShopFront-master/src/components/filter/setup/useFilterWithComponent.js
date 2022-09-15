import {useStore} from "vuex";
import {onBeforeUnmount, onMounted} from "vue";

export default function (logic = () => {
}) {
    const store = useStore();
    const partialClean = () => store.commit("productFilterByModule/partialClean");
    const clean = () => store.commit("productFilterByModule/clean");
    const getProducts = (val) => store.dispatch('productFilterByModule/getProducts', val);
    onMounted(() => {
        partialClean();
        logic();
        getProducts(1);
    });
    onBeforeUnmount(() => {
        clean();
    })
}