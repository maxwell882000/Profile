import {useI18n} from "vue-i18n";
import {ref} from "vue";
import {useStore} from "vuex";

export default function (initial) {

    const t = useI18n().t;
// eslint-disable-next-line no-unused-vars
    const current = ref(initial || 0);
    const isDown = ref(false);
    const store = useStore();
    const addFilter = (val) => store.commit('productFilterByModule/addFilterBy', val);
    const getProduct = () => store.dispatch("productFilterByModule/getProducts", 1);

    function applySort(index) {
        console.log("asdsd");
        console.log(index);
        isDown.value = !isDown.value;
        const selectedItems = sortItems[index];
        clean(index);
        addFilter({key: selectedItems.key, item: isDown.value});
        addFilter({key: selectedItems.key + "_desc", item: !isDown.value});
        getProduct();
    }

    function clean(index) {
        sortItems.filter((e, i) => i !== index).forEach((e) => {
            addFilter({key: e.key, item: false});
            addFilter({key: e.key + "_desc", item: false});
        });
    }

    function changeTab(index) {
        if (current.value !== index) {
            current.value = index;
            isDown.value = true;
        }
    }

// eslint-disable-next-line no-unused-vars
    const sortItems = [
        {
            name: t("По цене"),
            key: "by_price",
        },
        // {
        //   name: t("По популярности"),
        //   key: "by_popularity",
        // },
        // {
        //   name: t("По рейтингу"),
        //   key: "by_rating",
        // },
        {
            name: t("По размеру скидки"),
            key: "by_discount",
        }
    ];
    return {
        sortItems: sortItems,
        applySort: applySort,
        changeTab: changeTab,
        isDown: isDown,
        current: current,
    }
}