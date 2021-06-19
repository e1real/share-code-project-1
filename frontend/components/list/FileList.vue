<template>
  <div class="file-list-wrapper">
    <ul class="file-list">
      <li v-for="(f, index) in fileList" :key="index" class="file-list__item">
        <img
          class="file-list__item-img"
          width="70"
          height="70"
          src="https://via.placeholder.com/70?text=Hello"
          alt="img"
        />
        <div class="file-list__item-info">
          <div class="file-list__item-name">
            {{ f.name }} {{ (f.size / 1024 / 1024).toFixed(1) }} mb
          </div>
          <span
            v-if="f.uploadProgress >= 100"
            class="file-list__item-resolution"
          >
            1080 x 1486
          </span>
          <div v-else class="file-list__item-progress">
            <span
              class="file-list__item-progress-indicator"
              :style="{ width: `${f.uploadProgress}%` }"
            />
            <span class="file-list__item-progress-label">
              {{ f.uploadProgress }}%
            </span>
          </div>
        </div>
        <span class="file-list__item-trashbin">
          <svg
            width="24"
            height="22"
            viewBox="0 0 24 22"
            fill="#778699"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M9 3.50171V4.37502H4V6.12164H5V17.4747C5 17.9379 5.21071 18.3822 5.58579 18.7097C5.96086 19.0373 6.46957 19.2213 7 19.2213H17C17.5304 19.2213 18.0391 19.0373 18.4142 18.7097C18.7893 18.3822 19 17.9379 19 17.4747V6.12164H20V4.37502H15V3.50171H9ZM9 7.86826H11V15.7281H9V7.86826ZM13 7.86826H15V15.7281H13V7.86826Z"
            />
          </svg>
        </span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    fileList: {
      type: Array,
      default: () => [],
    },
  },
}
</script>

<style scoped>
.file-list {
  list-style: none;
  margin: 0;
  padding: 0;
}

.file-list__item {
  display: flex;
  align-items: center;
  padding: 16px 30px;
  border-bottom: 1px solid #d7e1ea;
}

.file-list__item-info {
  margin-left: 30px;
}

.file-list__item-name {
  font-family: 'Inter', sans-serif;
  font-size: 12px;
  line-height: 100%;
  color: #778699;
  margin-bottom: 8px;
}

.file-list__item-resolution {
  background: #f4f7fc;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  padding: 6px 11px;
  align-items: center;
  font-family: 'Inter', sans-serif;
  font-size: 14px;
  line-height: 100%;
  color: #000638;
}

.file-list__item-trashbin {
  margin-left: auto;
}

.file-list__item-trashbin:hover {
  cursor: pointer;
}

.file-list__item-trashbin:hover svg {
  fill: red;
}

.file-list__item-progress {
  position: relative;
  min-width: 300px;
  height: 4px;
  background: #d7e1ea;
  border-radius: 50px;
}

.file-list__item-progress-indicator {
  position: absolute;
  left: 0;
  bottom: 0;
  width: 0;
  height: 4px;
  background: #00c2ff;
  border-radius: 50px;
}

.file-list__item-progress-label {
  position: absolute;
  right: 0;
  bottom: -14px;
  font-family: 'Inter', sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 12px;
  line-height: 100%;
  color: #778699;
}
</style>
