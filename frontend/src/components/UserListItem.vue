<script lang="ts" setup>

import AddIcon from "../assets/Icons/AddIcon.vue";
import DeleteIcon from "../assets/Icons/DeleteIcon.vue";
import UserCircleIcon from "../assets/Icons/UserCircleIcon.vue";
</script>

<template>
  <div class="list-item">
    <div class="list-item__start">
      <div class="list-item__icon">
        <UserCircleIcon/>
      </div>
      <div class="list-item__description">
        <h4>Полное имя</h4>
        <div>example@email.com</div>
      </div>
    </div>
    <div class="list-item__end">
      <button class="icon-btn">
        <AddIcon/>
      </button>
      <button class="icon-btn">
        <DeleteIcon/>
      </button>
    </div>
  </div>
</template>

<style scoped>

</style>