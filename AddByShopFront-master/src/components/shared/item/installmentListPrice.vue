<template>
  <div class="d-flex justify-content-between">
    <installmentPrice style="width: 16.643rem!important;" :credit="credit"></installmentPrice>
    <cartListButton :basket="basket" :image="image" :id="id"></cartListButton>
  </div>
</template>

<script>
import cartListButton from "@/components/buttons/cart/cartListButton";
import installmentPrice from "./instalmentPrice";

export default {
  name: "installmentListPrice",
  props: {
    credit: {
      type: Object,
      default() {
        return {
          name: "Рассрочка",
          price: "150 000",
          month: "2"
        }
      }
    },
    basket: {
      type: Boolean,
      default() {
        return false;
      },
    },
    image: {
      type: String,
    },
    id: {
      type: Number,
      default() {
        return undefined
      }
    }
  },
  components: {cartListButton, installmentPrice}
}
</script>

<style scoped>

</style>