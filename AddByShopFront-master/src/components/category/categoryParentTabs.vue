<template>
  <category-base-tabs :name="category.name" :link="`/category/sub/${category.slug}`">
    <div>
      <b-tabs nav-class="overflow flex-nowrap"
              nav-wrapper-class=" custom-tabs w-100 category-tabs"
              pills>
        <b-tab @click="setCategory(item.slug)" v-for="item in category.children" :key="'category_of_sub' + item.slug"
               :title="item.name" :active="chosenCategory === item.slug">
        </b-tab>
      </b-tabs>
      <div class="mt-3">
        <loader :div-style="{height: '10vh'}" :waiting="'category_product' + chosenCategory">
          <SalesRoll :breakpoints="breakpoints" :per-page="4" :products="currentProducts"></SalesRoll>
        </loader>
      </div>
    </div>
  </category-base-tabs>
</template>
<style>

h5 {
  padding: 0;
  margin: 0;
}
</style>
<script>
import SalesRoll from "@/components/shared/SalesRoll";
import {mapActions, mapGetters} from "vuex";
import Loader from "@/components/loading/loader";
import CategoryBaseTabs from "@/components/category/categoryBaseTabs";

export default {
  components: {CategoryBaseTabs, Loader, SalesRoll},
  props: {
    category: {
      type: Object,
      default() {
        return {
          "id": 4,
          "name": "Смартфоны и гаджеты",
          "slug": "sub",
          "children": [
            {
              "id": 5,
              "name": "This",
              "slug": "this"
            }
          ],
        }
      }
    }
  },
  data() {
    return {
      breakpoints: {
        1400: {
          perPage: 3,
          perMove: 2,
          padding: "1rem",
        },
        1200: {
          perPage: 2,
          perMove: 2,
          padding: "2rem",
        },
        768: {
          perPage: 2,
          perMove: 1,
          padding: "0.5rem",
        },
        500: {
          perPage: 1,
          perMove: 1,
          gap: '10px',
          padding: "0.5rem",
        },
        375: {
          perPage: 2,
          perMove: 1,
          gap: '10px',
          padding: "0.5rem",
          arrows: false
        }
      },
      chosenCategory: this.category.children && this.category.children.length !== 0 && this.category.children[0].slug || ""
    }
  },
  computed: {
    currentProducts() {
      return this.product[this.chosenCategory] || [];
    },
    ...mapGetters({
      product: 'categoryModule/productInCategory',
    })
  },
  methods: {
    ...mapActions({
      getProductInCategory: "categoryModule/getProductCategory"
    }),
    setCategory(slug) {
      this.chosenCategory = slug;
      if (!(slug in this.product)) {
        this.getProductInCategory(slug);
      }
    }
  }
}
</script>
<style lang="scss">
.category-tabs {
  .nav-item {
    white-space: nowrap;
  }
}
</style>
<style >
/*.custom-tabs .overflow::-webkit-scrollbar {*/
/*  display: none!important;*/
/*}*/
/*.custom-tabs .overflow{*/
/*  -ms-overflow-style: none; !* for Internet Explorer, Edge *!*/
/*  scrollbar-width: none; !* for Firefox *!*/
/*  overflow-y: scroll;*/
/*}*/

</style>