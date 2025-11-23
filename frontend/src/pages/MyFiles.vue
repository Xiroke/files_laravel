<script lang="ts" setup>

import MyFileListItem from "../components/File/FileListItem.vue";
import {useRoute} from "vue-router";

const route = useRoute()
const filesType: 'me | granted' = route.params.type

const filesData = {
  'me': {
    title: 'Мои файлы',
    isOwner: true
  },
  'granted': {
    title: 'Доступные файлы',
    isOwner: false
  }
}[filesType]
</script>

<template>
  <div class="list-items-page">
    <h2>{{ filesData.title }}</h2>
    <div class="list-items">
      <MyFileListItem :is-owner="filesData.isOwner"/>
      <MyFileListItem :is-owner="filesData.isOwner"/>
      <MyFileListItem :is-owner="filesData.isOwner"/>
      <MyFileListItem :is-owner="filesData.isOwner"/>
      <MyFileListItem :is-owner="filesData.isOwner"/>
    </div>
  </div>
</template>

<style scoped>

</style>