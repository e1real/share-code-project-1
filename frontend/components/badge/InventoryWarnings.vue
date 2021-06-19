<template>
  <div class="inventory-warning-wrapper">
    <div class="inventory-warning">
      <div class="inventory-warning__icon">
        <svg
          width="40"
          height="40"
          viewBox="0 0 40 40"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <rect width="40" height="40" rx="8" fill="#EF233C" />
          <path
            d="M20.0003 13.3333L12.667 26H27.3337L20.0003 13.3333ZM20.0003 16L25.0203 24.6667H14.9803L20.0003 16ZM19.3337 18.6667V21.3333H20.667V18.6667H19.3337ZM19.3337 22.6667V24H20.667V22.6667"
            fill="white"
          />
        </svg>
      </div>
      <div class="inventory-warning__text">Warning: 5</div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
.inventory-warning {
  display: flex;
  align-items: center;
  background: rgba(239, 35, 60, 0.1);
  flex-direction: row;
  width: 129px;
  height: 40px;
  border-radius: 8px;

  &__icon {
    background: #00bc8a;
    display: flex;
    border-radius: 8px;
    justify-content: center;
    align-items: center;
    margin-right: 10px;
  }
  &__text {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: 600;
    font-size: 12px;
    line-height: 100%;
    color: #000638;
  }
}
</style>
