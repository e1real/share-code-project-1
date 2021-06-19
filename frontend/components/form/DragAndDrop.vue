<template>
  <div class="drag-and-drop-wrapper">
    <div
      class="drag-and-drop"
      :style="{ backgroundColor }"
      @dragover.prevent="dragover"
      @dragleave="dragleave"
      @drop.prevent="drop"
    >
      <h4 class="drag-and-drop__title">
        {{ label }}
      </h4>
      <span class="drag-and-drop__title-or">or</span>
      <button class="drag-and-drop__btn-browse">
        <input
          ref="file"
          type="file"
          class="drag-and-drop__input"
          multiple
          @change="onChange"
        />
        Browse files
      </button>
      <!--      <div v-if="fileList.length" class="filelist">-->
      <!--        <div v-for="(f, index) in fileList" :key="index" class="filelist__item">-->
      <!--          {{ f.name }}-->
      <!--        </div>-->
      <!--      </div>-->
    </div>
  </div>
</template>

<script>
export default {
  name: 'DragAndDrop',
  model: {
    prop: 'fileList',
    event: 'change',
  },
  props: {
    fileList: {
      type: Array,
      default: () => [],
    },
    backgroundColor: {
      type: String,
      default: '#f4f7fc',
    },
    label: {
      type: String,
      default: 'Drag & Drop files',
    },
    /**
     * Append files if exist
     */
    appendMode: {
      type: Boolean,
      default: true,
    },
  },
  emits: ['change'],
  methods: {
    onChange() {
      const files = [...this.$refs.file.files].map((file) => ({
        file,
        progress: 0,
        url: '',
      }))
      if (this.appendMode && this.fileList.length) {
        this.$emit('change', [...files, ...this.fileList])
      } else {
        this.$emit('change', files)
      }
    },
    dragover(event) {
      if (!event.currentTarget.classList.contains('drag-and-drop--over')) {
        event.currentTarget.classList.add('drag-and-drop--over')
        event.currentTarget.classList.remove('drag-and-drop--droped')
      }
    },
    dragleave(event) {
      event.currentTarget.classList.remove('drag-and-drop--over')
    },
    drop(event) {
      this.$refs.file.files = event.dataTransfer.files
      this.onChange()
      event.currentTarget.classList.remove('drag-and-drop--droped')

      // Clean up
      event.currentTarget.classList.remove('drag-and-drop--over')
    },
  },
}
</script>
<style lang="scss" scoped>
.drag-and-drop-wrapper {
  width: 100%;
}

.drag-and-drop {
  width: 100%;
  height: 100%;
  border: 2px dashed #d7e1ea;
  box-sizing: border-box;
  border-radius: 8px;
  display: flex;
  flex: 1;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.drag-and-drop__title {
  font-family: 'Inter', sans-serif;
  font-style: normal;
  font-weight: bold;
  font-size: 20px;
  line-height: 100%;
  color: #000638;
  margin: 0;
}

.drag-and-drop__title-or {
  font-family: 'Inter', sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 14px;
  line-height: 100%;
  text-align: center;
  color: #000638;
  margin: 12px 0;
}

.drag-and-drop__btn-browse {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 12px 15px;
  background: #000638;
  border-radius: 8px;
  height: 38px;
  font-family: 'Inter', sans-serif;
  font-style: normal;
  font-weight: 500;
  font-size: 14px;
  line-height: 100%;
  text-align: center;
  color: #fff;
  border: 0;
}

.drag-and-drop__btn-browse:focus {
  outline: none;
}

.drag-and-drop__input {
  cursor: pointer;
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  opacity: 0;
  z-index: 1 !important;
}

.drag-and-drop--over {
  padding: 16px;
  border-style: solid;
}

.drag-and-drop--droped {
  border-style: solid;
}

.filelist {
  &__item {
    font-size: 12px;
    max-width: 220px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
}
</style>
