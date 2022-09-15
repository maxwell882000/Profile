<template>
  <div class="bg-white rounded-st">
    <b-container class="w-100">
      <loader :div-style="{height: '10vh'}" waiting="rate">
        <b-row class="text-rate justify-content-center p-4">
          <b-col cols="4" align-self="center">
            <div class="d-flex align-items-end p-0 m-0">
              <div>
                <h4>{{ rate.mark || 0 }}</h4>
              </div>
              <div>
                <span>/5</span>
              </div>
            </div>
            <span>{{ rate.mark_num }} {{ $t("отзывов") }}</span>
          </b-col>
          <b-col cols="6">
            <div class="d-flex align-items-center">
              <div style="font-size: 10px">
                <stars rating="5"></stars>
              </div>
              <span>{{ rate.mark_5 }}</span>
            </div>
            <div class="d-flex align-items-center">
              <div style="font-size: 10px">
                <stars rating="4"></stars>
              </div>
              <span>{{ rate.mark_4 }}</span>
            </div>
            <div class="d-flex align-items-center">
              <div style="font-size: 10px">
                <stars rating="3"></stars>
              </div>
              <span>{{ rate.mark_3 }}</span>
            </div>
            <div class="d-flex align-items-center">
              <div style="font-size: 10px">
                <stars rating="2"></stars>
              </div>
              <span>{{ rate.mark_2 }}</span>
            </div>
            <div class="d-flex align-items-center">
              <div style="font-size: 10px">
                <stars rating="1"></stars>
              </div>
              <span>{{ rate.mark_1 }}</span>
            </div>
          </b-col>
          <b-col cols="12" class="mt-4">
            <router-link :to='`/item/${$route.params.id}/comment`'>
              <ButtonGray style="margin-top: 5px!important;" :title="$t('Оставить отзыв')"></ButtonGray>
            </router-link>
          </b-col>
        </b-row>
      </loader>
    </b-container>
  </div>
</template>
<script>
import Stars from "@/components/product/stars";
import ButtonGray from "@/components/helper/button/buttonGray";
import {mapGetters} from "vuex";
import Loader from "@/components/loading/loader";

export default {
  components: {Loader, ButtonGray, Stars},
  computed: {
    ...mapGetters({
      rate: 'rateModule/rate'
    })
  }
}
</script>
<style scoped>
.text-rate {
  padding: 10px 0;
}

@media (max-width: 768px) {
  .rounded-st {
    border-radius: 0;
  }
}

span {
  font-size: 0.80rem !important;
}

h4 {
  margin-bottom: 0;
  font-weight: 700;
  line-height: 1.8rem;
}

</style>