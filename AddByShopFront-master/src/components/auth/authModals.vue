<template>
  <div>
    <Login></Login>
    <Regisration></Regisration>
    <ForgetPassword></ForgetPassword>
    <VerifyRegister></VerifyRegister>
    <VerifyForget></VerifyForget>
    <NewPassword></NewPassword>
  </div>

</template>
<script>
import Login from "@/components/auth/login/login";
import Regisration from "@/components/auth/registration/regisration";
import ForgetPassword from "@/components/auth/forgetPassword/forgetPassword";
import VerifyRegister from "@/components/auth/registration/verifyRegister";
import VerifyForget from "@/components/auth/forgetPassword/verifyForget";
import NewPassword from "@/components/auth/forgetPassword/newPassword";

export default {
  components: {NewPassword, VerifyForget, VerifyRegister, ForgetPassword, Regisration, Login}
}
</script>