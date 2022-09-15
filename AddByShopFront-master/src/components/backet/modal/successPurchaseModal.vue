<template>
  <ModalView
      v-model="isSuccess"
      @closeModal="closeModal"
      :title="`${$t('Ваш заказ')} № ${createdId} ${$t('принят!')}`"
      :description="$t('Ожидайте, скоро с вами свяжется оператор, для подтверждения.')">
    <template #prefix>
      <img src="@/assets/modal/accepted.png" alt="check sign">
    </template>
    <template #buttons>
      <div class="w-60 m-auto">
        <router-link :to="isSuccess ? {name: 'orders'} : {}">
          <ButtonBlue :title="$t('Посмотреть заказ')">
          </ButtonBlue>
        </router-link>
        <router-link to="/" class="remove-link">
          <span class="text-sm">
             {{ $t('Продолжить покупки') }}
          </span>
        </router-link>
      </div>
    </template>
  </ModalView>
</template>
<script setup>
import ModalView from "@/components/modal/modalView";
import ButtonBlue from "@/components/helper/button/buttonBlue";
import {useStore} from "vuex";
import {computed} from "vue";
import {useRouter} from "vue-router";

const store = useStore();
const route = useRouter();
const isSuccess = computed(() => store.getters['registrationOrderModule/successPurchase']);
const createdId = computed(() => store.getters['registrationOrderModule/createdId']);

function closeModal() {
  route.replace({
    name: "basket"
  });
}
</script>