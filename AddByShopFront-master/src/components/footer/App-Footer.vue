<template>
  <footer>
    <ResponsiveLayout>
      <template #desktop>
        <AppFooterDesktop></AppFooterDesktop>
      </template>
      <template #mobile>
        <AppFooterMobile></AppFooterMobile>
      </template>
    </ResponsiveLayout>
  </footer>
</template>
<script setup>
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";
import AppFooterDesktop from "@/components/footer/desktop/AppFooterDesktop";
import AppFooterMobile from "@/components/footer/mobile/AppFooterMobile";</script>