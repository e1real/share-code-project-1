<template>
  <div class="upload-wrapper">
    <div class="upload">
      <DragAndDrop
        v-model="uploadFileList"
        class="upload__image-ddrop"
        background-color="#fff"
        label="Drop image to upload"
        @change="handleChangeDragAndDrop"
      />
      <div class="upload__title">
        <h4>Upload a photo of the place.</h4>
        <h5 class="upload__subtitle">
          Drag and drop or direct upload your photo of place.
        </h5>
        <div class="upload__allowed">
          <h4 class="upload__title-allowed">Allowed fotmats:</h4>
          <div class="upload__format">
            <span class="upload__format-left">.jpg</span>
            <span class="upload__format-rigth">.png</span>
          </div>
          <div class="upload__file-size">
            <h4 class="upload__file-size-title">File size:</h4>
            <h4 class="upload__file-size-subtitle">Max 10 MB</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="upload__images-list-wrapper">
      <h4
        v-show="uploadFileList.length || photos.length"
        class="upload__images-list-title"
      >
        Uploaded image list
      </h4>
      <div class="upload__images-list images-list">
        <div
          v-for="(file, index) in photos"
          :key="index + 'photo'"
          class="images-list__item"
        >
          <img :src="getFileUrl(file.url)" class="images-list__item-img" />
          <a
            href="#"
            class="images-list__item-close"
            @click.prevent="$emit('delete', index)"
          ></a>
          <!--          <b-progress-->
          <!--            :value="file.progress"-->
          <!--            show-value-->
          <!--            format="percent"-->
          <!--          ></b-progress>-->
        </div>
      </div>
    </div>
    <hr class="upload__hr" />
  </div>
</template>

<script>
import DragAndDrop from '~/components/form/DragAndDrop'

export default {
  components: {
    DragAndDrop,
  },
  model: {
    prop: 'photos',
    event: 'upload-complete',
  },
  props: {
    photos: {
      type: Array,
      required: true,
    },
    placeId: {
      type: [String],
      required: true,
    },
  },
  data() {
    return {
      uploadFileList: [],
    }
  },
  methods: {
    /**
     * Change event input drag and drop
     */
    handleChangeDragAndDrop() {
      this.uploadFileList.forEach((file, index) => {
        this.uploadFile(file, index)
      })
    },
    /**
     * Upload file to API
     * @param file
     * @param index
     * @return {Promise<void>}
     */
    async uploadFile(file, index) {
      const formData = new FormData()
      formData.append('photo', file.file)
      formData.append('place_id', this.placeId)
      try {
        const { data } = await this.$api.post('place-photos', formData, {
          onUploadProgress: (progressEvent) => {
            this.uploadFileList[index].progress = Math.floor(
              (progressEvent.loaded * 100) / progressEvent.total
            )
          },
        })
        this.$emit('upload-complete', data)
      } catch (e) {
        this.uploadFileList.splice(index, 1)
      }
    },
    /**
     * Get file url
     * @param url
     */
    getFileUrl(url) {
      return process.env.API_URL_BROWSER_BASE + url
    },
  },
}
</script>

<style lang="scss" scoped>
.upload {
  &__image-ddrop {
    width: 250px;
    height: 200px;
  }

  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 16px;
    line-height: 100%;
    color: #000638;
    margin-left: 29px;
  }

  &__subtitle {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 125%;
    color: #778699;
    width: 283px;
    height: 40px;
    margin-top: 6px;
  }

  &__allowed {
    display: flex;
    flex-direction: column;
    margin-top: 24px;
    font-weight: normal;
  }

  &__format {
    display: flex;
    flex-direction: row;
  }

  &__format-left {
    width: 37px;
    height: 22px;
    border: 1px solid #d7e1ea;
    box-sizing: border-box;
    border-radius: 4px;
    padding: 4px 6px;
    font-size: 12px;
    margin-top: 8px;
  }

  &__format-rigth {
    width: 37px;
    height: 22px;
    border: 1px solid #d7e1ea;
    box-sizing: border-box;
    border-radius: 4px;
    margin-left: 20px;
    margin-top: 8px;
    font-size: 12px;
    padding: 4px 6px 4px;
  }

  &__file-size {
    margin-top: 20px;
    display: flex;
    flex-direction: row;
  }

  &__hr {
    width: calc(100% + 60px);
    height: 1px;
    left: 0;
    top: 260px;
    background: #d7e1ea;
    margin: 30px 0 30px -30px;
  }

  &__file-size-title {
    font-weight: bold;
  }

  &__file-size-subtitle {
    font-weight: normal;
    margin-left: 4px;
  }

  &__images-list-title {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 22px;
    line-height: 100%;
    margin: 26px 0 14px;
  }

  &__images-list {
    margin-bottom: 20px;
  }
}

.images-list {
  display: grid;
  grid-gap: 10px;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));

  &__item {
    display: flex;
    flex-direction: column;
    position: relative;
    width: 150px;
    height: 166px;
    border: 1px solid lightblue;
  }

  &__item-img {
    width: 100%;
    height: 150px;
  }

  &__item-close {
    position: absolute;
    right: 4px;
    top: 4px;
    width: 30px;
    height: 24px;
    opacity: 0.3;

    &:hover {
      opacity: 1;
    }
    &::before,
    &::after {
      position: absolute;
      left: 15px;
      content: ' ';
      height: 24px;
      width: 2px;
      background-color: #333;
    }
    &::before {
      transform: rotate(45deg);
    }
    &::after {
      transform: rotate(-45deg);
    }
  }
}
</style>
