<template>
  <ResponsiveLayout>
    <template #desktop>
      <div class="bg-white rounded-st w-100 d-flex justify-content-between"
           style="padding: 1.357rem 2.429rem; margin-bottom: 0.75rem">
        <filter-apply-sort></filter-apply-sort>
        <filter-change-view></filter-change-view>
      </div>
    </template>
  </ResponsiveLayout>

</template>

<script setup>
import FilterApplySort from "@/components/filter/component/sorting/filterApplySort";
import FilterChangeView from "@/components/filter/component/sorting/filterChangeView";
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";</script>

<style scoped>

</style>