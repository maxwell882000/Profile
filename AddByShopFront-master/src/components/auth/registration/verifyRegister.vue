<template>
  <VerifyCode :custom-close="logoutAndClose"
              @codeSubmit="codeSubmit" :phone="user.phone"
              v-model="isVerifyRegister">
  </VerifyCode>
</template>
<script>
import VerifyCode from "@/components/auth/code/verifyCode";
import {mapActions, mapState} from "vuex";

export default {
  components: {VerifyCode},
  computed: {
    ...mapState({
      isVerifyRegister: state => state.authWindow.isVerifyRegister,
      user: state => state.auth.user
    })
  },
  methods: {
    ...mapActions({
      phoneVerify: 'phoneCodeVerify',
      logout: "logoutAndClose"
    }),
    logoutAndClose() {
      this.logout();
    },
    codeSubmit(value) {
      this.phoneVerify(value)
    }
  }
}
</script>