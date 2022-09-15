<template>
  <ModalAuth waiting="new_password" v-model="isNewPassword" :title="$t('Введите новый пароль')">
    <template #inputs>
      <Input type="password" autocomplete="password" v-model="password" :placeholder="$t('Новый пароль')"/>
      <Input type="password" autocomplete="repPassword" v-model="repPassword"
             :placeholder="$t('Повторите новый пароль')"></Input>
      <ButtonForm :title="$t('Отправить')" @submit="submit" :is-entered="isEntered()"></ButtonForm>
    </template>
  </ModalAuth>
</template>
<script>
import ButtonForm from "@/components/helper/button/buttonForm";
import Input from "@/components/helper/input/input";
import ModalAuth from "@/components/modal/modalAuth";
import {mapActions, mapState} from "vuex";

export default {
  components: {ModalAuth, Input, ButtonForm},
  data() {
    return {
      password: "",
      repPassword: "",
      isPassword: false,
      isRepPassword: false,
    }
  },
  watch: {
    password(newVal) {
      this.isPassword = newVal !== "";
    },
    repPassword(newVal) {
      this.isRepPassword = newVal !== "";
    }
  },
  computed: {
    ...mapState({
      isNewPassword: (state) => state.authWindow.isNewPassword
    }),
  },
  methods: {
    ...mapActions({
      newPassword: "passwordModule/newPassword"
    }),
    isEntered() {
      return this.isPassword && this.isRepPassword;
    },
    submit() {
      let pass = {
        password: this.password,
        password_repeat: this.repPassword
      }
      this.newPassword(pass);
    }
  }
}
</script>