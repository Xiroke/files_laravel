<script lang="ts" setup>
import type {LabelHTMLAttributes} from "vue";
import Label from "./Label.vue";

interface LabelProps extends /* @vue-ignore */ LabelHTMLAttributes {

}

defineProps<LabelProps>()
</script>

<template>
  <label class="label" v-bind="$attrs">
    <slot/>
  </label>
</template>

<style scoped>

</style>