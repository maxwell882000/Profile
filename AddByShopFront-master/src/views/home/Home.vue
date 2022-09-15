<template>
  <div>
    <loader waiting="main">
      <ResponsiveLayout>
        <template #desktop>
          <HomeDesktop>
          </HomeDesktop>
        </template>
        <template #mobile>
          <HomeMobile></HomeMobile>
        </template>
      </ResponsiveLayout>
    </loader>
  </div>


</template>


<script setup>
import Loader from "@/components/loading/loader";
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";
import HomeDesktop from "@/components/mainPage/desktop/HomeDesktop";
import HomeMobile from "@/components/mainPage/mobile/HomeMobile";
import {useStore} from "vuex";

const store = useStore();
const getMain = () => store.dispatch("mainModule/getMain");
const getLenta = () => store.dispatch("mainModule/getLenta");
const getCategoryInHome = () => store.dispatch("mainModule/getCategoryInHome");

async function start() {
  await getMain();
  getLenta();
  getCategoryInHome();
}

start();

</script>
