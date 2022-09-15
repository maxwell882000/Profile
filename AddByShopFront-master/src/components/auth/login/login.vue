<template>
  <ModalAuth
      waiting="login" v-model="isLogin" :title="$t('Вход')">
    <template #inputs>
      <div class="mt-2">
        <InputPhone v-model="phone" :placeholder="$t('Номер телефона')"/>
      </div>
      <div class="mt-2">
        <InputPassword autocomplete="password" v-model="password"/>
      </div>
      <ButtonForm :title="$t('Войти')" :isEntered="isEntered()" @submit="login()"></ButtonForm>
      <div class="mt-2">
        <p @click="setRegister()" class="text-font text-link">
          {{ $t('Нет аккаунта ?') }}
        </p>
        <p @click="setPassword()" class="text-font text-link">
          {{ $t("Забыли пароль?") }}
        </p>
      </div>
    </template>
  </ModalAuth>
</template>
<script>
import InputPassword from "@/components/helper/input/inputPassword";
import ModalAuth from "@/components/modal/modalAuth";
import {mapActions, mapMutations, mapState} from "vuex";
import ButtonForm from "@/components/helper/button/buttonForm";
import InputPhone from "@/components/helper/input/inputPhone";

export default {
  components: {InputPhone, ButtonForm, ModalAuth, InputPassword},
  data() {
    return {
      phone: "",
      password: "",
      isPhoneEntered: false,
      isPasswordEntered: false,
    }
  },
  computed: {
    ...mapState({
      isLogin: state => state.authWindow.isLogin
    })
  },
  watch: {
    isLogin(val) {
      if (val) {
        this.password = "";
      }
    },
    // whenever question changes, this function will run
    phone(newVal) {
      this.isPhoneEntered = newVal !== "";
    },
    password(newVal) {
      this.isPasswordEntered = newVal !== "";
    }
  },
  methods: {
    ...mapActions({
      sendLogin: 'login',
    }),
    ...mapMutations({
      setRegister: "authWindow/setRegister",
      setPassword: "authWindow/setForget"
    }),
    async login() {
      let request = {
        phone: this.phone,
        password: this.password
      };
      await this.sendLogin(request);
    },
    isEntered() {
      return this.isPasswordEntered && this.isPhoneEntered;
    }
  }
}
</script>