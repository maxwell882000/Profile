<template>
  <loader waiting="complete_validation">
    <section class="container">
      <back-button :title="$t('Назад в оформление')"></back-button>
      <h5 class="text-header-32">{{ $t("Верификация аккаунта") }}</h5>
      <div class="container">
        <b-row>
          <b-col cols="12" class="col-xl-7 col-lg-8 overflow  my-2">
            <div class="d-flex">
              <step-header
                  :name="$t('Общая информация')"
                  :is-flex="true" :number="1">
                <template #number>
                  <span class="text-sm"> 1 </span>
                </template>
              </step-header>
              <step-header
                  :name="$t('Фото паспорта')"
                  :is-flex="true" :number="2">
                <template #number>
                  <span class="text-sm"> 2 </span>
                </template>
              </step-header>
              <step-header
                  :name="$t('Страница паспорта')"
                  :is-flex="true" :number="3">
                <template #number>
                  <span class="text-sm"> 3 </span>
                </template>
              </step-header>
              <step-header
                  :name="$t('Селфи')"
                  :number="4" :disable-line="true">
                <template #number>
                  <span class="text-sm"> 4 </span>
                </template>
              </step-header>
            </div>
          </b-col>
        </b-row>
      </div>
      <div class="row">
        <div class="col col-xl-7 col-lg-8">
          <router-view></router-view>
        </div>
      </div>
    </section>
  </loader>

</template>
<script setup>
import BackButton from "@/components/helper/button/backButton";
import StepHeader from "@/components/verification/stepHeader";
import Loader from "@/components/loading/loader";</script>