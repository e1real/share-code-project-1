<template>
  <div class="page-wrapper">
    <div class="page">
      <PageBreadcrumbs class="page__breadcrumbs" :items="breadcrumbs" />
      <div class="page__page-head page-head">
        <h4 class="page-head__title">Campaigns</h4>
      </div>
      <form
        class="page__content campaign-create-content"
        @submit.prevent="submit"
      >
        <div class="campaign-create-content__main main-block">
          <VInput
            v-model="form.name"
            class="main-block__input"
            label="Campaign name"
            :errors="formErrors.name"
            @keydown="formErrors.name = ''"
          />

          <VInput
            v-model="form.client_name"
            class="main-block__input"
            label="Client name"
            :errors="formErrors.client_name"
            @keydown="formErrors.client_name = ''"
          />
          <VAutoCompleteV2
            v-model="screenAutocompleteValue"
            top-label="Screens"
            class="main-block__input"
            :response-data="screenAutocompleteData"
            :is-loading="screenAutocompleteDataLoading"
            @input="handleInputScreenAutocomplete"
            @click-item="handleClickItemScreenAutocomplete"
          />

          <GroupAutoCompleteTags
            v-show="form.screens.length"
            top-label="Screens"
            class="main-block__input"
            :items="form.screens"
            @remove="handleClickRemoveItem"
          />

          <GroupAutoCompleteTags
            v-show="form.screen_groups.length"
            top-label="Groups"
            class="main-block__input"
            :items="form.screen_groups"
            @remove="handleClickRemoveItem"
          />

          <GroupAutoCompleteTags
            v-show="form.places.length"
            top-label="Places"
            class="main-block__input"
            :items="form.places"
            @remove="handleClickRemoveItem"
          />
        </div>

        <div class="campaign-create-content__summary summary-block">
          <h4 class="summary-block__title">Summary</h4>
          <ul class="summary-block__stats summary-stats">
            <li class="summary-stats__item">
              <div class="summary-stats__item-left">
                <span class="summary-stats__item-left-icon-wrapper">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M21 16H3V4H21V16ZM21 2H3C1.89 2 1 2.89 1 4V16C1 16.5304 1.21071 17.0391 1.58579 17.4142C1.96086 17.7893 2.46957 18 3 18H10V20H8V22H16V20H14V18H21C21.5304 18 22.0391 17.7893 22.4142 17.4142C22.7893 17.0391 23 16.5304 23 16V4C23 2.89 22.1 2 21 2Z"
                      fill="#778699"
                    />
                  </svg>
                </span>
              </div>
              <div class="summary-stats__item-right">
                <span class="summary-stats__item-right-title">Scrrens</span>
                <span class="summary-stats__item-right-count">
                  {{ chosenAutocompleteScreenCount }}
                </span>
              </div>
            </li>
            <li class="summary-stats__item">
              <div class="summary-stats__item-left">
                <span class="summary-stats__item-left-icon-wrapper">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="#778699"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M11.5 9C11.5 7.62 12.62 6.5 14 6.5C15.1 6.5 16.03 7.21 16.37 8.19C16.45 8.45 16.5 8.72 16.5 9C16.5 10.38 15.38 11.5 14 11.5C12.91 11.5 12 10.81 11.64 9.84C11.55 9.58 11.5 9.29 11.5 9ZM5 9C5 13.5 10.08 19.66 11 20.81L10 22C10 22 3 14.25 3 9C3 5.83 5.11 3.15 8 2.29C6.16 3.94 5 6.33 5 9ZM14 2C17.86 2 21 5.13 21 9C21 14.25 14 22 14 22C14 22 7 14.25 7 9C7 5.13 10.14 2 14 2ZM14 4C11.24 4 9 6.24 9 9C9 10 9 12 14 18.71C19 12 19 10 19 9C19 6.24 16.76 4 14 4Z"
                    />
                  </svg>
                </span>
              </div>
              <div class="summary-stats__item-right">
                <span class="summary-stats__item-right-title">Locations</span>
                <span class="summary-stats__item-right-count">
                  {{ this.form.places.length }}
                </span>
              </div>
            </li>
            <li class="summary-stats__item">
              <div class="summary-stats__item-left">
                <span class="summary-stats__item-left-icon-wrapper">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M12 9C12.7956 9 13.5587 9.31607 14.1213 9.87868C14.6839 10.4413 15 11.2044 15 12C15 12.7956 14.6839 13.5587 14.1213 14.1213C13.5587 14.6839 12.7956 15 12 15C11.2044 15 10.4413 14.6839 9.87868 14.1213C9.31607 13.5587 9 12.7956 9 12C9 11.2044 9.31607 10.4413 9.87868 9.87868C10.4413 9.31607 11.2044 9 12 9ZM12 4.5C17 4.5 21.27 7.61 23 12C21.27 16.39 17 19.5 12 19.5C7 19.5 2.73 16.39 1 12C2.73 7.61 7 4.5 12 4.5ZM3.18 12C4.83 15.36 8.24 17.5 12 17.5C15.76 17.5 19.17 15.36 20.82 12C19.17 8.64 15.76 6.5 12 6.5C8.24 6.5 4.83 8.64 3.18 12Z"
                      fill="#778699"
                    />
                  </svg>
                </span>
              </div>
              <div class="summary-stats__item-right">
                <span class="summary-stats__item-right-title">Impressions</span>
                <span class="summary-stats__item-right-count">
                  {{ form.impressions_frequency }}
                </span>
              </div>
            </li>
            <li class="summary-stats__item">
              <div class="summary-stats__item-left">
                <span class="summary-stats__item-left-icon-wrapper">
                  <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M7 12H9V14H7V12ZM21 6V20C21 20.5304 20.7893 21.0391 20.4142 21.4142C20.0391 21.7893 19.5304 22 19 22H5C3.89 22 3 21.1 3 20V6C3 5.46957 3.21071 4.96086 3.58579 4.58579C3.96086 4.21071 4.46957 4 5 4H6V2H8V4H16V2H18V4H19C19.5304 4 20.0391 4.21071 20.4142 4.58579C20.7893 4.96086 21 5.46957 21 6ZM5 8H19V6H5V8ZM19 20V10H5V20H19ZM15 14V12H17V14H15ZM11 14V12H13V14H11ZM7 16H9V18H7V16ZM15 18V16H17V18H15ZM11 18V16H13V18H11Z"
                      fill="#778699"
                    />
                  </svg>
                </span>
              </div>
              <div class="summary-stats__item-right">
                <span class="summary-stats__item-right-title">Days</span>
                <span class="summary-stats__item-right-count">{{
                  scheduleDateDiff
                }}</span>
              </div>
            </li>
          </ul>
        </div>

        <div class="campaign-create-content__schedule schedule-block">
          <h4 class="schedule-block__title">Schedule</h4>
          <div class="schedule-block__date-ranges">
            <VDatePicker
              v-model="form.start_date"
              class="schedule-block__date-start"
              label="Start date"
            />
            <span class="schedule-block__date-delimiter">-</span>
            <VDatePicker
              v-model="form.end_date"
              class="schedule-block__date_end"
              label="End date"
              :min-date="form.start_date"
              :errors="formErrors.end_date"
              @keydown="formErrors.end_date = ''"
            />
          </div>
        </div>
        <div
          class="
            campaign-create-content__impressions-frequency
            impressions-frequency-block
          "
        >
          <h4 class="impressions-frequency-block__title">
            Impressions frequency
          </h4>
          <VPlusMinusInput
            v-model="form.impressions_frequency"
            class="impressions-frequency-block__input"
            :min="1"
            :max="10"
          />
          <span>per day</span>
        </div>

        <div class="campaign-create-content__content content-block">
          <h4 class="content-block__title">Content</h4>

          <table class="content-block__table content-block-table">
            <tr class="content-block-table__head-row">
              <th>Resolution</th>
              <th>Assigned pictures</th>
              <th>Screens Count</th>
            </tr>
            <tr class="content-block-table__row">
              <td class="content-block-table__item-wrapper">
                <div class="content-block-table__item">
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="content-block-table__item-check"
                  >
                    <path
                      d="M13.9997 4.66668L5.99967 12.6667L2.33301 9.00002L3.27301 8.06002L5.99967 10.78L13.0597 3.72668L13.9997 4.66668Z"
                      fill="#00BC8A"
                    />
                  </svg>
                  <span>1408 x 400</span>
                </div>
              </td>
              <td class="content-block-table__item-wrapper">2</td>
              <td class="content-block-table__item-wrapper">
                <div class="content-block-table__item">
                  <svg
                    width="16"
                    height="16"
                    viewBox="0 0 16 16"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="content-block-table__item-screen"
                  >
                    <path
                      d="M14.0003 10.6667H2.00033V2.66671H14.0003V10.6667ZM14.0003 1.33337H2.00033C1.26033 1.33337 0.666992 1.92671 0.666992 2.66671V10.6667C0.666992 11.0203 0.807468 11.3595 1.05752 11.6095C1.30756 11.8596 1.6467 12 2.00033 12H6.66699V13.3334H5.33366V14.6667H10.667V13.3334H9.33366V12H14.0003C14.3539 12 14.6931 11.8596 14.9431 11.6095C15.1932 11.3595 15.3337 11.0203 15.3337 10.6667V2.66671C15.3337 1.92671 14.7337 1.33337 14.0003 1.33337Z"
                      fill="#00BC8A"
                    />
                  </svg>
                  <span>2</span>
                </div>
              </td>
            </tr>
          </table>

          <DragAndDrop
            v-model="fileListForm"
            class="content-block__file-upload"
            @change="handleChangeDragAndDrop"
          />

          <FileList :file-list="fileList" />
        </div>

        <div class="campaign-create-content__buttons campaign-create-buttons">
          <BaseButton
            class="campaign-create-buttons__cancel"
            label="Cancel"
            variant="secondary"
            @click="$router.back()"
          />
          <BaseButton
            class="campaign-create-buttons__create"
            label="Start"
            type="submit"
            :disabled="formLoading"
          />
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import PageBreadcrumbs from '~/components/breadcrumb/PageBreadcrumbs'
import VInput from '~/components/form/VInput'
import VDatePicker from '~/components/form/VDatePicker'
import VPlusMinusInput from '~/components/form/VPlusMinusInput'
import DragAndDrop from '~/components/form/DragAndDrop'
import FileList from '~/components/list/FileList'
import BaseButton from '~/components/button/BaseButton'
import VAutoCompleteV2 from '~/components/form/VAutoCompleteV2'
import GroupAutoCompleteTags from '~/components/form/GroupAutoCompleteTags'
import { dateFormatToStringYmd } from '~/utils/date'

