<template>
  <div class="d-flex flex-column category-item-roll
                             justify-content-center align-items-center">
    <div class="size-category-pop">
      <img class="img-res" :src="item.icon" alt="category">
    </div>
    <div class="name-category-pop">
       <span class="text-sm text-center two-only-sentence p-1">
            {{ item.name }}
          </span>
    </div>

  </div>

</template>

<script setup>
// eslint-disable-next-line no-undef
defineProps({
  item: Object
})
</script>

<style scoped>
.name-category-pop {
  height: 3rem;
  overflow: hidden;
  padding-top: 0.5rem;
}

.size-category-pop {
  height: 2.643rem;
  width: 2.643rem;
}
</style>