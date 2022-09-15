import {useStore} from "vuex";

export default function ({key, item}) {
    const store = useStore();
    const addFilter = (val) => store.commit('productFilterByModule/addFilterBy', val);
    return () => addFilter({key: key, item: item});
}