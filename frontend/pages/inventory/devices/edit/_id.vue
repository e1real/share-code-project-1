<template>
  <div class="page-wrapper">
    <div class="page">
      <PageBreadcrumbs class="page__breadcrumbs" :items="breadcrumbs" />
      <div class="page__page-head page-head">
        <BackButton class="page-head__back-button" />
        <h4 class="page-head__title">Inventory</h4>
      </div>
      <StatusBlock class="page__status-block" />
      <ChartBlock class="page__chart-block" />
      <div class="page__general-row">
        <GeneralBlock class="page__general-block" />
        <PlayingNowBlock class="page__paying-now-block" />
      </div>
      <BlackListBlock class="page__black-list-block" />
      <ScreenBlock class="page__screen-block" />
      <NetworkBlock class="page__network-block" />
      <CameraBlock class="page__camera-block" />
      <div class="page__save-button-wrapper">
        <BaseButton class="page__save-button" label="Save" />
      </div>
    </div>
  </div>
</template>
<script>
import PageBreadcrumbs from '@/components/breadcrumb/PageBreadcrumbs'
import BackButton from '@/components/button/BackButton'
import CameraBlock from '@/components/page-block/device-edit/CameraBlock'
import BaseButton from '@/components/button/BaseButton'
import StatusBlock from '@/components/page-block/device-edit/StatusBlock'
import ChartBlock from '@/components/page-block/device-edit/ChartBlock'
import GeneralBlock from '@/components/page-block/device-edit/GeneralBlock'
import PlayingNowBlock from '@/components/page-block/device-edit/PlayingNowBlock'
import BlackListBlock from '@/components/page-block/device-edit/BlackListBlock'
import ScreenBlock from '@/components/page-block/device-edit/ScreenBlock/Index'
import NetworkBlock from '@/components/page-block/device-edit/NetworkBlock'

export default {
  components: {
    PageBreadcrumbs,
    BackButton,
    StatusBlock,
    ChartBlock,
    GeneralBlock,
    PlayingNowBlock,
    BlackListBlock,
    ScreenBlock,
    NetworkBlock,
    CameraBlock,
    BaseButton,
  },
  data() {
    return {
      breadcrumbs: [
        {
          title: 'Admin',
          to: '/',
        },
        {
          title: 'Devices',
          to: '/',
        },
        {
          title: 'Madaras 30',
          to: '',
        },
      ],
      screenItem: null,
    }
  },
  mounted() {
    this.fetchScreen()
  },
  methods: {
    async fetchScreen() {
      try {
        await this.$api(`/screens/${this.$route.params.id}`)
      } catch (e) {
        window.console.log(e)
      }
    },
  },
}
</script>
<style lang="scss" scoped>
.page-wrapper {
  max-width: 1110px;
  margin: auto;
}

.page {
  padding: 10px 0 182px;

  &__page-head {
    font-family: 'Inter', sans-serif;
    margin-top: 31px;
    align-items: center;
  }

  &__chart-block {
    margin-top: 18px;
  }

  &__general-row {
    display: flex;
    margin-top: 30px;
  }

  &__general-block {
    max-width: 825px;
    margin-right: 32px;
  }

  &__playing-now-block {
    display: block;
  }

  &__black-list-block {
    margin-top: 36px;
  }

  &__screen-block {
    margin-top: 30px;
    width: 1110px;
  }

  &__network-block {
    margin-top: 30px;
    width: 1110px;
    height: 465px;
  }
  &__camera-block {
    margin-top: 30px;
    width: 1110px;
    height: 569px;
  }
  &__save-button-wrapper {
    display: flex;
    width: 100%;
    justify-content: flex-end;
    margin-top: 30px;
  }

  &__save-button {
    min-width: 178px;
  }
}

.page-head {
  display: flex;

  &__back-button {
    margin-right: 16px;
  }

  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }
}
</style>
