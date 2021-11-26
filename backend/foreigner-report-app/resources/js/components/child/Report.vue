<template>
  <div>
    <div>
      <p>本日の学習記録</p>
    </div>
    <div>
      <p>これまでの学習記録</p>
    </div>
    <div>
      <router-link v-bind:to="{name: 'child.create-report'}">
        <button class="btn btn-success">学習記録を作成する</button>
      </router-link>
    </div>
    <div>
      <button>設定</button>
    </div>
  </div>
</template>

<script>
</script>
