<template>
  <div class="d-flex align-items-center flex-wrap flex-sm-wrap flex-md-nowrap desktop-price">
    <installmentPrice :credit="credit"></installmentPrice>
    <div class="my-2 my-sm-2 my-md-0 basket h-100">
      <CartButton class="basket h-100 card-desktop" :basket="basket" :image="image" :id="id"/>
    </div>
  </div>
</template>
<script>
import CartButton from "../../buttons/cart/CartButton";
import installmentPrice from './instalmentPrice';

export default {
  props: {
    credit: {
      type: Object,
      default() {
        return {
          name: "Рассрочка",
          price: "150 000",
          month: "2"
        }
      }
    },
    basket: {
      type: Boolean,
      default() {
        return false;
      },
    },
    image: {
      type: String,
    },
    id: {
      type: Number,
      default() {
        return undefined
      }
    }
  },
  components: {CartButton, installmentPrice}
}
</script>

<style scoped>
@media (min-width: 769px) {
  .desktop-price {
    height: 3.429rem;
  }

  .card-desktop {
    width: 3.429rem;
  }
}

@media (max-width: 491px) {
  /*.price {*/
  /*  display: none;*/
  /*}*/

}

/*.price .actual-number {*/
/*  font-size: 12px !important;*/
/*  line-height: 15px;*/
/*  font-weight: 400;*/
/*}*/

/*.price .actual-number span {*/
/*  font-size: 1rem;*/
/*  line-height: 17px;*/
/*  font-weight: 700;*/
/*}*/

.price .actual-number small {
  font-size: 0.8rem;
  font-weight: 400;
  line-height: 15px;
}

.price {
  border: 1px solid #F2F2F2;
  border-radius: 8px;
  padding: 0.5rem 0.571rem;
  margin-right: 8px;
  line-height: 17px;
  height: 100%;
  width: 100%;
}

.price .month {
  font-size: 0.8rem;
}

.price .numbers {
  color: var(--blue);
  font-weight: 700;
}

.basket-padding {
  padding: 0.357rem;
}


@media (max-width: 767px) {
  /*.price {*/
  /*  display: none;*/
  /*  margin-right: 0 !important;*/
  /*}*/
  .price {
    border: none !important;
    padding: 0;
    margin-right: 0;
  }

  .name-price {
    font-size: 0.857rem;
    line-height: 1.071rem;
  }

  .price .numbers {
    font-size: 1.143rem;
    line-height: 1.214rem;
  }

  .price .month {
    font-size: 0.929rem;
    line-height: 1.143rem;
  }

  .basket {
    width: 95%;
  }
}
</style>