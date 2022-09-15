<template>
  <ModalAuth waiting="register" v-model="isRegister" :title="$t('Регистрация')">
    <template #inputs>
      <Input v-model="name" :placeholder="$t('Введите имя')"/>
      <div class="mt-custom">
        <InputPhone v-model="phone" :placeholder="$t('Номер телефона')"/>
      </div>
      <div class="mt-custom">
        <InputPassword autocomplete="password" v-model="password"/>
      </div>
      <ButtonForm @submit="register" :is-entered="isEntered()" :title="$t('Зарегистрироваться')"></ButtonForm>
      <div class="mt-2">
        <p class="text-font">
          {{ $t("Уже есть аккаунта ?") }}
        </p>
        <p @click="setLogin()" style="color: var(--blue)" class="text-font text-link">
          {{ $t("Войти") }}
        </p>
      </div>
    </template>
  </ModalAuth>
</template>
<script>
import ModalAuth from "@/components/modal/modalAuth";
import InputPassword from "@/components/helper/input/inputPassword";
import Input from "@/components/helper/input/input";
import {mapActions, mapMutations, mapState} from "vuex";
import ButtonForm from "@/components/helper/button/buttonForm";
import InputPhone from "@/components/helper/input/inputPhone";

export default {
  components: {InputPhone, ButtonForm, Input, InputPassword, ModalAuth},
  data() {
    return {
      phone: "",
      password: "",
      name: "",
      isPhoneEntered: false,
      isPasswordEntered: false,
      isNameEntered: false
    }
  },
  watch: {
    phone(newVal) {
      this.isPhoneEntered = newVal !== "";
    },
    password(newVal) {
      this.isPasswordEntered = newVal !== "";
    },
    name(newVal) {
      this.isNameEntered = newVal !== ""
    }
  },
  methods: {
    ...mapMutations({
      setLogin: 'authWindow/setLogin',
    }),
    ...mapActions({
      setRegister: "register"
    }),
    register() {
      let request = {
        phone: this.phone,
        name: this.name,
        password: this.password
      }
      this.setRegister(request);
    },
    isEntered() {
      return this.isPhoneEntered && this.isPasswordEntered && this.isNameEntered && this.phone.length === 13;
    },
  },
  computed: {
    ...mapState({
      isLogin: state => state.authWindow.isLogin,
      isRegister: state => state.authWindow.isRegister
    })
  },
}
</script>