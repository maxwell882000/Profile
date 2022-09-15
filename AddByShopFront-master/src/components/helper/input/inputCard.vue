<template>
  <div class="bg-white p-4 shadow-box ">
    <InputBelowBorder @input="filterAndEmitCardNumber" :value="card_input" class="w-100" :placeholder="$t('Номер карты')"/>
    <error :error="error_card"></error>
    <br>
    <div class="w-30">
      <input-below-border class="w-100" @input="filterAndEmitExpiry" :value="expiry"
                          placeholder="ММ/ГГ"></input-below-border>
    </div>
    <error :error="error_expiry"></error>
  </div>
</template>
<script setup>
import InputBelowBorder from "@/components/helper/input/inputBelowBorder";
import Error from "@/components/helper/error/error";
import only_numbers from "@/mixins/only_numbers";
import remove_space from "@/mixins/remove_space";

// eslint-disable-next-line no-undef
const emit = defineEmits(['card-input', 'expiry-input'])
// eslint-disable-next-line no-undef,no-unused-vars
const props = defineProps(['error_card', 'error_expiry', 'card_input', "expiry"]);


function filterAndEmitCardNumber(event) {
  // we could remove space after condition because checking happens against current character inserted
  // event.target.value = "";
  const v = remove_space(event.target.value).replace(/[^0-9]/gi, ''); // remove space and letters
  const matches = v.match(/\d{4,16}/g); // gives range
  const match = matches && matches[0] || ''; // choose only first items in array
  // item in array must have minimum four items because of regexp
  const parts = [];
  for (let i = 0, len = match.length; i < len; i += 4) {
    parts.push(match.substring(i, i + 4))
  }
  // if there is nothing initial value would be returned
  if (parts.length) {
    event.target.value = parts.join(' ')
  } else {
    only_numbers(event);
  }
  emit('card-input', event.target.value);
}


function filterAndEmitExpiry(event) {
  const v = remove_space(event.target.value).replace(/[^0-9]/gi, '');
  const afterMatch = v.match(/\d{1,2}/g);
  if (afterMatch) {
    event.target.value = afterMatch.slice(0, 2).join('/');
    emit('expiry-input', event.target.value);
  }
}

</script>