<template>

  <div class="rating">
    <div class="mr-2 d-flex">
      <stars :rating="rating"></stars>
      <span class="ratings-count">{{ rating }}</span>
      <span class="reviews-count">{{ reviews }} {{ $t("отзывов") }}</span>
    </div>

    <div class="d-flex">
      <div class="rating__review top-icon px-2">
        <button v-b-tooltip.hover class="button-clear" title="Оставить комментарий">
          <comments-icon src="@/assets/icons/review.png" alt="comparison icon"/>
        </button>
        <router-link class="remove-link" :to="`/item/${this.$route.params.id}/comment`">
          <span>{{ $t("Оставить отзыв") }}</span>
        </router-link>
      </div>
      <div class="rating__comparison top-icon px-2">
        <Like :id="favourite.id" :favourite="favourite.favourite"></Like>
        <span>{{ $t("В избранное") }}</span>
      </div>
    </div>

    <!--    <div class="rating__comparison top-icon">-->
    <!--      <img src="@/assets/icons/comparison.png" alt="comparison icon"/>-->
    <!--      <span>Сравнить</span>-->
    <!--    </div>-->
  </div>
</template>
<script>
import {mapGetters} from "vuex";
import Like from "@/components/buttons/Like";
import Stars from "@/components/product/stars";
import CommentsIcon from "@/components/icons/commentsIcon";

export default {
  components: {CommentsIcon, Stars, Like},
  computed: {
    ...mapGetters({
      reviews: "productModule/reviews",
      rating: "productModule/rating",
      favourite: "productModule/favourite"
    }),

  }
}
</script>
<style scoped lang="scss">
a:hover {
  color: var(--dark) !important;
}


.rating {
  margin-bottom: 25px;
  display: flex;
  align-items: center;

  .ratings-count {
    margin-left: 5px;
    margin-right: 8px;
  }

  .top-icon {
    display: flex;
    align-items: center;
    cursor: pointer;

    img {
      margin-right: 8px;
    }
  }

  @media (max-width: 767px) {
    flex-wrap: wrap;
    gap: 4px;
    margin-bottom: 0;
    .top-icon {
      margin-left: 0;
      padding: 0 !important;
    }
  }
}

.star {
  color: var(--yellow) !important;
}

</style>