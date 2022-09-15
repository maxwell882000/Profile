<template>
  <div class="card mt-3 py-2 px-3">
    <input-select v-model="checkShop">
      <span class="bi bi-shop text-secondary me-1"></span>
      <router-link class="remove-link" :to="'/shop/' + order.shop.slug">
        <span class="text-md text-500 px-2">{{ order.shop.name }}</span>
        <span class="text-secondary bi bi-chevron-right"></span>
      </router-link>
    </input-select>
    <div class="line"></div>
    <CartItem :key="'basket_item_shop_' + order.id" v-for="order in order.orders"
              :index="index"
              :order="order"
    />
  </div>
</template>
<script>
import CartItem from "@/components/cart/Cart-item";
import {mapGetters, mapMutations} from "vuex";
import InputSelect from "@/components/helper/input/inputSelect";

export default {
  components: {InputSelect, CartItem},
  props: {
    order: Object,
    index: Number
  },
  computed: {
    ...mapGetters({
      isAllInShop: 'prepareBasketModule/isInShopSelected'
    }),
    checkShop: {
      get() {
        return this.isAllInShop(this.index);
      },
      set(val) {
        if (val) {
          this.addAllInShop(this.index);
        } else {
          this.cleanAllInShop(this.index);
        }
      }
    }
  },
  methods: {
    ...mapMutations({
      addAllInShop: 'prepareBasketModule/addAllInShop',
      cleanAllInShop: 'prepareBasketModule/cleanAllInShop'
    })
  }
}
</script>