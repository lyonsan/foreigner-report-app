<template>
  <div>
    <ChildHeader v-if="isLoggedIn && role === 'child'"></ChildHeader>
    <ParentHeader v-if="isLoggedIn && role === 'parent'"></ParentHeader>
    <TeacherHeader v-if="isLoggedIn && role === 'teacher'"></TeacherHeader>
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
