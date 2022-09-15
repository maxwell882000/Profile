<template>
  <div class="cart-item">
    <div class="row align-items-center justify-content-space-between">
      <div class="col col-12 col-md-7 d-flex align-items-center">
        <input-select v-model="check"/>
        <div class="cart-item__image">
          <img
              class="img-res"
              :src="itemInfo.image"
              :alt="itemInfo.title"
          />
        </div>
        <div>
          <small class="old-price d-block">
               <span v-show="itemInfo.discount_price">
                        {{ showPrice }}
          </span>
          </small>
          <h6 class="mb-1">{{ showRealPrice }}</h6>
          <p>{{ itemInfo.title }}</p>
        </div>
      </div>
      <div
          class="count-btns
          col col-7 col-sm-10 col-md-3
          d-flex">
        <p class="mb-0">
          <button :style="styleQuantity" @click="decrementQuantity" class="btn btn-light">-</button>
          <span class="px-3 fw-bold">{{ quantity }}</span>
          <button @click="incrementQuantity" class="btn btn-light">+</button>
        </p>
      </div>
      <div class="col col-5 col-sm-2 col-md-2 d-flex justify-content-end">
        <trash @click="deleteOrder({order_id: order.id, index:index})"></trash>
      </div>
    </div>
  </div>
</template>

<script>
import Trash from "@/components/icons/trash";
import InputSelect from "@/components/helper/input/inputSelect";
import {mapActions, mapGetters, mapMutations} from "vuex";
import price_formatter from "@/mixins/price_formatter";

export default {
  components: {InputSelect, Trash},
  props: {
    id: String,
    order: Object,
    index: Number,
  },
  data() {
    return {
      quantity: this.order.quantity,
      itemInfo: this.order.product,
      styleQuantity: {
        'cursor': this.order.quantity === 1 && 'not-allowed' || 'pointer'
      }
    };
  },
  computed: {
    ...mapGetters({
      selected: "prepareBasketModule/getSelectedItem"
    }),
    showPrice() {
      return price_formatter(this.itemInfo.price);
    },
    showRealPrice() {
      return price_formatter(this.itemInfo.real_price);
    },
    check: {
      get() {
        return !!this.selected(this.order.id);
      },
      set(val) {
        if (val) {
          this.addToSelectedOrders(this.order);
        } else {
          this.removeFromSelectedOrders(this.order);
        }
      }
    }
  },
  methods: {
    ...mapActions({
      update: "prepareBasketModule/updateQuantityOrder",
      deleteOrder: "prepareBasketModule/deleteOrders"
    }),
    ...mapMutations({
      addToSelectedOrders: "prepareBasketModule/addToSelectedOrders",
      removeFromSelectedOrders: "prepareBasketModule/removeSelectedOrders"
    }),
    incrementQuantity() {
      this.quantity = this.quantity + 1;
      this.styleQuantity = {};
      this.updateQuantity();
    },
    updateQuantity() {
      if (this.check) {
        this.addToSelectedOrders(this.order);
      }
      this.update({
        order_id: this.order.id, quantity: this.quantity,
        index: this.index
      });
    }
    ,
    decrementQuantity() {
      this.quantity = (this.quantity - 1) || ((this.styleQuantity['cursor'] = 'not-allowed') && 1);
      this.updateQuantity();
    }

  }
};
</script>

<style scoped>
.cart-item__image {
  padding: 1.2rem;
  width: 5.9rem;
  height: 5.6rem;
}

.count-btns {
  justify-content: center;
}

@media (max-width: 767px) {
  .count-btns {
    justify-content: start;
  }
}

.count-btns button {
  border-radius: 12px;
  font-weight: 500;
  color: #29334b;
}
</style>