<template>
  <header-product>
    <section class="section-container mt-3">
      <b-row>
        <b-col cols="12" class="col-xl-5 col-lg-6 col-md-12 col-sm-12 py-4">
          <div :class=" index!==0 && 'mt-4'" :key="'characteristics_item_' + main.id"
               v-for="(main,index) in product.characteristics">
            <h6>{{ main.header }}</h6>
            <table class="dotted-table text-dark">
              <tr v-for="(items, index) in main.values" :key="'char_'  + index">
                <th><span>{{ items.key }}</span></th>
                <th><span>{{ items.value }}</span></th>
              </tr>
            </table>
          </div>
        </b-col>
      </b-row>

    </section>
  </header-product>

</template>
<script>
import HeaderProduct from "@/components/product/header/headerProduct";
import {mapGetters} from "vuex";

export default {
  components: {HeaderProduct},
  computed: {
    ...mapGetters({
      product: 'productModule/product'
    }),
    firstChar() {
      return this.product.characteristics[0];
    },
  }
}
</script>
<style scoped>
h6 {
  font-size: 18px;
  line-height: 22px;
  font-weight: 500;
}
</style>