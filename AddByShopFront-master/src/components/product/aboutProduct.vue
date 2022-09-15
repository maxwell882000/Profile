<template>
  <div class="about-item mt-4">
    <b-tabs
        class=""
        active-nav-item-class="active-tab"
        active-tab-class=""
        content-class="my-3"
    >
      <b-tab>
        <template #title>
          <h5 class="tab-content header-part"> {{ aboutProduct.header }}</h5>
        </template>
        <p class="text-dark text-400">
          {{ aboutProduct.body }}
        </p>
      </b-tab>
      <b-tab v-if="showChar">
        <template #title>
          <h5 class="tab-content">{{ firstChar.header }}</h5>
        </template>
        <table class="dotted-table about-content text-dark">
          <tr v-for="(items, index) in firstChar.values" :key="'char_'  + index">
            <th><span>{{ items.key }}</span></th>
            <th><span>{{ items.value }}</span></th>
          </tr>
        </table>
        <router-link v-show="product.characteristics.length > 1"
                     :to="`/item/${$route.params.id}/description`"
                     class="remove-link text-blue">
          {{ $t("Все характеристики") }}
        </router-link>
      </b-tab>
    </b-tabs>
  </div>
</template>
<script>
import {mapGetters} from "vuex";

export default {
  computed: {
    ...mapGetters({
      product: 'productModule/product'
    }),
    firstChar() {
      return this.product.characteristics[0];
    },
    aboutProduct() {
      return this.product.about_product;
    },
    showChar() {
      return this.product.characteristics && this.product.characteristics.length !== 0;
    },

  },
  methods: {}
}
</script>
<style lang="scss">
@media (max-width: 768px) {
  .about-item {
    .nav {
      justify-content: space-around;
    }

    .nav-tabs .nav-link.active {
      color: var(--dark) !important;
    }

    .nav-tabs .nav-link.active:after {
      content: "";
      display: block; /* This will put the pseudo element on its own line. */
      margin: 0 auto; /* This will center the border. */
      width: 50%; /* Change this to whatever width you want. */
      //padding-top: 20px; /* This creates some space between the element and the border. */
      border-bottom: 2px solid var(--blue) !important;
      border-radius: 7px;
    }
  }

}
</style>
<style scoped lang="scss">
p {
  margin: 0 !important;
}

.about-item {
  .tab-content {
    font-weight: 300;
    font-size: 24px;
    line-height: 29px;
  }

  @media (max-width: 768px) {

    .nav-tabs .tab-content {
      padding-left: 0 !important;
    }
    .tab-content {
      font-size: 1rem !important;
      line-height: 1.214rem !important;
    }

  }

  .header-part {
    padding-left: 0 !important;
  }
}

.about-content {
  @media (max-width: 767px) {
    ul.nav-tabs {
      flex-direction: row !important;
      flex-wrap: nowrap;
      overflow: scroll;
      padding-bottom: 5px;

      li.nav-item {
        width: max-content;
        white-space: nowrap;
        //min-width: 160px;
        flex: 1;

        a {
          height: 100%;
        }
      }
    }
  }
}
</style>