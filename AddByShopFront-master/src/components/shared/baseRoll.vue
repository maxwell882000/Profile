<template>
  <Splide @splide:moved="moved" class="splide orders-roll" :has-slider-wrapper="true" :options="splideOptions">
    <template #before-slider>
      <pagination-arrows></pagination-arrows>
    </template>
    <slot></slot>
<!--    <div></div>-->
  </Splide>
</template>
<script>
import PaginationArrows from "@/components/helper/pagination/paginationArrows";

export default {
  components: {PaginationArrows},
  props: {
    gap: {},
    autoWidth: {
      type: Boolean,
      default() {
        return false;
      },
    },
    breakpoints: {
      type: Object
    },
    perPage: {
      type: Number,
      default() {
        return 5;
      }
    }
  },
  methods: {
    // eslint-disable-next-line no-unused-vars
    moved(event) {
      // const em = document.querySelector('.p-mobile');
      // console.log(getComputedStyle(em).paddingLeft);
      // console.log(event.index)
      // console.log(event.root);
      // console.log()
    }
  },
  data() {
    return {
      splideOptions: {
        // type: "noloop",
        // perPage: this.perPage,
        // perMove: 3,
        padding: "1.2rem",
        pagination: false,
        gap: this.gap || '10px',
        // autoWidth: this.autoWidth,
        breakpoints: this.breakpoints != null ? this.breakpoints : {
          1400: {
            // perPage: this.perPage,
            // perMove: 2,
            gap: '10px',
          },
          1200: {
            // perPage: this.perPage - 1 || 3,
            // perMove: 2,
            gap: '10px',

            // padding: "2rem",
          },
          768: {
            // perPage: this.perPage - 2 || 2,
            // perMove: 1,
            // gap: '10px',
            // padding: "0.5rem",
            // padding: "0.5rem",
            arrows: false,

          },
          577: {
            // perPage: this.perPage - 3 || 1,
            // perMove: 1,
            // gap: '10px',
            // padding: "0.5rem",
            arrows: false,

          },
          500: {
            // perPage: this.perPage - 4 || 1,
            // perMove: 1,
            // gap: '10px',
            // padding: "0.5rem",
            arrows: false,


          },
          375: {
            // perPage: 2,
            // perMove: 1,
            // gap: '10px',
            // padding: "0.5rem",
            arrows: false,

          }
        },
      },
    };
  },
};
</script>

<style scoped>
/*.splide {*/
/*  margin-left: -2rem;*/
/*}*/

.splide__slide {
  padding-bottom: 18px;
}

/*@media (max-width: 1400px) {*/
/*  .splide {*/
/*    margin-left: -1rem;*/
/*  }*/
/*}*/

/*@media (max-width: 992px) {*/
/*  .splide {*/
/*    margin-left: -0.5rem;*/
/*  }*/
/*}*/

/*@media (max-width: 768px) {*/
/*  .splide__slide {*/
/*    width: 240px !important;*/
/*  }*/
/*}*/
</style>
<style>
.orders-roll .splide__arrow--prev {
  left: -2em;
}

.orders-roll .splide__arrow--next {
  right: -2em;
}

.orders-roll .splide__arrow {
  background: transparent;
  opacity: 1;
  height: 3.5rem;
  width: 3.5rem;
}

.orders-roll .splide__arrow svg {
  fill: transparent;
  height: 3rem;
  width: 3rem;
}

@media (max-width: 768px) {
  .orders-roll {
    margin-right: -0.8rem;
  }
}
</style>