export default {
  components: {
    PageBreadcrumbs,
    VInput,
    VDatePicker,
    VPlusMinusInput,
    DragAndDrop,
    FileList,
    BaseButton,
    VAutoCompleteV2,
    GroupAutoCompleteTags,
  },
  data() {
    return {
      breadcrumbs: [
        {
          title: 'Home',
          to: '/',
        },
        {
          title: 'Campaigns',
          to: '',
        },
        {
          title: 'Create',
          to: '',
        },
      ],
      fileList: [],
      form: {
        name: '',
        client_name: '',
        screens: [],
        screen_groups: [],
        places: [],
        impressions_frequency: 1,
        start_date: new Date(),
        end_date: undefined,
      },
      formLoading: false,
      formErrors: {
        name: '',
        client_name: '',
        end_date: '',
      },
      fileListForm: [],
      screenAutocompleteValue: '',
      screenAutocompleteData: [],
      screenAutocompleteDataLoading: false,
      screenAutocompleteTypeTimeout: undefined,
    }
  },
  computed: {
    chosenAutocompleteScreenCount() {
      const { form } = this
      const screenIds = []
      form.screens.forEach((value) => {
        if (!screenIds.includes(value.screen_id)) {
          screenIds.push(value.screen_id)
        }
      })
      form.screen_groups.forEach((value) => {
        value.screens.forEach((val) => {
          if (!screenIds.includes(val.screen_id)) {
            screenIds.push(val.screen_id)
          }
        })
      })
      form.places.forEach((value) => {
        value.screens.forEach((val) => {
          if (!screenIds.includes(val.screen_id)) {
            screenIds.push(val.screen_id)
          }
        })
      })

      return screenIds.length
    },
    scheduleDateDiff() {
      const oneDay = 24 * 60 * 60 * 1000
      if (
        typeof this.form.start_date !== 'undefined' &&
        typeof this.form.end_date !== 'undefined'
      ) {
        return Math.round(
          Math.abs((this.form.start_date - this.form.end_date) / oneDay)
        )
      }
      return 0
    },
  },
  methods: {
    dateFormatToStringYmd,
    /**
     * Submit form data
     */
    async submit() {
      this.formLoading = true
      const screenIds = this.form.screens.length
        ? this.form.screens.map((el) => el.id)
        : []
      const screenGroupIds = this.form.screen_groups.length
        ? this.form.screen_groups.map((el) => el.id)
        : []
      const placeIds = this.form.places.length
        ? this.form.places.map((el) => el.id)
        : []

      const payload = {
        name: this.form.name,
        client_name: this.form.client_name,
        screens: screenIds,
        screen_groups: screenGroupIds,
        places: placeIds,
        impressions_frequency: this.form.impressions_frequency,
        start_date: this.form.start_date
          ? this.dateFormatToStringYmd(this.form.start_date)
          : undefined,
        end_date: this.form.end_date
          ? this.dateFormatToStringYmd(this.form.end_date)
          : undefined,
      }
      try {
        await this.$api.post('campaigns', payload)
        await this.$router.push('/campaigns')
      } catch (err) {
        if (err.response.status === 422) {
          for (const field in err.response.data.errors) {
            if (typeof this.formErrors[field] !== 'undefined') {
              this.formErrors[field] = err.response.data.errors[field][0]
            }
          }
          window.scroll({
            top: 0,
            left: 0,
            behavior: 'smooth',
          })
        }
      }
      this.formLoading = false
    },
    /**
     * File chose handler
     */
    handleChangeDragAndDrop() {
      this.fileListForm.forEach((file, index) => {
        this.uploadMedia(file)
        this.fileListForm.splice(index, 1)
      })
    },
    /**
     * Upload file to API
     * @param file
     */
    async uploadMedia(file) {
      const formData = new FormData()
      formData.append('media', file)

      this.fileList.push({
        name: file.name,
        size: file.size,
        uploadProgress: -1,
      })

      const config = {
        headers: {
          'Content-Type': 'multipart/form-data',
        },
        onUploadProgress: (progressEvent) => {
          this.fileList[this.fileList.length - 1].uploadProgress = Math.round(
            (progressEvent.loaded * 100) / progressEvent.total
          )
        },
      }
      try {
        await this.$api.post('media', formData, config)
      } catch (e) {}
    },
    /**
     * On input handler autocomplete
     */
    handleInputScreenAutocomplete(value) {
      if (!value) return
      if (this.screenAutocompleteTypeTimeout) {
        clearTimeout(this.screenAutocompleteTypeTimeout)
      }
      this.screenAutocompleteTypeTimeout = setTimeout(async () => {
        this.screenAutocompleteData = []
        this.screenAutocompleteDataLoading = true

        try {
          const { data } = await this.$api.post(
            `/screens/find-screen?q=${value}`
          )
          data.forEach((v) => {
            const existIndex = this.form[v.type].findIndex(
              (el) => el.id === v.id
            )
            if (existIndex === -1) {
              this.screenAutocompleteData.push(v)
            }
          })
        } catch (e) {
          console.log(e)
        }
        this.screenAutocompleteDataLoading = false
      }, 333)
    },
    /**
     * Screen autocomplete item click handler
     */
    handleClickItemScreenAutocomplete(value) {
      this.form[value.type].push({ ...value })

      const findExist = this.screenAutocompleteData.findIndex(
        (el) => el.id === value.id
      )
      this.$delete(this.screenAutocompleteData, findExist)
    },
    /**
     * Remove item in tags
     */
    handleClickRemoveItem({ item, index }) {
      // set disactive item
      const itemIndex = this.screenAutocompleteData.findIndex(
        (value) => value.type === item.type && item.id === value.id
      )
      if (itemIndex !== -1) {
        this.screenAutocompleteData[itemIndex].exist = false
      }
      this.$delete(this.form[item.type], index)
    },
  },
}
</script>

