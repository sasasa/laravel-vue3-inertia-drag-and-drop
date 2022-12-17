<script setup>
import { ref, watch, defineProps } from "vue";
const props = defineProps({
    "flash": Object,
})
const showFlash = ref(false);
watch(() => props.flash, (to, from) => {
  if(props.flash) {
    showFlash.value = true;
    setTimeout(() => {
      showFlash.value = false
    }, 2000)
  }
});
</script>

<template>
  <div v-show="showFlash">
    <div v-if="props.flash.status == 'success'" class="bg-blue-300 text-white p-4">
      {{ props.flash.message }}
    </div>
    <div v-else-if="props.flash.status == 'danger'" class="bg-red-300 text-white p-4">
      {{ props.flash.message }}
    </div>
  </div>

</template>