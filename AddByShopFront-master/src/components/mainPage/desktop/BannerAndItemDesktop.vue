<template>
  <div class="d-flex justify-content-between w-100 m-auto banner-splide">
    <div class="col-lg-9 col-sm-12 col-12 h-max p-0">
      <Splide class="splide banner banner-only-arrows" :has-slider-wrapper="true"
              :options="{ autoplay: true, type: 'loop',gap:10 }">
        <pagination-arrows></pagination-arrows>
        <SplideSlide class="border-sm" v-for="item in banners" :key="'banners_id' + item.id"
                     data-splide-interval="3000">
          <div class="banner_image" :href="item.link">
            <b-img :src="item.image" class="rounded-st img-res"
                   alt="Sample 1"/>
          </div>
        </SplideSlide>
      </Splide>
    </div>
    <div class="col-lg-3 d-lg-block d-sm-none d-none pl-3">
      <router-link :to="`/item/${product.id}`" class="route-delete">
        <div v-if="Object.keys(product).length !== 0" class="d-flex flex-column item-of-day">
          <div class="item-of-day-title">
            <h5 class="text-500">{{ $t("Товар дня") }}</h5>
            <div class="time">{{ getTime }}</div>
          </div>
          <div class="flex-grow-1 item-of-day-content d-flex flex-column">
            <div class="icons">
              <Like style="position: absolute" :favourite="product.favourite" :id="product.id" class="like"/>
            </div>
            <!--             do not know why it is work -->
            <div class="flex-grow-1 w-max align-self-center" style="height: 10vh; width: 100%">
              <b-img fluid class="img-res" center :src="product.image" alt="mi-band"/>
            </div>
            <div class="item-of-day-info">
              <p class="item-of-day__description mb-1">
                {{ product.title }}
              </p>
              <ItemCardPrice :image="product.image" :basket="product.basket" :id="product.id" :credit="product.credit"/>
            </div>
          </div>
        </div>
      </router-link>
    </div>
  </div>
</template>

<script>

import {mapGetters} from "vuex";
import PaginationArrows from "@/components/helper/pagination/paginationArrows";
import ItemCardPrice from "@/components/shared/item/ItemCardPrice";
import Like from "@/components/buttons/Like";

export default {
  components: {ItemCardPrice, PaginationArrows, Like},

  computed: {
    ...mapGetters('mainModule', [
      'banners',
      'getTime'
    ]),
    ...mapGetters({
      product: "mainModule/first_product"
    })
  }
};
</script>

<style scoped lang="scss">
.splide {
  img {
    width: 100%;
  }
}


.item-of-day-title {
  h5 {
    font-weight: 700;
    font-size: 20px;
    line-height: 24px;
  }
}

.route-delete {
  text-decoration: none;
  color: inherit;
}

.col-lg-9 {
  @media (min-width: 992px) {
    width: 70% !important;
  }
}

.col-lg-3 {
  @media (min-width: 992px) {
    width: 30% !important;
  }
}

.item-of-day {
  text-decoration: none !important;
  transition: all 0.3s;
  //min-height: 100%;
  height: 40vh;
  background-color: white;
  border-radius: 14px;
  padding: 10px 18px;

  .item-of-day-content {
    width: 100%;
  }

  .item-of-day-title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;

    h5 {
      margin-bottom: 0;
      font-weight: 600;
    }

    .time {
      border: 1px solid #f2f2f2;
      border-radius: 5px;
      padding: 2px 10px;
      font-weight: 500;
      background: -webkit-linear-gradient(
              109.44deg,
              #325fff 14.9%,
              #d356ff 92.39%
      );
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
  }


  .icons {
    display: flex;
    flex-direction: row;
    justify-content: end;
    transition: all 0.3s;

    visibility: hidden;
    opacity: 0;
    padding-bottom: 10px;
  }

  .item-of-day__description {
    font-size: 14px;
    line-height: 20px;
  }

  &:hover {
    box-shadow: 0 8px 14px rgba(0, 0, 0, 0.15);

    .icons {
      visibility: visible;
      opacity: 1;
    }
  }
}

.banner_image {
  height: 40vh
}


</style>
<style>
.home .banner-splide .splide__list {
  width: 100% !important;

}

.banner-only-arrows .splide__arrow {
  opacity: 1;
  background: white;
  height: 2rem;
  box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
  width: 2rem;
}

@media (max-width: 768px) {
  .banner-only-arrows .splide__arrow {
    display: none !important;
  }
}

.banner-only-arrows .splide__arrow svg {
  height: 0.7rem;
  width: 0.7rem;
  fill: black !important;
}

.banner-only-arrows .splide__arrow--prev {
  left: 1em;
}

.banner-only-arrows .splide__arrow--next {
  right: 1em;
}
</style>
<style scoped lang="scss">
.splide__arrows {
  @media (max-width: 768px) {
    display: none !important;
  }
}
</style>