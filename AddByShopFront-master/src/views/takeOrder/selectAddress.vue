<template>

  <section>
    <b-row gutter-y="0px" gutter-x="0px">
      <b-col cols="12" class="bg-white information col-xl-4 col-lg-5 col-md-6  col-sm-12">
        <back-button :title="$t('Назад')"></back-button>
        <h4>{{ $t("Способ доставки") }}</h4>
        <switch-button @changed="setDelivery" class="mb-3"></switch-button>
        <delivery v-if="isDelivery"></delivery>
        <self-delivery v-else></self-delivery>
      </b-col>
      <b-col class="map col-xl-8 col-lg-7 col-md-6 	d-sm-none d-md-block">
        <open-layer v-if="isDelivery"></open-layer>
        <open-layer v-else>
          <template #markers>
            <l-marker :key="'shop_self_delivery_marker_' + item.id"
                      v-for="item in shops" :lat-lng="[item.latitude, item.longitude]">
              <l-popup :content="item.name + ' ' + item.address"/>
            </l-marker>
          </template>
        </open-layer>
      </b-col>
    </b-row>
  </section>
</template>
<script>
import BackButton from "@/components/helper/button/backButton";
import SwitchButton from "@/components/buttons/switchButton";

import OpenLayer from "@/components/map/leaflet";
import Delivery from "@/components/backet/map/delivery";
import SelfDelivery from "@/components/backet/map/selfDelivery";
import {mapActions, mapGetters, mapMutations} from "vuex";
import {LMarker, LPopup} from "@vue-leaflet/vue-leaflet";

export default {
  // eslint-disable-next-line vue/no-unused-components
  components: {SelfDelivery, Delivery, OpenLayer, SwitchButton, BackButton, LMarker, LPopup},
  data() {
    return {
      isDelivery: true
    }
  },
  computed: {
    ...mapGetters({
      shops: "deliveryInfoModule/shops"
    })
  },
  methods: {
    ...mapActions({
      getShop: "deliveryInfoModule/getShops"
    }),
    ...mapMutations({
      hideFooterAndHeader: 'mainModule/hideFooterAndHeader',
      openFooterAndHeader: 'mainModule/openFooterAndHeader',
    }),
    setDelivery(e) {
      this.isDelivery = e;
    }
  },
  mounted() {
    this.hideFooterAndHeader();
    this.getShop();
  },
  unmounted() {
    this.openFooterAndHeader();
  }
}
</script>
<style scoped>
.map {
  padding-left: 0 !important;
}

.information {
  padding-left: 2rem;
  padding-right: 2rem;
  min-height: 100vh;
  /*height: 100vh;*/
}
</style>