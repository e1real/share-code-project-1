<template>
  <div class="status">
    <div class="status__left">
      <InventoryStatus class="status__left-item status__left-status" />
      <InventoryWarnings class="status__left-item status__left-warning" />
      <InventoryResponse class="status__left-item status__left-response" />
    </div>
    <div class="status__right">
      <div class="status__right-switch">
        <span class="status__right-switch-text">Device status</span>
        <b-switch
          type="is-success"
          :left-label="false"
          class="status__right-switch-check"
        />
      </div>
      <div class="status__right-restart">
        <span class="status__right-restart-text">Restart device</span>
        <svg
          class="inventory-status__right-restart-icon"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M12.0002 4C14.1002 4 16.1002 4.8 17.6002 6.3C20.7002 9.4 20.7002 14.5 17.6002 17.6C15.8002 19.5 13.3001 20.2 10.9002 19.9L11.4002 17.9C13.1002 18.1 14.9002 17.5 16.2002 16.2C18.5002 13.9 18.5002 10.1 16.2002 7.7C15.1002 6.6 13.5002 6 12.0002 6V10.6L7.00015 5.6L12.0002 0.599998V4ZM6.30015 17.6C3.70015 15 3.30015 11 5.10015 7.9L6.60015 9.4C5.50015 11.6 5.90015 14.4 7.80015 16.2C8.30015 16.7 8.90015 17.1 9.60015 17.4L9.00015 19.4C8.00015 19 7.10015 18.4 6.30015 17.6Z"
            fill="white"
          />
        </svg>
      </div>
    </div>
  </div>
</template>
<script>
import InventoryStatus from '@/components/badge/InventoryStatus'
import InventoryWarnings from '@/components/badge/InventoryWarnings'
import InventoryResponse from '@/components/badge/InventoryResponse'

export default {
  components: {
    InventoryStatus,
    InventoryWarnings,
    InventoryResponse,
  },
}
</script>
<style lang="scss" scoped>
.status {
  display: flex;
  margin-top: 23px;

  &__left {
    display: flex;
  }

  &__left-item {
    &:not(:last-child) {
      margin-right: 16px;
    }
  }

  &__right {
    display: flex;
    margin-left: auto;
  }

  &__right-switch {
    display: flex;
    align-items: center;
    padding: 6px 6px 6px 16px;
    width: 228px;
    height: 40px;
    background: #fff;
    border-radius: 8px;
  }

  &__right-switch-check {
    margin-left: auto;
    margin-right: 0;

    ::v-deep > .control-label {
      padding-left: 0;
    }
  }

  &__right-restart {
    display: flex;
    align-items: center;
    padding: 8px 8px 8px 16px;
    height: 40px;
    width: 228px;
    background: #ef233c;
    border-radius: 8px;
    margin-left: 16px;
  }

  &__right-restart-text {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 100%;
    color: #fff;
  }

  &__right-restart-icon {
    margin-left: auto;
  }
}
</style>
