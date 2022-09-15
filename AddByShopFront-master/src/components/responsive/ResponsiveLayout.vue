<template>
  <MqResponsive target="md-">
    <slot name="mobile"></slot>
  </MqResponsive>
  <MqResponsive target="lg+">
    <slot name="desktop"></slot>
  </MqResponsive>
</template>

<script setup>
import {MqResponsive} from "vue3-mq";</script>

<style scoped>

</style>