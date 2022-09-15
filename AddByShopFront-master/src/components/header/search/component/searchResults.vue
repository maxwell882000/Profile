<template>
  <div class="absolute shadow rounded-st bg-white search-helper">
    <router-link :to="'/search/' + item.search"
                 :key="'search_key_results' + item.id" v-for="item in searchHelpers"
                 class="d-flex remove-link justify-content-between  align-items-center">
      <div class="d-flex  align-items-center">
        <div class="mr-2">
          <span class="bi bi-search text-secondary"></span>
        </div>
        <span>{{ item.search }}</span>
      </div>
      <div>
        <span class="bi bi-chevron-right"></span>
      </div>
    </router-link>
  </div>
</template>
<script setup>
import useSearchResults from "@/components/header/search/setup/useSearchResults";

const {searchHelpers} = useSearchResults();
</script>
<style>


.search-helper {
  margin-top: 3rem;
  padding: 0.3rem;
  width: 100%;
}

.search-helper .d-flex {
  cursor: pointer;
  border-radius: 4px;
  padding: 0.23rem 0.2rem;

}

.search-helper .d-flex:hover {
  background-color: var(--gray100);
  color: var(--dark);
}
</style>