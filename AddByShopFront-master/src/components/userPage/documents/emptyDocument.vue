<template>
  <empty-page image="document.png"
              :title="$t('Нет документов')"
              link="/verification/1"
              :buttonText="$t('Добавить документы')"
              :desc="$t('Добавьте документы чтобы брать товары в рассрочку')"
  >
  </empty-page>
</template>
<script>
import EmptyPage from "@/components/helper/empty/emptyPage";

export default {
  components: {EmptyPage}
}
</script>