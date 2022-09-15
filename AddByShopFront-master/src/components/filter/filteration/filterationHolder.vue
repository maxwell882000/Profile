<template>
  <div>
    <filter-chosen></filter-chosen>
    <filter-category></filter-category>
    <filter-price></filter-price>
    <filter-toggle prefix="exists" :name="$t('В наличии')"></filter-toggle>
    <filter-toggle prefix="rate_high" :name="$t('Высокий рейтинг')"></filter-toggle>
    <filter-toggle prefix="discount_exists" :name="$t('Со скидкой продавца')"></filter-toggle>
    <filter-manufacture></filter-manufacture>
    <filter-color></filter-color>
    <filter-shop></filter-shop>
  </div>
</template>
<script setup>
import FilterToggle from "@/components/filter/filteration/filterToggle";
import FilterCategory from "@/components/filter/filteration/fliterCategory/filterCategory";
import FilterChosen from "@/components/filter/filteration/filterChosen";
import FilterManufacture from "@/components/filter/filteration/filterSelect/filterBrand";
import FilterColor from "@/components/filter/filteration/filterSelect/filterColor";
import FilterShop from "@/components/filter/filteration/filterSelect/filterShop";
import FilterPrice from "@/components/filter/filteration/filterPrice";</script>