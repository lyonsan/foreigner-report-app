<template>
  <div class="container-fluid">
    <div class="container">
      <nav class="navbar">
        <div>
          <p>ロール：保護者</p>
          <router-link v-bind:to="{name: 'parent.main'}">
            <button class="btn btn-success">Main</button>
          </router-link>
          <router-link v-bind:to="{name: 'parent.report'}">
            <button class="btn btn-success">Report</button>
          </router-link>
          <router-link v-bind:to="{name: 'parent.communicate'}">
            <button class="btn btn-success">Communication</button>
          </router-link>
        </div>
      </nav>
    </div>
  </div>
</template>