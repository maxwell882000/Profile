<template>
  <div v-show="show !== -1">
    <div class="d-flex p-2 justify-content-between align-items-center">
      <div>
        <span class="text-sm">{{ name }}</span>
      </div>
      <div>
        <input-toggle @toggled="toggle"></input-toggle>
      </div>
    </div>
    <hr>
  </div>
</template>
<script>
import InputToggle from "@/components/helper/input/inputToggle";
import {useStore} from "vuex";
import {computed} from "vue";

export default {
  props: ['name', 'prefix'],
  components: {InputToggle},
  setup(props) {
    const store = useStore();
    const addFilter = (val) => store.commit("productFilterByModule/addFilterBy", val);
    const getProduct = () => store.dispatch("productFilterByModule/getProducts", 1);

    function toggle(val) {
      addFilter({key: props.prefix, item: val});
      getProduct();
    }

    return {
      toggle: toggle,
      show: computed(() => store.getters['productFilterByModule/' + props.prefix])
    }
  }
}
</script>