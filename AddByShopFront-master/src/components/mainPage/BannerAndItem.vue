<template>
  <section>
    <ResponsiveLayout>
      <template #desktop>
        <BannderAndItemDesktop></BannderAndItemDesktop>
      </template>
      <template #mobile>
        <BannerAndItemMobile></BannerAndItemMobile>
      </template>
    </ResponsiveLayout>
  </section>
</template>
<script setup>
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";

import BannderAndItemDesktop from "@/components/mainPage/desktop/BannerAndItemDesktop";
import BannerAndItemMobile from "@/components/mainPage/mobile/BannerAndItemMobile";</script>