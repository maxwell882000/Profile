<template>
  <loader waiting="product">
    <router-view></router-view>
  </loader>
</template>
<script>
import {mapActions, mapMutations} from "vuex";
import Loader from "@/components/loading/loader";

export default {
  components: {Loader},
  methods: {
    ...mapActions({
      loadProduct: "productModule/loadProduct",
      getComments: "commentModule/getComments",
      getRate: "rateModule/getRate"
    }),
    ...mapMutations({
      cleanComment: "commentModule/clean",
      cleanRate: 'rateModule/clean'
    }),
  },
  async created() {
    await this.loadProduct(this.$route.params.id);
    this.getComments();
    this.getRate();
  },
  beforeUnmount() {
    this.cleanRate();
    this.cleanComment();
  }
}
</script>
<style lang="scss">
.cols {
  margin-bottom: 30px;
}

.star {
  color: var(--yellow) !important;
}

.badges {
  margin-top: 16px;
  margin-bottom: 4px;
}

.shop-link,
.shop-link * {
  text-decoration: none;
  color: black;
}


.seller {
  text-decoration: none;
  color: black;
  width: 70%;
  padding: 5px;
  border-radius: 7px;

  &:hover {
    background-color: rgba(248, 247, 247, 0.7);
  }
}

.payment-info {
  background-color: white;
  padding: 24px;
  border-radius: 12px;


  .installment-plan {
    text-align: center;
    border: 1px solid #f2f2f2;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;

    .col {
      padding: 10px 0 !important;
      line-height: 15px;
      border-right: 1px solid #f2f2f2;

      &:first-child {
        border-radius: 12px 0 0 12px;
      }

      &:last-child {
        border-radius: 0 12px 12px 0;
        border-right: none !important;
      }
    }

    .col.active {
      background-color: var(--blue);
      color: white;
    }
  }

  .installment-pay {
    padding-bottom: 5px;
    margin-bottom: 20px;
    border-bottom: 1px solid #f2f2f2;

    .payment-param {
      font-size: 12px;
      margin-bottom: 9px;
    }

    .payment-data {
      line-height: 15px;
      font-weight: 500;
      font-size: 14px;
      margin-bottom: 0px;

      &.percents {
        color: green;
      }
    }
  }


}

.buttons {
  .buy-now {
    margin-right: 10px;
  }

  button {
    transition: all 0.3s;
    border: none;
    background-color: #f2f2f2;
    padding: 0.65rem;
    border-radius: 9px;
    color: #282f3c;
    font-size: 14px;
    font-weight: 500;
    @media (max-width: 768px) {
      padding: 1rem;
    }

    &:hover {
      background-color: var(--gray400);;
    }
  }

  .add2cart {
    padding-left: 0;
  }
}

.about-item {
  background-color: white;
  border-radius: 12px;
  padding: 20px;
  //margin-bottom: 30px;

  .about-content {
    max-width: 500px;
  }

  .tab-content {
    color: var(--gray200);
  }
}
</style>