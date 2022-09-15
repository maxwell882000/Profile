<template>
  <div
      v-bind:style="{ 'background-image': 'url(' + shop.image + ')' }"
      class="thumbnail row align-items-end">
    <div class="col col-12 col-md-8 col-lg-5 col-sm-12">
      <div class="seller-cart">
        <div style="height: 5.286rem; width: 5.286rem; padding: 0.571rem ;" class="rounded-st shadow-md">
          <img :src="shop.logo" class="img-res" alt=""/>
        </div>
        <h6 class="mt-3 mb-1 name-shop">{{ shop.name }}</h6>
        <div class="d-flex align-items-center justify-content-between">
          <div>
            <p class="mb-1">
              <small class="text-muted">
                <span class="bi bi-geo-alt-fill me-1"/>
                <span>{{ shop.address }}</span>
              </small>
            </p>
            <p class="mb-0">
              <!--                <stars rating="3"></stars>-->
              <!--                <span class="text-muted">{{ itemInfo.rating }} / 5</span>-->
            </p>
          </div>
          <!--            <button class="btn btn-light">-->
          <!--              <b-icon icon="share"/>-->
          <!--            </button>-->
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
// eslint-disable-next-line no-undef
defineProps({
  shop: Object
})
</script>

<style scoped>
.name-shop {
  font-size: 1.286rem;
  line-height: 1.556rem;
}
</style>