<template>
  <loader waiting="user">
    <section class="bg-white p-3 rounded-st mb-3">
      <h6>{{ $t("Общая информация") }}</h6>
      <b-row>
        <b-col cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <InputValidation required :error="errorData[type.FIRST_NAME]"
                           v-model="userData[type.FIRST_NAME]"
                           :placeholder="$t('Имя*')"/>
        </b-col>
        <b-col cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <InputValidation :error="errorData[type.PNFL]"
                           v-model="userData[type.PNFL]"
                           :placeholder="$t('ПИНФЛ')"/>
        </b-col>
        <b-col cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <InputValidation :error="errorData[type.LAST_NAME]"
                           v-model="userData[type.LAST_NAME]"
                           :placeholder="$t('Фамилия*')"/>
        </b-col>
        <b-col cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <InputValidation :error="errorData[type.FATHER_NAME]"
                           v-model="userData[type.FATHER_NAME]"
                           :placeholder="$t('Отчество*')"/>
        </b-col>
        <b-col v-show="isSurety()" cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <InputValidation :error="errorData[type.PHONE]"
                           v-model="userData[type.PHONE]"
                           :placeholder="$t('Номер телефона*')"/>
        </b-col>
        <b-col cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <InputValidation :error="errorData[type.ADDITIONAL_PHONE]"
                           v-model="userData[type.ADDITIONAL_PHONE]"
                           :placeholder="$t('Доп. номер телефона*')"/>
        </b-col>
        <b-col cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <InputValidation :error="errorData[type.SERIES]"
                           v-model="userData[type.SERIES]"
                           :placeholder="$t('Серия паспорта*')"/>
        </b-col>
        <b-col cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <InputValidation type="date" :error="errorData[type.DATE_OF_BIRTH]"
                           v-model="userData[type.DATE_OF_BIRTH]"
                           :placeholder="$t('Дата рождения*')"/>
        </b-col>
        <b-col cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <dropdown-choose
              class="input-validation"
              :label="$t('Выберите пол')"
              :placeholder="$t('Пол*')"
              :error="errorData[type.SEX]"
              v-model="userData[type.SEX]"
              :items="sex"
          ></dropdown-choose>
        </b-col>
      </b-row>
    </section>
    <section v-show="!isSurety()" class="bg-white p-3 rounded-st">
      <h6>{{ $t("У вас есть рассрочка в других местах в данный момент?") }}</h6>
      <div class="d-flex w-30">
        <ButtonForm
            @click="isDept = true"
            class="mr-2"
            :is-entered="isDept || userData[type.DEPT_SUM]"
            :title-style="{ style: 'var(--dark)' }"
            :title="$t('Да')"
        ></ButtonForm>
        <ButtonForm
            @click="isDept = false"
            :is-entered="!(isDept || userData[type.DEPT_SUM] )"
            :title-style="{ style: 'var(--dark)' }"
            :title="$t('Нет')"
        ></ButtonForm>
      </div>
      <b-row>
        <b-col v-show="isDept || userData[type.DEPT_SUM]" cols="12" class="col-xl-6 col-lg-6 col-md-12">
          <InputValidation :error="errorData[type.DEPT_SUM]" v-model="userData[type.DEPT_SUM]"
                           :placeholder="$t('Сумма рассрочки')"/>
        </b-col>
        <b-col></b-col>
      </b-row>
    </section>
    <router-link :to="correctPath() +'/' + nextPage" replace>
      <ButtonBlue @click="goNextPage" class="w-20 mb-3 py-2" :title="$t('Далее')"></ButtonBlue>
    </router-link>
  </loader>
</template>
<script setup>
import ButtonForm from "@/components/helper/button/buttonForm";
import ButtonBlue from "@/components/helper/button/buttonBlue";
import {computed, ref, watch} from "vue";
import {useStore} from "vuex";
import verificationConstant from "@/constants/verification/verificationConstant";
import InputValidation from "@/components/helper/input/inputValidation";
import validation from "@/mixins/validation";
import DropdownChoose from "@/components/helper/dropdown/dropdownChoose";
import sexItems from "@/constants/helper/dropDown/sexItems";
import {useRoute, useRouter} from "vue-router";
import Loader from "@/components/loading/loader";
import {useI18n} from "vue-i18n";

const isDept = ref(false);
const nextPage = ref(1);
const store = useStore();
const userData = computed(() => store.getters['verificationModule/userData']);
const errorData = computed(() => store.getters['verificationModule/errorData']);
const validate = () => store.dispatch('verificationModule/validation');
const type = verificationConstant;
const sex = sexItems;
const route = useRoute();
const router = useRouter();
const user = computed(() => store.getters['user'])
const t = useI18n().t;

function goToBasketIfOkay() {
  if (user.value.name === "" && isUser()) {
    router.replace({
      name: 'basket'
    })
  }
}

watch(() => user, function () {
  goToBasketIfOkay();
}, {immediate: true})

function isUser() {
  return !isSurety();
}

function isSurety() {
  const path = route.path.split("/");
  console.log(path.slice(-2)[0]);
  return path.slice(-2)[0] === "surety";
}

function correctPath() {
  const path = route.path.split("/");
  console.log(path);
  return path.slice(0, path.length - 1).join("/");
}

function goNextPage() {
  validate();
  if (isSurety()) {
    validation(userData, errorData, type.PHONE, t("Номер телефона"));
  }
  if (isDept.value) {
    validation(userData.value, errorData.value, type.DEPT_SUM, t("Если вы выбрали 'ДА', то cумма рассрочки"));
  }
  if (!Object.entries(errorData.value).length)
    nextPage.value = 2;
}

</script>

<style scoped>
.input-validation {
  margin-bottom: 0.5rem;
  margin-top: 0.5rem;
}
</style>