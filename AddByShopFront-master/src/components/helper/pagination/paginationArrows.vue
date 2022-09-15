<template>
  <div class="splide__arrows">
    <div class="splide__arrow splide__arrow--prev">
      <arrow-right>
      </arrow-right>
    </div>
    <div class="splide__arrow splide__arrow--next">
      <arrow-right>
      </arrow-right>
    </div>
  </div>
</template>
<script>
import ArrowRight from "@/components/icons/arrow-right";

export default {
  components: {ArrowRight}
}
</script>
<style scoped lang="scss">
.splide__arrows {
  @media (max-width: 768px) {
    display: none !important;
  }
}
</style>