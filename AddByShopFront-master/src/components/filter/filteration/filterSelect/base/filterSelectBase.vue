<template>
  <filter-item v-if="iterate.length !== 0" :collapse="prefix" :title="title">
    <filter-select>
      <b-form-group v-slot="{ ariaDescribedby }">
        <input-select :aria-describedby="ariaDescribedby"
                      class="text-left"
                      v-model="isCollected" :value="item"
                      :name="prefix"
                      :key=" prefix + '_filter_select_' + item.id"
                      v-for="item in iterate">
          <slot :item="item"></slot>
        </input-select>
      </b-form-group>
    </filter-select>
  </filter-item>
</template>
<script>
import FilterSelect from "@/components/filter/filteration/filterSelect";
import FilterItem from "@/components/filter/filteration/filterItem";
import InputSelect from "@/components/helper/input/inputSelect";
import useFilterSelect from "@/components/filter/filteration/filterSelect/setup/useFilterSelect";

export default {
  components: {InputSelect, FilterItem, FilterSelect},
  props: ['title', 'prefix'],
  setup(props) {
    return useFilterSelect(props.prefix);
  },
  // setup() {
  //   const store = useStore();
  //   const iterate = computed(() => store.getters['productFilterByModule/brand']);
  //   const addChosen = (value) => store.dispatch("productFilterByModule/addToChosenFilterAndGetProduct", value);
  //   const isCollected = computed({
  //     get() {
  //       return store.getters['productFilterByModule/getChosenItems']({values: iterate.value, prefix_key: "brand_id"})
  //     },
  //     set(val) {
  //       console.log(iterate);
  //       addChosen({prefix_key: "brand_id", chosen: val, old: iterate.value});
  //     }
  //   });
  //   return {
  //     isCollected: isCollected,
  //     iterate: iterate
  //   }
  // },
  // data() {
  //   return {
  //     collect: [],
  //   }
  // },
  // computed: {
  //   ...mapGetters({
  //     brand: "productFilterByModule/brand",
  //     getChosen: 'productFilterByModule/getChosenItems'
  //   }),
  //   isCollected: {
  //     get() {
  //       return this.getChosen({values: this.brand, prefix_key: "brand_id"});
  //     },
  //     set(val) {
  //       this.collect = val;
  //       this.addChosen({prefix_key: "brand_id", chosen: val, old: this.brand});
  //     }
  //   }
  // },
  // methods: {
  //   ...mapActions({
  //     addChosen: 'productFilterByModule/addToChosenFilterAndGetProduct',
  //   })
  // }
}
</script>