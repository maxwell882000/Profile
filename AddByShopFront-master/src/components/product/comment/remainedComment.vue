<template>
  <div class="my-4">
    <div class="mb-2">
      <div class="d-flex align-items-center">
        <div style="margin-right: 10px">
          <custom-avatar size="lg" :name="comment.name" :src="comment.avatar"></custom-avatar>
        </div>
        <div>
          <span class="bold">{{ comment.name }}</span>
          <br>
          <span class="time">{{ comment.created_at }}</span>
        </div>
      </div>
      <div class="d-flex mt-1 align-items-end">
        <div style="margin-left:-5px">
          <stars :rating="comment.mark"></stars>
        </div>
        <!--        <span class="time">Отличный товар</span>-->
      </div>
    </div>
    <div>
      <p class="bold">{{ $t("Комментарии:") }}</p>
      <span>
        {{ comment.message }}
    </span>
    </div>
    <!--    <LikeDislikeComment></LikeDislikeComment>-->
    <hr>
  </div>

</template>

<style scoped>

.time {
  font-size: 13px;
  color: var(--gray);
}

p {
  padding: 0 !important;
  margin: 0 !important;
}

</style>
<script>
import Stars from "@/components/product/stars";
// import LikeDislikeComment from "@/components/product/comment/likeDislikeComment";
import CustomAvatar from "@/components/helper/avatar/customAvatar";

export default {
  components: {CustomAvatar, Stars,},
  props: {
    comment: {
      type: Object,
      default() {
        return {
          avatar: "",
          name: "Darrell Steward",
          mark: 3,
          created_at: "Вчера в 12:40",
          message: "Some cooment long",
          num_likes: 2,
          num_dislikes: 4,
        }
      }
    }
  }
}
</script>