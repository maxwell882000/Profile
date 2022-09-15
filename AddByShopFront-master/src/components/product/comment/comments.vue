<template>
  <section class="container">
    <b-row class="mb-4  flex-wrap-reverse flex-sm-wrap-reverse flex-md-wrap-reverse flex-lg-wrap">
      <b-col cols="12" class=" col-xl-9 col-lg-8 col-md-12 col-sm-12 ">
        <div class="comment rounded-st">
          <h5>{{ $t("Отзывы") }} <span class="text-gray">{{ product.num_comment }}</span></h5>
          <loader waiting="comment">
            <remained-comment :comment="item" v-for="item in comment"
                              :key="'commment_unique_s' + item.id"></remained-comment>
            <loader :div-style="{height: '5vh'}" waiting="new_comment">
              <ButtonGray v-if="!lastPage" @click="getNewComments" :title="$t('Показать больше отзывов')"></ButtonGray>
            </loader>
          </loader>
        </div>
      </b-col>
      <b-col cols="12" class="col-xl-3 col-lg-4 col-md-12 col-sm-12 mb-2 mb-sm-2 mb-md-4 p-0">
        <rating-comment></rating-comment>
      </b-col>
    </b-row>
  </section>
</template>

<style scoped>
@media (max-width: 768px) {
  .rounded-st {
    border-radius: 0;
  }
}

.comment {
  background-color: white;
  padding: 24px;
}
</style>
<script>


import RatingComment from "@/components/product/comment/ratingComment";
import RemainedComment from "@/components/product/comment/remainedComment";
import ButtonGray from "@/components/helper/button/buttonGray";
import {mapActions, mapGetters} from "vuex";
import Loader from "@/components/loading/loader";

export default {
  components: {Loader, ButtonGray, RemainedComment, RatingComment},
  computed: {
    ...mapGetters({
      product: 'productModule/product',
      comment: 'commentModule/comment',
      lastPage: 'commentModule/isLastPage',
    })
  },
  methods: {
    ...mapActions({
      getNewComments: 'commentModule/getNewComments'
    })
  }

}
</script>