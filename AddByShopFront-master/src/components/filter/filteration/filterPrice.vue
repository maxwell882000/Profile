<template>
  <filter-item collapse="price" title="Цена">
    <range-with-inputs
        :initial-max="prices.max"
        :initial-min="prices.min"
        @update-full="fullUpdate"
        :min-constrain="0"
        :max-constrain="12000000"/>
  </filter-item>
</template>
<script>
import FilterItem from "@/components/filter/filteration/filterItem";
import RangeWithInputs from "@/components/helper/input/range/rangeWithInputs";
import {useStore} from "vuex";
import {computed} from "vue";

export default {
  components: {RangeWithInputs, FilterItem},
  setup() {
    const store = useStore();
    // eslint-disable-next-line no-unused-vars
    const addFilter = (val) => store.commit('productFilterByModule/addFilterBy', val)
    const prices = computed(() => store.getters['productFilterByModule/prices'])
    // eslint-disable-next-line no-unused-vars
    const getProduct = () => store.dispatch("productFilterByModule/getProducts", 1)

    function fullUpdate(val) {
      if (prices.value.max !== val[1] || prices.value.min !== val[0]) {
        addFilter({key: "min_price", item: val[0]});
        addFilter({key: "max_price", item: val[1]});
        getProduct();
      }
    }

    return {
      fullUpdate: fullUpdate,
      prices: prices
    }
  }
}
</script>