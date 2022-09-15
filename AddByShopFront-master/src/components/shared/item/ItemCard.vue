<template>
  <router-link :to="`/item/${product.id}`" class="item-card d-flex flex-column">
    <div class="item-card__image">
      <div class="item-card__image__like">
        <Like :id="product.id" :favourite="product.favourite"/>
      </div>
      <div class="image-sizing">
        <img v-lazy="product.image" class="img-res" center fluid alt="item image"/>
      </div>
      <div v-show="product.discount" class="item-card__image__sale-amount absolute">
        <span>-{{ product.discount }}%</span>
      </div>
    </div>
    <div class="item-card__content d-flex flex-column h-100 justify-content-between">
      <div class="item-card__rating">
        <span
            class="item-card__rating__star bootstrap-icon bootstrap-icon--size-sm bi bi-star-fill">
        </span>
        <span class="mx-1 rating">{{ product.mark }}</span>
        <span class="mx-2 rating">{{ product.num_comment }} {{ $t("отзывов") }}</span>
      </div>
      <div class="item-card__prices">
        <p class="item-card__prices__ex-price" v-show="isChangedPrice">{{ product.price }} {{ $t("сум") }}</p>
        <h6 class="item-card__prices__new-price">
          {{ product.real_price }} {{ $t("сум") }}
        </h6>
      </div>
      <p class="item-card__description two-only-sentence mb-1">{{ product.title }}</p>
      <div class="item-card__price">
        <ItemCardPrice
            :image="product.image"
            :basket="product.basket"
            :id="product.id"
            :credit="product.credit"
        />
      </div>
    </div>
  </router-link>
</template>

<script>
import ItemCardPrice from "./ItemCardPrice";
import Like from "../../buttons/Like";

export default {
  props: {
    product: {
      type: Object,
      default() {
        return {
          id: undefined,
          image: require('@/assets/item-image.png'),
          title: "Чехол Apple Leather Sleeve for MacBook Pro 13 black fdasfd afd dfsf fdsaf dfa ",

          favourite: false,
          basket: false,
          price: "3 071 880",
          real_price: "2 898 000",
          discount: 6,
          mark: 0,
          num_comment: 0,
          credit: {
            name: "Рассрочка",
            price: "150 000",
            month: "2",
          },
        };
      },
    },
  },
  computed: {
    isChangedPrice() {
      return this.product.real_price !== this.product.price;
    }
  },
  components: {Like, ItemCardPrice},
};
</script>

<style scoped lang="scss">
.item-card__prices__new-price {
  margin-bottom: 0 !important;
}

.item-card__description {
  font-size: 1rem;
}

.item-card {
  transition: all 0.3s;
  display: block;
  text-decoration: none;
  color: var(--dark);
  cursor: pointer;
  height: 29.429rem;
  position: relative;
  padding: 12px;
  background-color: white;
  border-radius: 12px;
  width: 16.286rem;
  box-shadow: 0 0 0 transparent;

  .image-sizing {
    height: 14.571rem;
    margin: auto;
  }

  .item-card__rating {
    .rating {
      font-size: 0.857rem !important;
      line-height: 1.071rem !important;
    }
  }


  .item-card__image__sale-amount {
    font-size: 12px !important;
    line-height: 15px;
    margin-bottom: 0 !important;
  }

  .item-card__image {
    .item-card__image__like {
      display: flex;
      opacity: 0;
      visibility: hidden;
      justify-content: flex-end;
      margin-bottom: -24px;
    }


    img {
      height: 100%;
      width: 100%;
      object-fit: fill;
    }


    .item-card__image__sale-amount {
      margin-top: -25px;
      margin-bottom: 5px;
      margin-left: 10px;
      font-size: 15px;
      padding: 2.5px 9.5px;
      border-radius: 20px;
      background-color: var(--red);
      color: white;
      width: max-content;
    }

    //.item-card__image__sale-amount span:hover{
    //  color: white !important;
    //}
  }

  .item-card__rating__star {
    color: #fc9700;
  }

  .item-card__prices {
    line-height: 1.7rem;

    .item-card__prices__ex-price {
      min-height: 1.19rem;
      font-size: 1rem;
      line-height: 1.19rem;
      text-decoration: line-through;
      color: var(--red);
      margin: 0;
    }

    .item-card__prices__new-price {
      font-size: 1.286rem;
      line-height: 1.571rem;
    }
  }

  &:hover {
    box-shadow: 0 8px 14px rgba(0, 0, 0, 0.15);
    color: black;

    .item-card__image__like {
      opacity: 1;
      visibility: visible;
    }
  }

  @media (max-width: 768px) {
    .item-card__image__like {
      opacity: 1 !important;
      visibility: visible !important;
    }
    height: 22.857rem;
    padding: 0;
    width: 10.143rem;
    .image-sizing {
      height: 10.143rem;
    }
    .item-card__rating {
      span {
        font-size: 0.714rem;
        line-height: 0.864rem;
      }
    }
    .item-card__image {
      .item-card__image__sale-amount {
        padding: 1px 12px;
        margin-left: 4px;

        span {
          font-size: 0.714rem;
          line-height: 0.857rem;
        }
      }
    }

    .item-card__prices {
      .item-card__prices__ex-price {
        min-height: 1rem;
        font-size: 0.786rem;
        line-height: 1rem;
      }

      .item-card__prices__new-price {
        font-size: 1.071rem;
        line-height: 1.286rem;
      }
    }
    .item-card__description {
      font-size: 0.929rem;
      line-height: 1.143rem;
    }


    &:hover {
      box-shadow: none;
    }
  }
}
</style>
