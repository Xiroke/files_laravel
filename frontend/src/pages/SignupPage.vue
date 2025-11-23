<script lang="ts" setup>

</script>

<template>
  <div class="container-center">
    <form class="form">
      <h3>Регистрация</h3>
      <div class="form__content">
        <div class="form__field">
          <label for="name">Name</label>
          <input id="name" name="name" placeholder="example@gmail.com" required/>
        </div>
        <div class="form__field">
          <label for="email">Email</label>
          <input id="email" name="email" placeholder="example@gmail.com" required/>
        </div>
        <div class="form__field">
          <label for="password">Password</label>
          <input id="password" name="password" placeholder="***********" required/>
        </div>
        <div class="form__field">
          <label for="password_confirmation ">Password</label>
          <input id="password_confirmation " name="password_confirmation " placeholder="example@gmail.com" required/>
        </div>
      </div>
      <div class="form__actions">
        <button class="btn-primary">
          Регистрация
        </button>
        <a class="a_btn btn-outline" href="/login">
          Войти
        </a>
      </div>
    </form>
  </div>
</template>

<style scoped>

</style>