<style lang="scss" scoped>
%block-title {
  font-family: 'Inter', sans-serif;
  font-weight: bold;
  font-size: 24px;
  line-height: 100%;
  color: #000638;
}

%block-wrapper {
  padding: 30px;
  background: #fff;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
  border-radius: 8px;
}

.page-wrapper {
  padding: 0 20px;
}

.page {
  padding: 10px 0 182px;

  &__page-head {
    margin-top: 37px;
  }

  &__line {
    margin: 30px 0;
    border-top: 1px solid #d7e1ea;
  }

  &__table-pagination {
    margin-top: 24px;
  }

  &__content {
    margin-top: 30px;
  }
}

.page-head {
  display: flex;

  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }
}

.campaign-create-content {
  display: grid;
  grid-template-columns: 1fr 255px;
  grid-gap: 30px;

  &__main {
    @extend %block-wrapper;
  }

  &__summary {
    @extend %block-wrapper;

    position: sticky;
    position: -webkit-sticky;
    top: 60px;
  }

  &__schedule {
    grid-column: 1/2;
    @extend %block-wrapper;
  }

  &__impressions-frequency {
    grid-column: 1/2;
    @extend %block-wrapper;
  }

  &__content {
    grid-column: 1/2;
    @extend %block-wrapper;
  }

  &__buttons {
    grid-column: 1/2;
  }
}

