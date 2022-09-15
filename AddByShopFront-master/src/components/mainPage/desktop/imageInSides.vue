<template>
  <router-link :to="'/products/lenta/' + id" v-if="side && image !== ''">
    <div
        style="width: 30.571rem !important;height: 29.429rem;" :class="is_left ? 'is_left_image' : 'is_right_image'">
      <img :src="image" class="img-res rounded-st">
    </div>
  </router-link>
</template>

<script setup>
// eslint-disable-next-line no-undef
defineProps({
  side: Boolean,
  is_left: Boolean,
  image: String,
  id: Number,
})
</script>

<style scoped>
.is_left_image {
  margin-right: 10px;
}

.is_right_image {
  margin-left: 10px;
}
</style>