<template>
  <div style="height: 100%; width: 100vw">
    <l-map
        v-model="zoom"
        v-model:zoom="zoom"
        :center="[41.2995, 69.2401]"
        @move="log('move')">
      <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
      <l-control-layers/>
      <slot name="markers"></slot>
    </l-map>
  </div>
<!--  <l-marker :lat-lng="markerLatLng">-->
<!--    &lt;!&ndash;        <l-icon>&ndash;&gt;-->
<!--    &lt;!&ndash;&lt;!&ndash;          <img src="@/assets/icons/map_pin.svg">&ndash;&gt;&ndash;&gt;-->
<!--    &lt;!&ndash;        </l-icon>&ndash;&gt;-->
<!--  </l-marker>-->
</template>

<script>
import {
  LMap,
  LControlLayers,
  LTileLayer,

} from "@vue-leaflet/vue-leaflet";
import "leaflet/dist/leaflet.css";

export default {
  components: {
    LMap,
    LControlLayers,
    LTileLayer,
    // eslint-disable-next-line vue/no-unused-components
  },
  data() {
    return {
      zoom: 11,
      url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
      attribution:
          '&copy; <a target="_blank" href="http://osm.org/copyright">OpenStreetMap</a> contributors',
      iconWidth: 25,
      markerLatLng: [41.34999319211107, 69.34938845769688],
      iconHeight: 40,
    };
  },
  computed: {
    iconUrl() {
      return `https://placekitten.com/${this.iconWidth}/${this.iconHeight}`;
    },
    iconSize() {
      return [this.iconWidth, this.iconHeight];
    },
  },
  methods: {
    log(a) {
      console.log(a);
    },
    changeIcon() {
      this.iconWidth += 2;
      if (this.iconWidth > this.iconHeight) {
        this.iconWidth = Math.floor(this.iconHeight / 2);
      }
    },
  },
};
</script>
© 2022 GitHub, Inc.
Terms
Privacy
Security
Status
Docs
Contact GitHub
Pricing
API
Training
Blog
About
