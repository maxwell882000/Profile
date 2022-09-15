<template>
  <InputValidation v-bind="Object.assign({},$attrs, $props )" :type="type()"
                   :placeholder="$attrs.placeholder || 'Пароль'">
    <template #suffix>
      <span class="px-2" style="cursor: pointer">
            <span @click="hide()" class="bi" :class=" icon() "></span>
      </span>
    </template>
  </InputValidation>
</template>
<script>
import InputValidation from "@/components/helper/input/inputValidation";

export default {
  components: {InputValidation},
  inheritAttrs: false,
  data() {
    return {
      isHidden: true,
    }
  },
  methods: {
    hide() {
      this.isHidden = !this.isHidden;
    },
    icon() {
      return this.isHidden ? ' bi-eye' : ' bi-eye-slash';
    },
    type() {
      return this.isHidden ? "password" : "text";
    }
  },

}
</script>