<template>
  <section class="section-container">
    <div class="d-flex justify-content-between">
      <h5 class="text-header-32">{{ $t("Уведомления") }}</h5>
      <input-toggle></input-toggle>
    </div>
    <hr>
    <div>
      <span class="bold block mb-2">{{ $t("Возвращайтесь за рассрочкой!") }}  </span>
      <span
          class="block mb-2">{{ $t("Заполните анкету и купите все, что давно хотели, уже через несколько минут") }}</span>
      <span class="text-gray mb-2">20 ноября 2021</span>
    </div>
  </section>
</template>
<script>
import InputToggle from "@/components/helper/input/inputToggle";

export default {
  components: {InputToggle}
}
</script>