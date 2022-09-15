<template>
  <ModalAuth waiting="issue_password" v-model="isPassword" :title="$t('Введите ваш номер телефона')">
    <template #inputs>
      <div class="mt-2">
        <InputPhone v-model="phone" :placeholder="$t('Номер телефона')"/>
      </div>
      <ButtonForm :title="$t('Получить код')" @submit="submit" :is-entered="isEntered()"></ButtonForm>
    </template>
  </ModalAuth>
</template>
<script>
import ModalAuth from "@/components/modal/modalAuth";
import {mapActions, mapState} from "vuex";
import ButtonForm from "@/components/helper/button/buttonForm";
import InputPhone from "@/components/helper/input/inputPhone";

export default {
  components: {InputPhone, ButtonForm, ModalAuth},
  data() {
    return {
      phone: "",
      isPhoneEntered: false,
    }
  },
  computed: {
    ...mapState({
      isPassword: state => state.authWindow.isForgetPassword
    })
  },
  watch: {
    // whenever question changes, this function will run
    isPassword(newVal) {
      if (newVal) {
        this.phone = "";
      }
    },
    phone(newVal) {
      this.isPhoneEntered = newVal !== "" && newVal.length === 13;
    },
  },
  methods: {
    ...mapActions({
      issue: 'passwordModule/issueToken'
    }),
    submit() {
      this.issue({phone: this.phone});
    },
    isEntered() {
      return this.isPhoneEntered;
    }
  }
}
</script>