.main-block {
  &__input {
    width: 424px;

    &:not(:last-child) {
      margin-bottom: 16px;
    }
  }
}

.summary-block {
  &__title {
    @extend %block-title;
  }

  &__stats {
    margin-top: 30px;
  }
}

.summary-stats {
  &__item {
    display: flex;
    align-items: center;

    &:not(:last-child) {
      margin-bottom: 16px;
    }
  }

  &__item-left-icon-wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: #f4f7fc;
    border-radius: 8px;
  }

  &__item-right {
    display: flex;
    flex-direction: column;
    margin-left: 12px;
  }

  &__item-right-title {
    font-family: 'Inter', sans-serif;
    font-weight: 500;
    font-size: 11px;
    line-height: 100%;
    color: #778699;
  }

  &__item-right-count {
    font-family: 'Inter', sans-serif;
    font-weight: 500;
    font-size: 16px;
    line-height: 100%;
    color: #000638;
  }
}

.schedule-block {
  &__title {
    @extend %block-title;
  }

  &__date-ranges {
    display: flex;
    align-items: center;
    margin-top: 30px;
  }

  &__date-delimiter {
    margin: 0 4px;
  }
}

.impressions-frequency-block {
  &__title {
    @extend %block-title;
  }

  &__input {
    display: inline-flex;
    min-width: 134px;
    margin-top: 30px;
    margin-right: 11px;
  }
}

