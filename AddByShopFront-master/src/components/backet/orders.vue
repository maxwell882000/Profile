<template>
  <div class="mb-3">
    <h4 class="my-3 inline">{{ $t("Корзина") }}</h4>
    <span class="text-muted ms-2 mb-1">{{ count }} {{ $t("товара") }} </span>
  </div>
  <div class="row">
    <div class="col col-12 col-lg-8">
      <div class="card py-2 px-3 ">
        <div class="w-100 d-flex align-items-center">
          <div style="flex: 1">
            <input-select v-model="checkALlOrder">
             <span class="text-sm text-center">
                     {{ $t("Выбрать все товары") }}
               </span>
            </input-select>
          </div>
          <span @click="deleteSelected" class="pointer text-red text-sm" v-show="numberSelectedOrders">
            {{ $t("Удалить выбранные") }}
          </span>
        </div>
      </div>
      <basket-order :key="'basket_gotted_' + item.shop.slug" v-for="(item, index) in allOrders"
                    :index="index" :order="item"></basket-order>
    </div>
    <prepare-order-calculate-pricing></prepare-order-calculate-pricing>
  </div>
</template>
<script>

import BasketOrder from "@/components/backet/basketOrder";
import {mapActions, mapGetters, mapMutations} from "vuex";
import PrepareOrderCalculatePricing from "@/components/backet/prepareOrderCalculatePricing";
import InputSelect from "@/components/helper/input/inputSelect";

export default {
  components: {InputSelect, PrepareOrderCalculatePricing, BasketOrder},
  data() {
    return {
      buttonDisabled: true,
      itemInfo: {
        oldPrice: "3 071 880",
        price: "2 898 000",
        name: "Смартфон Samsung Galaxy A12 (SM-A125) 3/32 ГБ RU, красный",
        picture:
            "https://www.lg.com/in/images/tvs/md06117716/gallery/Desk-02.jpg",
      },
    };
  },
  computed: {
    ...mapGetters({
      allOrders: "prepareBasketModule/allOrders",
      isAllSelected: "prepareBasketModule/allSelected",
      count: "prepareBasketModule/count",
      numberSelectedOrders: "prepareBasketModule/numberSelectedOrders"
    }),

    checkALlOrder: {
      get() {
        return this.isAllSelected;
      },
      set(val) {
        if (val)
          this.setAll();
        else {
          this.cleanAll();
        }
      }
    }
  },
  methods: {
    ...mapActions({
      deleteSelected: 'prepareBasketModule/deleteSelectedOrders'
    }),
    ...mapMutations({
      setAll: 'prepareBasketModule/addAllToSelected',
      cleanAll: "prepareBasketModule/cleanSelectedOrders"
    }),
    checkAll(event) {
      this.checkALlOrder = event.target.checked;
    },
  }
};

</script>