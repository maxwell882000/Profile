<template>
  <ResponsiveLayout>
    <template #desktop>
      <ItemDesktop></ItemDesktop>
    </template>
    <template #mobile>
      <ItemMobile></ItemMobile>
    </template>
  </ResponsiveLayout>
</template>
<script setup>
import ItemDesktop from "@/components/product/responsive/desktop/ItemDesktop";
import ItemMobile from "@/components/product/responsive/mobile/ItemMobile";</script>
<style lang="scss">
.product-content {
  background-color: white;
  padding: 24px;
  border-radius: 12px;
  display: flex;

  @media (max-width: 767px) {
    flex-wrap: wrap;
  }

  .pictures {
    width: 50%;
    min-width: 50%;
  }

  .color-select {
    display: flex;
    flex-wrap: wrap;
  }

  .color-btn, .param-option {
    background-color: transparent;
    border: 1px solid #f2f2f2;
    border-radius: 8px;
    display: flex;
    flex-direction: column;
    align-self: center;
    margin: 4px;
    color: var(--dark) !important;

    img {
      height: 62px;
      width: 62px;
      left: 9px;
      top: 5px;
      border-radius: 8px;
      object-fit: contain;
    }

    small {
      display: block;
      width: 100%;
      text-align: center;
    }

    &.active {
      border-color: transparent;
      box-shadow: 0 0 0 2px #007aff;
    }
  }

  .param-option {
    padding: 5.5px 15px;
  }
}

</style>

<script>
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";

export default {
  components: {ResponsiveLayout}
}
</script>