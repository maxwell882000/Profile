<template>
  <section>
    <div class="fixing-footer">
      <div class="d-flex justify-content-between footer-mobile">
        <router-link :to="'/'+item.path" :key="'footer-mobile_' + index" v-for="(item, index) in footer"
                     class="remove-link relative" :class="comparePath(item) && 'active-footer'">
          <div>
            <component :is="item.icon" style="display: block; margin: auto"></component>
          </div>
          <badge-header :class="item.path" :counter="item.counter && item.counter.value"></badge-header>
          <span>{{ item.title }}</span>
        </router-link>
      </div>
    </div>
  </section>
</template>

<script setup>
import HomeFooter from "@/components/icons/footer/home-footer";
import CategoryFooter from "@/components/icons/footer/category-footer";
import BasketFooter from "@/components/icons/footer/basket-footer";
import FavouriteFooter from "@/components/icons/footer/favourite-footer";
import ProfileFooter from "@/components/icons/footer/profile-footer";
import {useRoute} from "vue-router";
import {computed} from "vue";
import {useStore} from "vuex";
import BadgeHeader from "@/components/header/badge-header/badgeHeader";
import {useI18n} from "vue-i18n";

const store = useStore();
const user = computed(() => store.getters['user']);
const t = useI18n().t;
const footer = [
  {
    icon: HomeFooter,
    title: t("Главная"),
    path: "",
    namePath: 'Home'
  },
  {
    icon: CategoryFooter,
    title: t("Категории"),
    path: "catalogue",
    orPath: "category",
    namePath: "catalogue"
  },
  {
    icon: BasketFooter,
    title: t("Корзина"),
    path: "cart",
    namePath: "cart",
    counter: computed(() => user.value.basket_counter)
  },
  {
    icon: FavouriteFooter,
    title: t("Избранное"),
    path: "favourite",
    namePath: 'Favourites',
    counter: computed(() => user.value.favourite_counter)
  },
  {
    icon: ProfileFooter,
    title: t("Профиль"),
    path: "user",
    namePath: "User"
  },
]
const route = useRoute();

function comparePath(item) {
  console.log();
  console.log(item);
  const path = route.path.split("/")[1];
  return path === item.path || item.orPath === path;
}
</script>
<style>
.footer-mobile .active-footer path {
  fill: var(--blue);
}

.footer-mobile .active-footer span {
  color: var(--blue);
}
</style>
<style scoped>
.fixing-footer {
  /*position: fixed;*/
  bottom: 0;
  z-index: 100000000000;
  width: 100%;
}

.favourite {
  left: 26px !important;
}

.footer-mobile {
  /*margin-top: 3rem;*/
  padding: 1rem 1rem 2rem;
  font-size: 0.7rem;
  box-shadow: 0 -1px 4px rgba(0, 0, 0, 0.05);
  background-color: white;
}
</style>