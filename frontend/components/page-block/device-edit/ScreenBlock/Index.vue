<template>
  <div class="screen-block">
    <ScreenFormBlock class="screen-block__screen-form" />
    <LayoutAndResolutionBlock class="screen-block__layout-resolution" />
    <FrameBlock class="screen-block__frame" />
    <VideoBlock class="screen-block__video-block" />
    <AudioBlock class="screen-block__audio-block" />
  </div>
</template>
<script>
import ScreenFormBlock from './ScreenFormBlock'
import LayoutAndResolutionBlock from './LayoutAndResolutionBlock'
import FrameBlock from './FrameBlock'
import VideoBlock from './VideoBlock'
import AudioBlock from './AudioBlock'

export default {
  components: {
    ScreenFormBlock,
    LayoutAndResolutionBlock,
    FrameBlock,
    VideoBlock,
    AudioBlock,
  },
}
</script>
<style lang="scss" scoped>
.screen-block {
  background: #fff;
  border: 1px solid #fff;
  box-sizing: border-box;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
  border-radius: 8px;
  padding: 30px;
  margin-top: 30px;

  &__screen-type-row {
    display: flex;
  }

  &__layout-resolution {
    margin-top: 56px;
  }

  &__frame,
  &__video-block,
  &__audio-block {
    margin-top: 60px;
  }
}
</style>
