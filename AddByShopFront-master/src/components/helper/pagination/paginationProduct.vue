<template>
  <div class="mt-3 custom-pagination">
    <b-pagination @page-click="goToOtherPage"
                  v-model="currentPage"
                  pills
                  :total-rows="products.total || 0"
                  :per-page="products.per_page || 1"
                  :prev-text="$t('Назад')"
                  :next-text="$t('Вперед')"
                  last-number
                  first-number
    ></b-pagination>
  </div>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
  data() {
    return {
      currentPage: 0,
    }
  },
  watch: {
    currentPage() {

    }
  },
  computed: {
    ...mapGetters({
      products: "productFilterByModule/products"
    })
  },
  methods: {
    goToOtherPage(clickEvent, pageNumber) {
      this.getProducts(pageNumber);
    },
    ...mapActions({
      getProducts: "productFilterByModule/getProducts"
    })
  },
  mounted() {
    this.currentPage = this.products.current_page;
  }
}
</script>
<style>
.custom-pagination .b-pagination-pills .page-item .page-link {
  border: none;
  border-radius: 0.4em !important;
}

.page-link, .page-item.disabled .page-link {
  background-color: transparent;
  color: var(--gray);
}

</style>