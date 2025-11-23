<script lang="ts" setup>

import FolderIcon from "../../assets/Icons/FolderIcon.vue";
import EditIcon from "../../assets/Icons/EditIcon.vue";
import DeleteIcon from "../../assets/Icons/DeleteIcon.vue";
import KeyIcon from "../../assets/Icons/KeyIcon.vue";
import DownloadIcon from "../../assets/Icons/DownloadIcon.vue";

interface FileListItemProps {
  isOwner: boolean
}

withDefaults(defineProps<FileListItemProps>(), {isOwner: false})
</script>

<template>
  <div class="list-item">
    <div class="list-item__start">
      <div class="list-item__icon">
        <FolderIcon/>
      </div>
      <div class="list-item__description">
        <h4>Название</h4>
        <div>@1</div>
      </div>
    </div>
    <div class="list-item__end">
      <button v-if="isOwner" class="icon-btn">
        <DownloadIcon/>
      </button>
      <button v-if="isOwner" class="icon-btn">
        <KeyIcon/>
      </button>
      <button v-if="isOwner" class="icon-btn">
        <EditIcon/>
      </button>
      <button class="icon-btn">
        <DeleteIcon/>
      </button>
    </div>
  </div>
</template>

<style scoped>

</style>