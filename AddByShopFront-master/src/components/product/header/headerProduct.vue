<template>
  <section class="container price-desc mb-3">
    <back-button class="mb-3" :title="$t('К описанию товара')"></back-button>
    <section
        class="section-container d-flex justify-content-between flex-wrap flex-sm-wrap flex-md-wrap flex-lg-nowrap">
      <div class
               ="title_product d-flex align-items-center">
        <div>
          <span class="text-500 product-name">{{ name }}</span>
          <header-product class="header-product flex-md-wrap"></header-product>
        </div>
      </div>
      <div class="d-flex align-items-center price-com w-sm-100 w-max">
        <div>
          <price-component></price-component>
        </div>
      </div>
      <div class="d-flex buttons align-items-center w-max">
        <div class="button-install  w-100 flex-fill">
          <buy-installment-button></buy-installment-button>
        </div>
        <div class="d-flex linked w-100">
          <buy-fast-button class="flex-fill"></buy-fast-button>
          <bag-button></bag-button>
        </div>
      </div>
    </section>
    <slot></slot>
  </section>
</template>


<script>
import BackButton from "@/components/helper/button/backButton";
import HeaderProduct from "@/components/product/headerProduct";
import {mapGetters} from "vuex";
import PriceComponent from "@/components/product/priceComponent";
import BuyInstallmentButton from "@/components/product/button/buyInstallmentButton";
import BagButton from "@/components/product/button/bagButton";
import BuyFastButton from "@/components/product/button/buyFastButton";

export default {
  // eslint-disable-next-line vue/no-unused-components
  components: {
    BuyFastButton,
    BagButton,

    BuyInstallmentButton,
    PriceComponent,
    HeaderProduct,
    BackButton
  },
  computed: {
    ...mapGetters({
      name: "productModule/name",
    }),
  },

}
</script>
<style lang="scss">
.price-desc {
  .product-name {
    font-size: 14px;
    line-height: 17px;
  }

  .rating {
    margin-bottom: 0 !important;
  }

  .title_product {
    flex: 0.6;
    @media (max-width: 991px) {
      flex: 1;
    }
  }

  .buttons {
    white-space: nowrap;

    .button-install {
      margin-right: 10px;
    }

    @media (max-width: 991px) {
      width: 100%;
    }
    @media (max-width: 349px) {
      flex-wrap: wrap-reverse;
      flex: 1;
      .button-install {
        margin-right: 0;
      }
      .linked {
        margin-bottom: 0.1rem;

      }
      .buy-now {
        margin-right: 3px;
      }
    }
  }

  .header-product {
    font-size: 0.8rem;
  }

  .price {
    padding-bottom: 0 !important;
    border-bottom: 0 !important;
  }

  .price-com {
    white-space: nowrap;
    @media (max-width: 767px) {
      width: 100% !important;
    }
  }
}

</style>