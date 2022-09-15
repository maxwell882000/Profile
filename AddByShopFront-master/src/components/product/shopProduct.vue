<template>
  <h6 class="mt-4  pb-3 text-500">{{ $t("Продавец") }}</h6>
  <router-link
      :to="'/shop/' + shop.slug"
      class="seller d-flex align-items-center shop-link justify-content-between">
    <div
        class="d-flex align-items-center "
    >
      <div class="logo">
        <img class="img-res" :src="shop.logo" alt="seller icon"/>
      </div>

      <div class="mx-2">
        <p class="mb-0 text-dark  text-normal text-500">{{ shop.name }}</p>
        <!--        <p class="mb-0">-->
        <!--          <b-icon icon="star-fill" class="star"/>-->
        <!--          <span class="text-muted mx-2">4.6 86 отзывов</span>-->
        <!--        </p>-->
      </div>
    </div>
    <span class="bi bi-chevron-right"></span>
  </router-link>
</template>
<script>
import {mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters({
      shop: 'productModule/shop'
    })
  }
}
</script>
<style scoped>
@media (max-width: 768px) {
  h6 {
    margin: 0 !important;
  }

  .seller {
    width: 100%;
  }
}

.logo {
  height: 2.857rem;
  width: 2.857rem;
}
</style>