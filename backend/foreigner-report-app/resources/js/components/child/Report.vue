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
    <div>
      <ul v-for='report in reports'>
          <li>
              {{ report.study_content }}
              {{ motivation_list[report.motivation] }}
              {{ report.note }}
              <ul>
                  <li v-for="subject in report.m_subjects">{{ subject.subject_name }}</li>
              </ul>
              <ul>
                  <li v-for="text_info in report.text_infos">{{ text_info.text_name }}</li>
              </ul>
          </li>
      </ul>
    </div>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        reports: null,
        user_id: null,
        motivation_list: null
      }
    },
    created() {
      this.user_id = this.$store.getters['auth/id']
    },
    mounted() {
      axios.get('/api/get-motivation-config')
      .then(function (response) {
        this.motivation_list = response.data.motivation
      }.bind(this))
      axios.get('/api/get-report', {
        params: {
          userId: this.user_id
        }
      })
      .then(function (response) {
        console.log(response.data.reports)
        this.reports = response.data.reports
      }.bind(this));
    }
  }
</script>
