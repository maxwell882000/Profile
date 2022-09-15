<template>
  <router-link :to="'/products/discount/' + item.id">
    <div class="image-stock">
      <b-img class="img-res rounded-st" :src="item.image" alt=""/>
    </div>
  </router-link>
</template>

<script>
export default {
  props: ['item']
}
</script>
<style scoped>

.image-stock {
  height: 15rem;
  /*width: 32%;*/
}

@media (max-width: 768px) {
  .image-stock {
    width: 100%;
    /*width: 32%;*/
  }
}
</style>