.content-block {
  &__title {
    @extend %block-title;
  }

  &__table {
    margin-top: 30px;
  }

  &__file-upload {
    height: 218px;
    margin: 30px 0 12px;
  }
}

.content-block-table {
  width: 100%;

  th,
  td {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 14px;
    line-height: 100%;
    color: #000638;
    padding: 16px;
  }

  &__head-row,
  &__row {
    border-bottom: 1px solid #d7e1ea;
  }

  &__item {
    display: flex;
    align-items: center;
  }

  &__item-check,
  &__item-screen {
    margin-right: 6px;
  }
}

.content-b-pagination {
  &__left-per-page {
    margin: 0 8px;
    height: 33px;
    background: #fff;
    border: 1px solid #edf2f7;
    border-radius: 6px;
  }

  &__left-label {
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    line-height: 15px;
    color: #718096;
  }

  &__right {
    display: flex;
    justify-content: space-between;
    width: 56px;
  }

  &__right-icon-wrapper {
    padding: 6px 8px;
    cursor: pointer;

    &:hover svg {
      fill: #000638;
    }
  }
}

.campaign-create-buttons {
  display: flex;
  justify-content: space-between;

  &__cancel {
    min-width: 111px;
  }

  &__create {
    min-width: 216px;
  }
}
</style>
