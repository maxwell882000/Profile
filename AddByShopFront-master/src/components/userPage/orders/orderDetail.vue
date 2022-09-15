<template>
  <p v-b-toggle="'data_about_product_' + idToggle " class="bold pointer">
    {{ $t("Данные доставки") }}
    <arrow-move class="mx-3" show-class="up" close-class="down"></arrow-move>
  </p>
  <b-collapse :id="'data_about_product_' + idToggle">
    <b-row>
      <data-about-product
          v-show="dateCreation"
          :header="$t('Дата оформления')"
          :data="dateCreation">
        <clock></clock>
      </data-about-product>
      <data-about-product
          v-show="address"
          :header="$t('Адрес доставки')"
          :data="address">
        <Location></Location>
      </data-about-product>
      <data-about-product
          v-show="dateDelivery"
          :header="$t('Дата доставки')"
          :data="dateDelivery">
        <truck></truck>
      </data-about-product>
      <data-about-product
          v-show="wayOfPayment"
          :header="$t('Способ оплаты')"
          :data="wayOfPayment">
        <card></card>
      </data-about-product>
      <!--      <data-about-product :header="'Покупатель'" :data="'Data about this staff'">-->
      <!--        <profile></profile>-->
      <!--      </data-about-product>-->
      <data-about-product
          v-show="instructions"
          :header="$t('Комментарий')"
          :data="instructions">
        <comment-icon></comment-icon>
      </data-about-product>
    </b-row>
  </b-collapse>
</template>
<script setup>
import DataAboutProduct from "@/components/userPage/orders/dataAboutProduct";
import Clock from "@/components/icons/clock";
import Location from "@/components/icons/location";
import Truck from "@/components/icons/truck";
import Card from "@/components/icons/card";
// import Profile from "@/components/icons/profile";
import CommentIcon from "@/components/icons/commentIcon";
import ArrowMove from "@/components/icons/arrowMove";

// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps({
  idToggle: String,
  dateCreation: String,
  address: String,
  dateDelivery: String,
  wayOfPayment: String,
  instructions: String,
});
</script>
<style>
p {
  padding: 0;
  margin: 0;
}
</style>