<template>
  <button @click.prevent="clicked" class="like-btn" v-b-tooltip.hover :title="$t('Добавить в избраное')">
    <ResponsiveLayout>
      <template #desktop>
        <heart :class="fill && 'active'"></heart>
      </template>
      <template #mobile>
        <like-mob :class="fill &&'active'"></like-mob>
      </template>
    </ResponsiveLayout>
    <!--    <span :style="styleIcon()" class="bi" :class="fill ? 'bi-heart-fill' : 'bi-heart'"></span>-->
  </button>
</template>

<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
import Heart from "@/components/icons/heart";
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";
import LikeMob from "@/components/icons/likeMob";

export default {
  components: {LikeMob, ResponsiveLayout, Heart},
  props: ['id', 'favourite'],
  data() {
    return {
      fill: this.favourite,
    }
  },
  methods: {
    ...mapGetters(['isAuthenticated']),
    ...mapMutations(['authWindow/setLogin', 'decreaseFavouriteCounter', 'increaseFavouriteCounter']),
    ...mapActions(['addRemoveFavourite']),
    clicked() {
      if (this.id && this.isAuthenticated()) {
        this.addRemoveFavourite({id: this.id, name: this.$route.name});
        this.fill = !this.fill;
        if (!this.fill) {
          this.$root.$emit("like-updated");
          this.decreaseFavouriteCounter();
        } else {
          this.increaseFavouriteCounter();
        }
      } else if (!this.isAuthenticated()) {
        this['authWindow/setLogin']();
      }
    },
    styleIcon() {
      return {
        color: this.fill ? 'red' : "grey"
      }
    }
  }
}
</script>
<style>
.like-btn .active path, .like-btn .active {
  stroke: var(--red) !important;
  fill: var(--red);
}

@media (min-width: 768px) {
  .like-btn path {
    stroke: var(--gray300);
  }
}

</style>
<style scoped>
button.like-btn {
  background: transparent;
  border-radius: 20px;
  z-index: 1;
  border: none;
  font-size: 18px;
}


</style>