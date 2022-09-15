<template>
  <router-link :to="`/item/${product.id}`" class="item-list">
    <div class="images">
      <img :src="product.image" class="img-res" alt="image-items">
    </div>
    <div style="flex: 1">
      <div class="d-flex justify-content-between">
        <div>
          <h6 class="bottom-padding item-title two-only-sentence">{{ product.title }}</h6>
          <div class="bottom-padding item-card__rating">
        <span
            class="item-card__rating__star bootstrap-icon bootstrap-icon--size-sm bi bi-star-fill">
        </span>
            <span class="mx-1 rating">{{ product.mark }}</span>
            <span class="mx-2 rating">{{ product.num_comment }} {{ $t("отзывов") }}</span>
          </div>
          <div class="item-card__prices">
            <span>
            <span style="text-decoration: none">
               <span class="item-card__prices__ex-price"
                     v-show="isChangedPrice">{{ product.price }} {{ $t("сум") }}
               </span>
              <span v-show="product.discount" class="item-card__image__sale-amount">
                 -{{ product.discount }}%
              </span>
           </span>
            </span>
            <h6 class="item-card__prices__new-price">
              {{ product.real_price }} {{ $t("сум") }}
            </h6>
          </div>
        </div>
        <div>
          <div class="bg-gray show-like border-8 " style="padding-bottom: 4px">
            <Like :id="product.id" :favourite="product.favourite"></Like>
          </div>
        </div>
      </div>

      <installment-list-price :image="product.image"
                              :basket="product.basket"
                              :id="product.id"
                              :credit="product.credit"></installment-list-price>
    </div>

  </router-link>
</template>

<script setup>

// const store = useStore();
import InstallmentListPrice from "@/components/shared/item/installmentListPrice";
import Like from "@/components/buttons/Like";

// eslint-disable-next-line no-undef
const props = defineProps({
  product: Object
});

function isChangedPrice() {
  return props.product.real_price !== props.product.price;
}
</script>
<style>
.show-like .like-btn path {
  stroke: var(--dark);
}
</style>
<style lang="scss" scoped>
.bottom-padding {
  padding-bottom: 0.714rem;
}

.item-list {
  all: unset;
  display: flex;

  background-color: white;
  padding: 0.857rem 1.714rem 0.857rem 0.857rem;
  border-radius: var(--borderRadius);
  height: 15.786rem;
  cursor: pointer;
  align-items: center;

  .images {
    height: 14.071rem;
    width: 14.071rem;
    margin-right: 3.786rem;
  }

  .item-card__rating__star {
    color: #fc9700;
  }

  .rating {
    font-size: 0.929rem;
    color: var(--dark);
    line-height: 1.143rem;
  }

  .item-card__prices {
    padding-bottom: 1.938rem;
    letter-spacing: -0.03em;

    .item-card__image__sale-amount {
      border-radius: var(--borderRadius17);
      padding: 2px 10px;
      margin-left: 0.429rem;
      background-color: var(--red);
      font-size: 0.857rem;
      line-height: 1.071rem;
      color: white;
    }

    .item-card__prices__ex-price {
      text-decoration: line-through;
      color: var(--dark-gray);
      font-size: 0.929rem;
      line-height: 1.143rem;
      margin-bottom: 0 !important;
    }

    .item-card__prices__new-price {
      color: var(--dark);
      font-size: 1.286rem;
      margin: 0 !important;
      line-height: 1.571rem;
    }
  }

  .item-title {
    font-size: 1.143rem;
    font-weight: 500;
    line-height: 1.357rem;
    letter-spacing: -0.01em;
  }

  .show-like {
    visibility: hidden;
    opacity: 0;
  }

  &:hover {
    filter: drop-shadow(3px 7px 10px rgba(0, 0, 0, 0.1));

    .show-like {
      visibility: visible;
      opacity: 1;
    }
  }


}
</style>