<script lang="ts" setup>

</script>

<template>
  <div class="container-center">
    <form class="form">
      <h3>Вход</h3>
      <div class="form__content">
        <div class="form__field">
          <label for="email">Email</label>
          <input id="email" name="email" placeholder="example@gmail.com" required/>
        </div>
        <div class="form__field">
          <label for="password">Password</label>
          <input id="password" name="password" placeholder="***********" required/>
        </div>
      </div>
      <div class="form__actions">
        <button class="btn-primary">
          Войти
        </button>
        <a class="a_btn btn-outline" href="/signup">
          Регистрация
        </a>
      </div>
    </form>
  </div>
</template>

<style scoped>

</style>