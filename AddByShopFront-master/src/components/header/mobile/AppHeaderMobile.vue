<template>
  <header class="relative">
    <div class="bg-white py-1 p-mobile mobile-header w-100" style="z-index: 100; position: relative">
      <section class="d-flex align-items-center justify-content-center py-2">
        <router-link to="/">
          <by-shop></by-shop>
        </router-link>
      </section>
      <section>
        <div class="border-xm bg-gray w-100 search-cont d-flex">
          <div class="search-header">
            <search-icon></search-icon>
          </div>
          <input
              v-model="search"
              v-on:keyup.enter="() => search && $router.push('/search/' + search)"
              autocomplete="false"
              @focus="onFocus = true"
              @focusout="leaveFocus"
              type="text"
              :placeholder="$t('Искать товары')"/>
        </div>
      </section>
      <div class="relative">
        <search-results style="z-index: 1" v-show="onFocus && search && isVisible"></search-results>
      </div>
    </div>
  </header>
</template>

<script setup>
import ByShop from "@/components/icons/by-shop";
// eslint-disable-next-line no-unused-vars
import SearchIcon from "@/components/icons/search";
import useSearch from "@/components/header/search/setup/useSearch";
import SearchResults from "@/components/header/search/component/searchResults";
import useSearchResults from "@/components/header/search/setup/useSearchResults";
import {computed, watch} from "vue";
import {useStore} from "vuex";
import {useRoute} from "vue-router";


const {search, leaveFocus, onFocus} = useSearch();
// eslint-disable-next-line no-unused-vars
const {isVisible} = useSearchResults();
const store = useStore();
const user = computed(() => store.getters['user']);
const bascketCounter = computed(() => store.getters['prepareBasketModule/count']);
const route = useRoute();
watch(bascketCounter, (newVal) => {
  if (route.name === "basket") {
    user.value.basket_counter = newVal;
  }
})
</script>

<style scoped>
.search-cont {
  padding: 0.6rem;
}

/*.mobile-header a {*/
/*  all: unset;*/
/*}*/

.search-header svg {
  width: 1.429rem;
  height: 1.429rem;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
  margin-bottom: 0.11rem;
  /*fill: var(--dark);*/
}

input {
  all: unset;
}

input::placeholder {
  color: var(--dark-gray);
}
</style>
<style>
.mobile-header {
  box-shadow: 0 -1px 4px rgba(0, 0, 0, 0.05) !important;

}

.mobile-header .search-helper {
  margin-top: 0.8rem;
}

.search-header path {
  stroke: var(--dark) !important;
}
</style>