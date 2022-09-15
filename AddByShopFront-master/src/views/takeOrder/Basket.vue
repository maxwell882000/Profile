<template>
  <loader waiting="basket">
    <section class="container  py-3">
      <Badge class="mb-2" :path="badgePath"/>
      <empty-backet v-if="!countOrder"></empty-backet>
      <template v-else>
        <Orders></Orders>
        <section v-show="product.length > 0" class="bg-white-sm p-mobile mt-3">
          <div class="pt-2"></div>
          <h5 class="text-header-32 pt-1 mb-3 text-sm-center">{{ $t("Вам может быть интересно") }}</h5>
          <SalesRoll :products="product"/>
        </section>
      </template>
    </section>
  </loader>
  <div style="height: 4rem">
  </div>
</template>

<script>
import SalesRoll from "@/components/shared/SalesRoll.vue";
import Badge from "@/components/shared/Badge.vue";
// import EmptyBacket from "@/components/backet/emptyBacket";
import Orders from "@/components/backet/orders";
import EmptyBacket from "@/components/backet/emptyBacket";
import {mapActions, mapGetters, mapMutations} from "vuex";
import Loader from "@/components/loading/loader";

export default {
  data() {
    return {
      badgePath: [
        {
          name: this.$t("Главная"),
          path: "/",
        },
        {
          name: this.$t("Корзина"),
          path: "/cart",
        },
      ],
    };
  },
  computed: {
    ...mapGetters({
      countOrder: "prepareBasketModule/countOrders",
      product: "prepareBasketModule/interistingProduct"
    })
  },
  methods: {
    ...mapActions({
      getOrders: "prepareBasketModule/getOrders",
      getProducts: "prepareBasketModule/getInteristingProduct"
    }),

    ...mapMutations({
      cleanDelivery: 'deliveryInfoModule/cleanAll',
      cleanPrepare: 'registrationOrderModule/clean',
      cleanPayment: 'wayOfPaymentModule/clean'
    })
  },
  components: {Loader, EmptyBacket, Badge, SalesRoll, Orders},
  created() {
    this.getOrders();
    this.getProducts();
    this.cleanDelivery();
    this.cleanPrepare();
    this.cleanPayment();
  },

};
</script>

