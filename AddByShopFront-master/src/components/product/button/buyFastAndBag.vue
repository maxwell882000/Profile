<template>
  <div class="d-flex mb-2">
    <buy-fast-button></buy-fast-button>
    <bag-button></bag-button>
  </div>
</template>
<style scoped>
.buy-now {
  margin-right: 10px;
}

.add2cart {
  padding-left: 0;
}

</style>
<script>
import BuyFastButton from "@/components/product/button/buyFastButton";
import BagButton from "@/components/product/button/bagButton";

export default {
  components: {BagButton, BuyFastButton}
}
</script>