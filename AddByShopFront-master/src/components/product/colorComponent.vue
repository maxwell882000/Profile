<template>
  <div class="mb-4" v-if="colors.length !== 0">
    <h6>{{ $t("Цвет") }}</h6>
    <div class="color-select  ">
      <button
          v-for="(color, colorIndex) in colors"
          :key="'color_' + colorIndex"
          @click="setColor(color, colorIndex)"
          :class="['color-btn', this.selected === color.id && 'active']"
      >
        <img :src="color.image" class="m-auto" alt="color"/>
        <small>{{ color.color_name }}</small>
      </button>
    </div>
  </div>
</template>
<script>
import {mapActions, mapGetters, mapMutations} from "vuex";

export default {
  computed: {
    ...mapGetters({
      colors: 'productModule/colors',
      product: 'productModule/product',
      selectOrder: 'backetModule/chosenColors'
    }),
    selected() {
      return this.selectOrder(this.product.id)
    }
  },
  methods: {
    ...mapMutations({
      setImageList: "productModule/setImageList",
      setOrder: "backetModule/setOrder",
    }),
    ...mapActions({
      updateParams: "backetModule/updatePreOrder"
    }),
    setColor(color) {
      this.setImageList(color.images);
      const response = {
        id: color.id,
        name: color.color_name
      };
      this.setOrder({
        id: this.product.id,
        key: "colors",
        value: response
      });

      this.updateParams({colors: response});
    }
  }
}
</script>
<style lang="scss">
.color-btn {
  min-height: 7.786rem;
  width: 5.714rem;
  padding: 0.5rem;
}

.color-select {
  display: flex;
  flex-wrap: wrap;

  small {
    font-size: 0.929rem !important;
    line-height: 1.124rem;
  }
}
</style>