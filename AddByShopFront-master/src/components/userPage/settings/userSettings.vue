<template>
  <loader waiting="user">
    <user-not-verified @edit-profile="showProfile = true" v-if="!user.user_credit && !showProfile"
                       :user="user"></user-not-verified>
    <template v-else-if="user.user_credit || showProfile">
      <div>
        <div class="buyshop-card mb-3">
          <loader :div-style="{height: '20vh'}" waiting="avatar">
            <h6>{{ $t("Фото профиля") }}</h6>
            <div class="d-flex flex-column justify-content-start align-items-start ">
              <b-avatar :src="user.avatar" size="5rem"></b-avatar>
              <input @change="uploadImage"
                     type="file"
                     ref="file"
                     style="display: none">
              <b-button size="sm"
                        @click="$refs.file.click()"
                        variant="link"
                        style="text-decoration: none">
                {{ $t("Изменить") }}
              </b-button>
            </div>
          </loader>

        </div>
        <div class="buyshop-card mb-3">

          <b-row>
            <b-col cols="12" class="col-xl-4 col-lg-6 col-md-8 col-sm-12">
              <h6>{{ $t("Персональные данные") }}</h6>
              <loader :div-style="{height: '20vh'}" waiting="user_data_loaded">
                <div class="">
                  <Input
                      class="input"
                      v-model="userName"
                      :placeholder="$t('Имя и Фамилия*')"/>
                  <div class="mt-3">
                    <InputPhone
                        class="input"
                        v-model="phone"
                        :placeholder="$t('Телефон*')"
                    />
                  </div>

                  <ButtonForm :is-entered="isEnteredUserData()"
                              @submit="changeUserData({name: userName,phone: phone})"
                              :title="$t('Изменить')" class="p-2">
                  </ButtonForm>
                </div>
              </loader>
              <!--      <div class="d-flex flex-wrap">-->
              <!--        <input-field-->
              <!--            type="date"-->
              <!--            class="input-sm"-->
              <!--            v-model="birth"-->
              <!--            placeholder="День рождения"-->
              <!--        />-->
              <!--        <b-dropdown-->
              <!--            id="dropdown-1"-->
              <!--            :text="gender == 'm' ? `Мужчина` : `Женщина`"-->
              <!--            variant="white"-->
              <!--            class="custom-dropdown"-->
              <!--        >-->
              <!--          <b-dropdown-item @click="gender = 'm'">Мужчина</b-dropdown-item>-->
              <!--          <b-dropdown-item @click="gender = 'f'">Женщина</b-dropdown-item>-->
              <!--        </b-dropdown>-->
              <!--      </div>-->

            </b-col>
          </b-row>
        </div>
        <form @submit.prevent="" class="buyshop-card">

          <b-row>
            <b-col cols="12" class="col-xl-4 col-lg-6 col-md-8  col-sm-12">
              <h6>{{ $t("Аккаунт") }}</h6>
              <div class="password">
                <loader waiting="password_loaded">
                  <Error :error="errorPassword"></Error>
                  <Success :success="successPassword"></Success>
                  <InputPassword autocomplete="password" v-model="password.password"
                                 :placeholder="$t('Старый пароль')">
                  </InputPassword>
                  <InputPassword autocomplete="password_new" :error="password.password_new_error"
                                 v-model="password.password_new"
                                 :placeholder="$t('Новый пароль')">
                  </InputPassword>
                  <InputPassword autocomplete="password_rep" :error="password.password_new_error"
                                 v-model="password.password_rep"
                                 :placeholder="$t('Подтвердите пароль')"/>
                  <ButtonForm @submit="submitPassword"
                              :is-entered="isEnteredPassword()"
                              :title="$t('Изменение пароля')"
                              class="p-2">
                  </ButtonForm>
                </loader>
              </div>
            </b-col>
          </b-row>
        </form>
        <ResponsiveLayout>
          <template #mobile>
            <ButtonRed @click="logout" :title="$t('Выйти')"></ButtonRed>
          </template>
        </ResponsiveLayout>
      </div>
    </template>

  </loader>
</template>

<script setup>
import Input from "@/components/helper/input/input";
import InputPhone from "@/components/helper/input/inputPhone";
import InputPassword from "@/components/helper/input/inputPassword";
import ButtonForm from "@/components/helper/button/buttonForm";
import {computed, onBeforeUnmount, ref, watch} from "vue";
import Loader from "@/components/loading/loader";
import {useStore} from "vuex";
import Error from "@/components/helper/error/error";
import Success from "@/components/helper/status/success";
import ButtonRed from "@/components/helper/button/buttonRed";
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";
import UserNotVerified from "@/components/userPage/settings/userNotVerified";

const user = computed(() => store.getters['user']);
const store = useStore();
const userName = ref(user.value.name);
const phone = ref(user.value.phone);
const password = computed(() => store.getters['passwordModule/passwordChange']);
const changePassword = () => store.dispatch("passwordModule/changePassword");
const cleanPassword = () => store.commit("passwordModule/cleanPassword");
const cleanSuccess = () => store.commit("passwordModule/setSuccessPassword", "");
const errorPassword = computed(() => store.getters['passwordModule/error']);
const successPassword = computed(() => store.getters['passwordModule/success']);
// eslint-disable-next-line no-unused-vars
const uploadAvatar = (val) => store.dispatch("changeAvatar", val);
const changeUserData = (data) => store.dispatch("changeUserData", data);
const logout = () => store.dispatch('logout');
const showProfile = ref(false);
cleanPassword();
watch(user, function () {
  userName.value = user.value.name;
  phone.value = user.value.phone;
});

function isEnteredUserData() {
  return userName.value && phone.value && phone.value.length === 13;
}

function isEnteredPassword() {
  return password.value.password_rep.length
      && password.value.password_new.length
      && password.value.password.length;
}

// eslint-disable-next-line no-unused-vars
function uploadImage(event) {
  console.log(event.target.files[0]);
  // uploadAvatar(event.target.files);
  uploadAvatar(event.target.files[0]);
}

function submitPassword() {
  if (password.value.password_new !== password.value.password_rep) {
    password.value.password_new_error = "Пароли не совпадают";
  } else {
    password.value.password_new_error = "";
  }
  if (!password.value.password_new_error.length)
    changePassword();
}

onBeforeUnmount(() => {
  cleanSuccess();
});
</script>

<style scoped>
.password .input-validation {
  margin-bottom: 1rem;
  margin-top: 1rem;
}

.form-account {
  width: 35%;
}

@media (max-width: 1199px) and (min-width: 768px) {
  .form-account {
    width: 45%;
  }
}

@media (max-width: 767px) {
  .form-account {
    width: 60%;
  }
}

.profile-photo {
  width: 83px;
  height: 83px;
  border-radius: 50%;
  background: #bd00ff;
}

.input {
  width: 600px;
}

.input-sm {
  width: 300px;
  margin-right: 30px;
}

.custom-dropdown {
  height: 50px;
  width: 270px;
  border: 1px solid #f2f2f2;
  border-radius: 10px;
}

@media (max-width: 992px) {
  .input,
  .input-sm,
  .custom-dropdown {
    width: 100%;
    margin-right: 0;
  }
}
</style>