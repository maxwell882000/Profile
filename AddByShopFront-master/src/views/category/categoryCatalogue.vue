<template>
  <section>
    <div class="bg-white py-4 p-mobile catalogue">
      <Splide :options="{arrows:false, pagination:false}" class="catalogue-roll"
              key-arg="category_catalogue_"
              :categories="categories">
        <SplideSlide :key="'category_catalogue_' + item.id" v-for="item in categories">
          <button @click="setCategory(item)">
            <category-item-roll :item="item"
                                :class="selectedCategory.slug === item.slug && 'active-catalogue-category'">
            </category-item-roll>
          </button>
        </SplideSlide>
      </Splide>
    </div>
    <div class="bg-white p-mobile my-2 py-3"
         :key="'category_catalogue'+ item.slug"
         v-for="item in selectedCategory.children"
    >
      <button class="button-category" v-b-toggle="'collapse_catalogue' + item.slug">
        <span>{{ item.name }}</span>
        <div>
          <span class="bi bi-chevron-down"></span>
        </div>
      </button>
      <b-collapse :id="'collapse_catalogue' + item.slug">
        <router-link :to="'/category/child/' + lastCat.slug" class="mini_categories"
                     :key="'last_Category_catalogue'+ lastCat.slug"
                     v-for="lastCat in item.children">
          <span>{{ lastCat.name }}</span>
          <div>
            <span class="bi bi-chevron-right"></span>
          </div>
        </router-link>
      </b-collapse>
    </div>
  </section>
</template>

<script setup>
// import CategoryItemRoll from "@/components/category/category-item-roll";
import {useStore} from "vuex";
import {computed, ref, watch} from "vue";
import CategoryItemRoll from "@/components/category/category-item-roll";

const store = useStore();
const categories = computed(() => store.getters['drop_bar']);
const selectedCategory = ref(categories.value[0] || {children: [], slug: ""});
const changed = watch(categories, function (val) {
  selectedCategory.value = val[0];
  changed();
})

function setCategory(item) {
  selectedCategory.value = item;
}
</script>
<style lang="scss" scoped>

button {
  all: unset;
}

.button-category {
  all: unset;
  width: 100%;
  font-size: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;

}

.mini_categories {
  all: unset;
  font-weight: 400;
  font-size: 1rem;
  border: none;
  padding: 0.8rem 0rem 0.8rem 1rem;
  color: var(--gray300);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.mini_categories:first-child {
  padding-top: 1.6rem;
}
</style>
<style lang="scss">

.catalogue .splide__slide {
  width: max-content !important;
}

.catalogue .name-category-pop span {
  font-size: 0.714rem !important;
  line-height: 0.929rem !important;
}

.active-catalogue-category {
  background-color: var(--gray700) !important;
}

.catalogue .category-item-roll {
  height: 6rem;
  width: 6rem;
  border-radius: var(--borderRadius10);

  &:hover {
    background-color: var(--gray700);
  }
}
</style>