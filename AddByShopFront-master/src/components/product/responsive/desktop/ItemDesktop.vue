<template>
  <section class="container">
    <Badge class="badges" :path="path"></Badge>
    <h4 class="my-3">{{ name }}</h4>
    <header-product></header-product>
  </section>
  <section class="container">
    <b-row class="row cols">
      <b-col cols="12" class="col-xl-9 col-lg-8 col-md-12 col-sm-12 ">
        <div class="product-content">
          <pictures-part class="flex-fill flex-sm-fill  pictures"></pictures-part>
          <div style="width: 1rem;">
          </div>
          <div class="w-100">
            <color-component button="color-btn"></color-component>
            <SelectComponent v-for="(component, index) in selectComponent"
                             :key="'select_com_ ' + index" :param="component" :index="component.id">
            </SelectComponent>
            <shop-product>
            </shop-product>
          </div>
        </div>
        <about-product></about-product>
      </b-col>
      <b-col cols="12" class="col-xl-3 col-lg-4 col-md-12 col-sm-12  mb-4 p-0">
        <installment-product></installment-product>
        <!--          <delivery-product></delivery-product>-->
      </b-col>
    </b-row>
  </section>
  <comments/>

</template>
<script setup>
import SelectComponent from "@/components/product/selectComponent";
import HeaderProduct from "@/components/product/headerProduct";
import ColorComponent from "@/components/product/colorComponent";
import ShopProduct from "@/components/product/shopProduct";
import AboutProduct from "@/components/product/aboutProduct";
import InstallmentProduct from "@/components/product/installment/installmentProduct";
import Comments from "@/components/product/comment/comments";
import Badge from "@/components/shared/Badge";
import PicturesPart from "@/components/product/PicturesPart";
import useItemProduct from "@/components/product/responsive/setup/useItemProduct";

const {selectComponent, path, name} = useItemProduct();
</script>
<style scoped lang="scss">
h4 {
  font-weight: 300;
  letter-spacing: -0.02em;
}
</style>