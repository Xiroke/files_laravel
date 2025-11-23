<script lang="ts" setup>


import UserListItem from "../components/UserListItem.vue";
import CloseIcon from "../assets/Icons/CloseIcon.vue";
</script>

<template>
  <div class="list-items-page">
    <div class="file-permissions__form">
      <div class="file-permissions__form__top">
        <button class="icon-btn file-permissions__close">
          <CloseIcon/>
        </button>
        <h2>Список пользователей имеющих доступ</h2></div>
      <form class="form">
        <h3>Выдача прав</h3>
        <div class="form__content">
          <div class="form__field">
            <label for="email">Email</label>
            <input id="email" name="email" placeholder="example@gmail.com" required/>
          </div>
        </div>
        <div class="form__actions">
          <button class="btn-primary">
            Выдать права
          </button>
        </div>
      </form>
    </div>
    <div class="list-items">
      <UserListItem/>
      <UserListItem/>
      <UserListItem/>
      <UserListItem/>
      <UserListItem/>
    </div>
  </div>
</template>

<style scoped>
.file-permissions__close {
  width: 40px;
  height: 40px;
}

.file-permissions__form {
  display: flex;
  flex-direction: column;
  gap: 32px;
  align-items: end;
}

.file-permissions__form__top {
  display: flex;
  gap: 24px;
}

.file-permissions__form h2 {
  max-width: 300px;
}
</style>