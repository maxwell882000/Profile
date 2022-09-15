<template>
  <empty-base image="card-pos.png"
              :title="$t('У вас нет сохраненных карт')"
              :desc="$t('Добавьте карту, чтобы оплачивать покупки и рассрочку')">
    <router-link :to="{
      name:'insert_card'
    }">
      <button-blue class="p-2" style="width: max-content" :title="$t('Добавить документы')"></button-blue>
    </router-link>
  </empty-base>
</template>
<script>
import EmptyBase from "@/components/helper/empty/emptyBase";
import ButtonBlue from "@/components/helper/button/buttonBlue";

export default {
  components: {ButtonBlue, EmptyBase}
}
</script>