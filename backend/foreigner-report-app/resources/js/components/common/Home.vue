<template>
  <div>
    <!-- <ChildHeader v-if="isLoggedIn && role === 'child'"></ChildHeader>
    <ParentHeader v-if="isLoggedIn && role === 'parent'"></ParentHeader>
    <TeacherHeader v-if="isLoggedIn && role === 'teacher'"></TeacherHeader> -->
    <div v-if="isLoggedIn && role === 'child'">
      <router-link v-bind:to="{name: 'child.report'}">
        <button class="btn btn-success">学習のレポート</button>
      </router-link>
      <router-link v-bind:to="{name: 'child.report'}">
        <button class="btn btn-success">これまでの学習記録</button>
      </router-link>
      <router-link v-bind:to="{name: 'child.report'}">
        <button class="btn btn-success">プロフィールを編集する</button>
      </router-link>
      <router-link v-bind:to="{name: 'child.setting'}">
        <button class="btn btn-success">設定</button>
      </router-link>
    </div>
    <div v-if="isLoggedIn && role === 'parent'">
      <router-link v-bind:to="{name: 'parent.report'}">
        <button class="btn btn-success">子供の学習記録を見る</button>
      </router-link>
      <router-link v-bind:to="{name: 'parent.report'}">
        <button class="btn btn-success">指導者とコミュニケーションを行う</button>
      </router-link>
      <router-link v-bind:to="{name: 'parent.report'}">
        <button class="btn btn-success">プロフィールを編集する</button>
      </router-link>
      <router-link v-bind:to="{name: 'parent.report'}">
        <button class="btn btn-success">設定</button>
      </router-link>
    </div>
    <div v-if="isLoggedIn && role === 'teacher'">
      <router-link v-bind:to="{name: 'teacher.report'}">
        <button class="btn btn-success">子供の学習記録を見る</button>
      </router-link>
      <router-link v-bind:to="{name: 'teacher.report'}">
        <button class="btn btn-success">指導者とコミュニケーションを行う</button>
      </router-link>
      <router-link v-bind:to="{name: 'teacher.report'}">
        <button class="btn btn-success">プロフィールを編集する</button>
      </router-link>
      <router-link v-bind:to="{name: 'teacher.report'}">
        <button class="btn btn-success">設定</button>
      </router-link>
    </div>
  </div>
</template>

<script>
 import ChildHeader from '../child/ChildHeader.vue';
 import ParentHeader from '../parent/ParentHeader.vue';
 import TeacherHeader from '../teacher/TeacherHeader.vue';
 import Index from '../../store/index.js';
 
 export default {
   components: {
     ChildHeader,
     ParentHeader,
     TeacherHeader,
     Index
   },
   computed: {
    //  user() {
    //    console.log('ユーザーチェック')
    //    return this.$store.getters.state
    //  },
     isLoggedIn() {
       return this.$store.getters['auth/check']
     },
     role() {
       return this.$store.getters['auth/role']
     }
   }
 };
</script>
