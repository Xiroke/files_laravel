<script lang="ts" setup>

</script>

<template>
  <div class="container-center">
    <form class="form">
      <h3>Редактирование файла</h3>
      <div class="form__content">
        <div class="form__field">
          <label for="filename">Название файла</label>
          <input id="filename" name="filename" placeholder="Новый файл" required/>
        </div>
      </div>
      <div class="form__actions">
        <button class="btn-primary">
          Изменить
        </button>
        <a class="a_btn btn-outline" href="#">
          Отмена
        </a>
      </div>
    </form>
  </div>
</template>

<style scoped>

</style>