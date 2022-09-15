<template>
  <header>
    <ResponsiveLayout>
      <template #mobile>
        <AppHeaderMobile></AppHeaderMobile>
      </template>
      <template #desktop>
        <AppHeaderDesktop></AppHeaderDesktop>
      </template>
    </ResponsiveLayout>
    <auth-modals></auth-modals>
  </header>

</template>
<script setup>
// eslint-disable-next-line no-unused-vars
import AppHeaderDesktop from "@/components/header/desktop/AppHeaderDesktop";
import AppHeaderMobile from "@/components/header/mobile/AppHeaderMobile";
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";
import AuthModals from "@/components/auth/authModals";</script>