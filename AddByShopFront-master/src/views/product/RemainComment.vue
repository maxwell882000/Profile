<template>
  <section class="container left_comment">
    <loader waiting="left_comment">
      <back-button :title="$t('К описанию товара')"></back-button>
      <div class="d-flex align-items-center rounded-st bg-white p-3 my-3">
        <div class="mr-4" style="height: 3rem;width: 3rem;">
          <img class="img-res" :src="image"/>
        </div>
        <span class="bold text-sm">{{ name }}</span>
      </div>
      <div class="rounded-st bg-white p-3 mb-4">
        <b-row>
          <b-col cols="6" class="my-3">
            <h6 v-show="error" v-html="error" class="text-error text-font"></h6>
            <h6>{{ $t('Общая оценка') }}</h6>
            <div class="text-nowrap my-3">
              <span :key="'star_index_' + index"
                    v-for="index in 5"
                    style="margin-right: 2rem"
                    :style="{color: isSelected(index), cursor: 'pointer', fontSize: '2rem'}"
                    @click="putMark(index)"
                    class="bi  bi-star-fill"/>
            </div>
          </b-col>
          <div class="w-100"></div>
          <b-col cols="12" class="col-xl-6 col-lg-8 col-md-10 col-sm-12">
            <h6>{{ $t('Расскажите подробнее') }}</h6>
            <TextArea class="my-3" v-model="comment"
                      :placeholder="$t('Ваш комментарий')"></TextArea>
          </b-col>
          <div class="w-100"></div>
          <b-col cols="12" class="col-xl-6 col-lg-8 col-md-10 col-sm-12">
            <ButtonForm :is-entered="isEntered" @click="submitComment"
                        :title="$t('Опубликовать отзыв')"></ButtonForm>
          </b-col>
        </b-row>
      </div>
    </loader>
    <SuccessComment v-model="showSuccess"></SuccessComment>
  </section>
</template>
<script>
import TextArea from "@/components/helper/text-area/textArea";
import ButtonForm from "@/components/helper/button/buttonForm";
import BackButton from "@/components/helper/button/backButton";
import Loader from "@/components/loading/loader";
import {mapActions, mapGetters, mapMutations} from "vuex";
import SuccessComment from "@/components/product/comment/successComment";

export default {
  components: {SuccessComment, Loader, BackButton, ButtonForm, TextArea},
  data() {
    return {
      selected: 0,
      comment: "",
    }
  },
  computed: {
    ...mapGetters({
      name: 'productModule/name',
      isAuthenticated: "isAuthenticated",
      image: "productModule/image",
      showSuccess: 'commentModule/showSuccess',
      error: 'commentModule/error'
    }),
    isEntered() {
      return this.comment && this.selected;
    }
  },
  methods: {
    ...mapMutations({
      login: 'authWindow/setLogin',
      setSuccess: 'commentModule/setShowSuccess'
    }),
    ...mapActions({
      leftComment: 'commentModule/leftComment'
    }),
    isSelected(selected) {
      return this.selected < selected ? 'var(--star)' : 'var(--yellow)';
    },
    submitComment() {
      let request = {
        message: this.comment,
        mark: this.selected
      }
      this.leftComment(request);
    },
    putMark(selected) {
      this.selected = selected;
    }
  },
  created() {
    if (!this.isAuthenticated) {
      this.$router.replace(`/item/${this.$route.params.id}/`);
      this.login();
    }
  },
  beforeUnmount() {
    this.setSuccess(false);
  }
}
</script>
<style scoped>
.left_comment h6 {
  font-size: 1.2rem;
}
</style>