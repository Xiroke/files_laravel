<script lang="ts" setup>

</script>

<template>
  <div class="container-center">
    <form action="">
      <label class="upload-zone">
        <input class="upload-zone__input" multiple required type="file">
        <span>Перетащите сюда файл или кликните по области</span>
      </label>
    </form>
  </div>
</template>

<style scoped>
.upload-zone {
  width: 300px;
  height: 200px;
  border-radius: 20px;
  border: 2px dashed var(--border);
  display: flex;
  justify-content: center;
  align-items: center;
}

.upload-zone span {
  width: 80%;
  text-align: center;
}

.upload-zone__input {
  width: 100%;
  height: 100%;
  display: none;
}
</style>