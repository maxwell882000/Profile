<template>
  <b-row class="items-list">
    <template :key="'product_keys_id' + item.id" v-for="item in products">
      <b-col v-if="!isList" cols="6"
             class="col-xl-3 col-lg-4 col-md-6 col-sm-6 p-mobile">
        <ItemCard class="m-auto " :product="item"/>
      </b-col>
      <b-col v-else cols="12">
        <!--        <span>asdad</span>-->
        <ItemList :product="item"></ItemList>
      </b-col>
    </template>

  </b-row>
  <pagination-product v-show="checkPagination"></pagination-product>
</template>
<script>
import ItemCard from "@/components/shared/item/ItemCard";
import PaginationProduct from "@/components/helper/pagination/paginationProduct";
import {mapGetters} from "vuex";
import ItemList from "@/components/shared/item/ItemList";

export default {
  // eslint-disable-next-line vue/no-unused-components
  components: {ItemList, PaginationProduct, ItemCard},
  computed: {
    ...mapGetters({
      products: "productFilterByModule/productData",
      checkPagination: "productFilterByModule/checkPagination",
      isList: "productFilterByModule/isList"
    })
  }
}
</script>
<style lang="scss" scoped>
.col {
  margin-bottom: var(--marinTop);
}
</style>