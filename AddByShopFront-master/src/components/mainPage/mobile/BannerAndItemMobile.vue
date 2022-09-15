<template>
  <div class="p-mobile">
    <Splide :options="{arrows:false, pagination:false, gap:5}">
      <SplideSlide class="border-sm" v-for="item in banners" :key="'banners_id' + item.id">
        <div class="banner_image" :href="item.link">
          <b-img :src="item.image" class="rounded-st img-res"
                 alt="Sample 1"/>
        </div>
      </SplideSlide>
    </Splide>
  </div>
</template>
<script>
export default {
  name: "BannerAndItemMobile"
}
</script>
<script setup>
import {useStore} from "vuex";
import {computed} from "vue";

const store = useStore();
const banners = computed(() => store.getters['mainModule/banners'])
</script>

<style lang="scss" scoped>
.banner_image {
  height: 30vh;
  @media (max-width: 768px) {
    height: 10.714rem;
  }
}


</style>
<style>
.p-mobile .splide__list {
  width: 100%;
}
</style>