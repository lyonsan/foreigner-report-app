<template>
  <div class="container-fluid">
    <div class="container">
      <nav>
        <div>
          <p>ロール：子供</p>
        </div>
      </nav>
    </div>
    <div>
      <router-link v-bind:to="{name: 'child.main'}">
        <button class="btn btn-success">メインページへ</button>
      </router-link>
      <router-link v-bind:to="{name: 'child.report'}">
        <button class="btn btn-success">学習のレポート</button>
      </router-link>
    </div>
  </div>
</template>