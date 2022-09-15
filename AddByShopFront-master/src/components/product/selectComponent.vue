<template>
  <h6>{{ param.text }}</h6>
  <div class="d-flex flex-wrap">
    <button
        v-for="(option, optionIndex) in param.values"
        :key="'options_index_' + optionIndex+  '_value_ ' +  option.id"
        @click="selectedValue(option)"
        :class="[
                    'param-option',
                    selected === option.id && 'active'
                ]">
      {{ option.text }}
    </button>
  </div>
  <div class="mb-4"></div>
</template>
<script>
import {mapActions, mapGetters, mapMutations} from "vuex";

export default {
  props: {
    index: Number,
    param: {
      type: Object,
      default() {
        return {
          name: "Встроенная память, ГБ",
          options: ["32", "64", "128"],
        }
      }
    }
  },

  computed: {
    ...mapGetters({
      order: "backetModule/getPreOrder",
      additional: "backetModule/additional",
      product: "productModule/product",
      selectedOrder: "backetModule/chosenAdditional"
    }),
    selected() {
      return this.selectedOrder(this.product.id, this.index)
    }
  },
  methods: {
    ...mapActions({
      updateParams: "backetModule/updatePreOrder"
    }),
    ...mapMutations({
      setOrder: 'backetModule/setOrder'
    }),
    selectedValue(option) {
      let value = this.additional(this.product.id);
      value[this.index] = {
        key: this.param.text,
        value: option
      }
      this.setOrder({
        id: this.product.id,
        key: 'additional',
        value: value
      });
      this.updateParams({additional: {key: this.index, value: value[this.index]}});
    }
  }
}
</script>
