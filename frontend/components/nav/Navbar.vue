<template>
  <b-navbar>
    <template #brand>
      <b-navbar-item tag="router-link" :to="{ path: '/' }">
        <img src="~assets/logo.svg" alt="OOH BOARD" height="28" />
      </b-navbar-item>
    </template>
    <template #start>
      <div class="navbar-start">
        <b-navbar-dropdown label="Campaigns">
          <b-navbar-item tag="router-link" to="/campaigns">
            List
          </b-navbar-item>
        </b-navbar-dropdown>
        <b-navbar-dropdown label="Inventory">
          <b-navbar-item tag="router-link" to="/inventory/devices">
            Devices
          </b-navbar-item>
          <b-navbar-item tag="router-link" to="/inventory/devices-groups">
            Groups
          </b-navbar-item>
          <b-navbar-item tag="router-link" to="/inventory/places">
            Places
          </b-navbar-item>
        </b-navbar-dropdown>
      </div>
    </template>
    <template #end>
      <b-navbar-item tag="div">
        <div class="buttons">
          <a class="button is-primary">
            <strong>Sign up</strong>
          </a>
          <a class="button is-light"> Log in </a>
        </div>
      </b-navbar-item>
    </template>
  </b-navbar>
</template>
<style lang="scss">
.navbar {
  min-height: 68px !important;
  padding: 0 16px;
}

.navbar-start {
  padding: 0 26px;
}

.navbar-item {
  font-family: Inter, sans-serif;
  font-style: normal;
  font-weight: 500;
  font-size: 16px;
  line-height: 100%;
  color: #000638;
}

.navbar-link::after {
  border-color: #778699 !important;
  margin-top: -0.375em;
  right: 1.125em;
}
</style>
