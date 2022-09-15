<template>
  <div class="left-part">
    <div class="d-none d-sm-none d-md-block image_con">
      <img class="img-res rounded-st main-image" :src="activeImageUrl"/>
    </div>
    <div class="mt-4 d-flex justify-content-center">
      <Splide @splide:move="splideMove" @splide:click="splideMove"
              :options="splideOptions"
              class="splide custom-arrows w-100">
        <SplideSlide v-for="(element, index) in picturesList" :key="'splide_' + index" class="splide-slide">
          <div class="image-size border-sm border-gray p-1 " :class="index === currentIndex && 'border-active'">
            <img class="img-res p-2 img-product-picture" :src="element" alt="xiaomi">
          </div>
        </SplideSlide>
      </Splide>
    </div>
  </div>
</template>

<script>
import {Splide, SplideSlide} from '@splidejs/vue-splide';
import '@splidejs/splide/dist/css/splide.min.css';

import {mapGetters, mapMutations} from "vuex";

export default {
  components: {Splide, SplideSlide},
  name: 'PicturesPart',
  data() {
    return {
      currentIndex: 0,
      splideOptions: {
        // type: 'loop',
        perPage: 4,
        gap: '0px',
        height: 'auto',
        pagination: false,
        autoplay: false,
        arrows: false,
        perMove: 1,
        breakpoints: {
          767: {
            perPage: 1,
            pagination: true,
            padding: 0,
          },
          991: {
            perPage: 2,
          },
          1199: {
            perPage: 3,
          },
        },
      },
    }
  },
  computed: {
    ...mapGetters({
      activeImageUrl: "productModule/currentImage",
      picturesList: 'productModule/imageList'
    }),
  },
  methods: {
    ...mapMutations({
      setImage: "productModule/setCurrentImage"
    }),
    splideMove(Proxy, newIndex) {
      if (newIndex !== 0) {
        event?.stopImmediatePropagation()
        this.currentIndex = newIndex.index;
        this.setImage(this.picturesList[newIndex.index]);
      }
    }
  },
  props: []
}
</script>
<style>
.left-part .splide__slide {
  width: max-content !important;
  margin-right: 0.4rem !important;
}
</style>
<style lang="scss" scoped>
.border-gray {
  @media (max-width: 768px) {
    border: none;
  }
}

.img-product-picture {
  @media (max-width: 768px) {
    padding: 0 !important;
  }
}

.border-active {
  border: 2px solid var(--blue);
  @media (max-width: 768px) {
    border: none;
  }
}

.image-size {
  width: 6rem;
  height: 6rem;
}

.image_con {
  height: 25rem;
}

.left-part {
  width: 100%;


  .splide {
    width: calc(100% - 100px);
  }

  .splide__slide {
    display: flex;
    justify-content: center;
    align-items: center;
    @media (max-width: 767px) {
      width: 100% !important;
      .image-size {
        height: 25rem;
        width: max-content;
      }
    }

  }
}
</style>