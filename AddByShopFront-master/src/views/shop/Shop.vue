<template>
  <loader waiting="shop_loaded">
    <section class="container shop-card">
      <div class="margin-cont">
        <shop-header :shop="shop"></shop-header>
        <filter-with-products></filter-with-products>
      </div>
      <!--    <product-wrapper></product-wrapper>-->
    </section>
  </loader>

</template>

<script setup>
import Loader from "@/components/loading/loader";
import FilterWithProducts from "@/components/filter/component/filterWithProducts";
import ShopHeader from "@/components/shop/shopHeader";
import {useStore} from "vuex";
import {computed} from "vue";
import useFilterWithComponent from "@/components/filter/setup/useFilterWithComponent";
import useFilterBy from "@/components/filter/setup/useFilterBy";
import {useRoute} from "vue-router";

const store = useStore();
const route = useRoute();

const shop = computed(() => store.getters['shopModule/shop']);
const getShop = (val) => store.dispatch("shopModule/getShop", val);
getShop(route.params.shop);
useFilterWithComponent(useFilterBy({key: "shop_id", item: shop.value.id}))
</script>

<style lang="scss">
.shop-card {
  .star {
    color: var(--yellow) !important;
  }

  .container {
    @media (max-width: 768px) {
      all: unset;
    }
  }

  .row {
    @media (max-width: 768px) {
      margin: 1rem 0 !important;
    }
  }

  .margin-cont {
    margin-bottom: 2rem;
  }

  .thumbnail {
    width: 100%;
    margin-top: 2rem;
    margin-bottom: 2rem;
    height: 300px;
    //background-image: url("../assets/shop_cover.png");
    background-size: cover; /* <------ */
    background-repeat: no-repeat;
    background-position: center center;
    border-radius: 12px;
    //@media (max-width: 575px) {
    //  margin-left: 2px;
    //}

    .seller-cart {
      background-color: white;
      border-radius: 12px;
      height: 12rem;
      margin-bottom: -2rem;
      box-shadow: 10px 9px 19px rgba(0, 0, 0, 0.17);
      padding: 20px;

      img.logo {
        box-shadow: 0px 0.70562px 4.93934px rgba(0, 0, 0, 0.2);
        width: 74px;
        border-radius: 12px;
      }
    }
  }
}
</style>
