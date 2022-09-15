<template>
  <button class="button-card-list" :class="this.isBasket ? 'active' : 'inactive'" @click.prevent="clicked">
    <span>{{ $t("В корзину") }}</span>
  </button>
</template>

<script>
import cardClick from "@/components/buttons/cart/methods/cardClick";

export default cardClick;
</script>

<style scoped>
.button-card-list {
  all: unset;
  border-radius: var(--borderRadius8);
  line-height: 1.357rem;
  font-size: 1.143rem;
  cursor: pointer;
  text-align: center;
  width: 11rem;
  height: 3.214rem;
  /*padding: 1rem 1.357rem;*/
}

.active, .inactive:hover {
  color: white;
  background-color: var(--blue);
}

.active:hover, .inactive {
  background-color: var(--gray100);
  color: var(--dark);
}
</style>