<template>
  <ModalView @close-modal="$router.replace(`/item/${$route.params.id}/`)">
    <template #body>
      <img alt="Star" src="@/assets/comment/star_comment.png">
      <br>
      <span class="bold text-sm">{{ $t("Спасибо, ваш отзыв скоро будет опубликован!") }}</span>
      <router-link class="remove-link" :to='`/item/${$route.params.id}/`'>
        <ButtonBlue :title="$t('Понятно')"></ButtonBlue>
      </router-link>
    </template>
  </ModalView>
</template>
<script>
import ModalView from "@/components/modal/modalView";
import ButtonBlue from "@/components/helper/button/buttonBlue";

export default {
  components: {ButtonBlue, ModalView}
}
</script>