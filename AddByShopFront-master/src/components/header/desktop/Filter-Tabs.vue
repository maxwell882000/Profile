<template>
  <div class="filter-tabs">
    <b-tabs
        pills
        vertical
        nav-wrapper-class="bg-white left-tabs scoped-sidebar "
        class="nav-tabs"
        content-class="w-100"
        active-nav-item-class="bg-light text-violet"
        active-tab-class="text-uppercase text-dark">
      <b-tab v-for="item in drop_bar" :key="item.slug + '_tabs_in_category'">
        <template #title>
          <div class="d-flex justify-content-between align-items-center w-100">
            <div>
              <span>{{ item.name }}</span>
            </div>
            <div>
              <span class="bi bi-chevron-right" style="width: 100%;"/>
            </div>
          </div>
        </template>
        <category :item="item">
          <router-link :to="'/category/parent/' + item.slug" class="remove-link">
            <h5 class="header">{{ item.name }}</h5>
          </router-link>
        </category>
      </b-tab>
    </b-tabs>
  </div>

</template>

<script>
import {mapGetters,} from "vuex";
import Category from "@/components/header/desktop/category";

export default {
  components: {Category},
  computed: {
    ...mapGetters(['drop_bar'])
  },
};
</script>

<style lang="scss">

.filter-tabs .header {
  font-size: large;
  font-weight: 600;
  text-transform: initial;
}

.filter-tabs .scoped-sidebar {
  width: 30%;
}

.filter-tabs .scoped-sidebar span:hover {
  color: var(--violet);
}

.filter-tabs .nav-tabs {
  height: 100%;
}


</style>