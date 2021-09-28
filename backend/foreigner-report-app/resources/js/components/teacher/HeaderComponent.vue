<template>
  <div class="container-fluid">
    <div class="container">
      <nav class="navbar">
        <div>
          <p>ロール：指導者</p>
          <router-link v-bind:to="{name: 'teacher.main'}">
            <button class="btn btn-success">Main</button>
          </router-link>
          <router-link v-bind:to="{name: 'teacher.report'}">
            <button class="btn btn-success">Report</button>
          </router-link>
          <router-link v-bind:to="{name: 'teacher.communicate'}">
            <button class="btn btn-success">Communication</button>
          </router-link>
        </div>
      </nav>
    </div>
  </div>
</template>