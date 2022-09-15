<template>
  <div class="p-mobile pop-category">
    <name-and-route-all :title="$t('Популярные категории')"></name-and-route-all>
    <category-roll key-arg="pop_category_" :categories="categories" v-slot="{item}">
      <router-link :to="'/category/child/' + item.slug"
                   class="remove-link">
        <category-item-roll :item="item"></category-item-roll>
      </router-link>
    </category-roll>
    <!--    <Splide :options="{pagination:true, perPage:5, arrows:false, gap:20}">-->
    <!--      <SplideSlide :key="'pop_category_' + item.id" v-for="item in categories">-->
    <!--        <router-link :to="'/category/parent/' + item.slug"-->
    <!--                     class="remove-link d-flex flex-column-->
    <!--                       justify-content-center align-items-center ">-->
    <!--          <div style="height: 3rem; width: 3rem">-->
    <!--            <img class="img-res" :src="item.icon" alt="caetgory">-->
    <!--          </div>-->
    <!--          <span class="text-sm text-center two-only-sentence">-->
    <!--            {{ item.name }}-->
    <!--          </span>-->
    <!--        </router-link>-->
    <!--      </SplideSlide>-->
    <!--    </Splide>-->
  </div>

</template>

<script>
export default {
  name: "PopularCategories"
}
</script>
<script setup>
import {useStore} from "vuex";
import {computed} from "vue";
import NameAndRouteAll from "@/components/mainPage/mobile/nameAndRouteAll";
import CategoryRoll from "@/components/category/category-roll";
import CategoryItemRoll from "@/components/category/category-item-roll";

const store = useStore();
const categories = computed(() => store.getters['mainModule/popular_category'])
</script>

<style scoped>

.cat-mob {
  margin-top: 2.5rem;
}
</style>
<style>
.pop-category .splide__pagination {
  bottom: initial !important;
}
</style>