<template>
  <Dropdown v-model="statusDropDown" :label="label" class="pointer text-gray"
            :style-drop-down="styleDropDown || {width: '100%'}">
    <template #button>
      <div
          :style="{'border-color': error && 'var(--red)'}"
          class="border-only rounded-st bg-white p-2 d-flex justify-content-between align-items-center">
              <span :class="chosenText && 'text-dark text-500'">
                {{ chosenText || placeholder }}
              </span>
        <span class="pt-1 bi bi-chevron-down"></span>
      </div>
      <error :error="error"></error>
    </template>
    <template #items>
      <button :key="'chosen_element_' + placeholder + '__' + item.key"
              v-for="item in items"
              @click="selectItem(item)"
              class="button-clear text-start w-100 text-dark">
                <span>
                {{ item.label }}
                </span>
      </button>
    </template>
  </Dropdown>
</template>
<script setup>
import Dropdown from "@/components/helper/dropdown/dropdown";
import {ref, watch} from "vue";
import Error from "@/components/helper/error/error";
// eslint-disable-next-line no-undef,no-unused-vars
const emit = defineEmits(['update:modelValue']);
// eslint-disable-next-line no-unused-vars,no-undef
const props = defineProps({
  label: String,
  placeholder: String,
  styleDropDown: {
    type: Object,
  },
  error: String,
  modelValue: {},
  items: {
    type: Array,
    default() {
      return [
        {
          key: "",
          label: ""
        }
      ]
    }
  }
});

const statusDropDown = ref("");

function getModelValueLabel() {
  if (props.modelValue) {
    return props.items.filter(e => e.key === props.modelValue)[0].label;
  }
  return ""
}

const chosenText = ref(getModelValueLabel());
watch(() => props.modelValue, () => {
  chosenText.value = getModelValueLabel();
})

// eslint-disable-next-line no-unused-vars

function selectItem(item) {
  emit('update:modelValue', item.key);
  chosenText.value = item.label;
  statusDropDown.value = "";
}
</script>