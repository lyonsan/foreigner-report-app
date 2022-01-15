<template>
  <div>
    <h3>学習記録作成</h3>
    <div class="panel">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form class="form" @submit.prevent="createReport">
                            <div class="form-group row">
                                <label for="study_content" class="col-md-4 col-form-label text-md-right">今日やったこと</label>

                                <div class="col-md-6">
                                    <input id="study_content" type="text" class="form-control @error('study_content') is-invalid @enderror" name="study_content" v-model="postForm.study_content" required autocomplete="study_content" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="subject" class="col-md-4 col-form-label text-md-right">今日やった科目</label>

                                <div class="col-md-6">
                                    <label for="subject1">国語</label>
                                    <input id="subject1" type="checkbox" class="form-control @error('subject1') is-invalid @enderror" name="subject[]" v-model="postForm.subject1" autocomplete="subject1" value="1">

                                    <label for="subject2">算数</label>
                                    <input id="subject1" type="checkbox" class="form-control @error('subject2') is-invalid @enderror" name="subject[]" v-model="postForm.subject2" autocomplete="subject2" value="2">

                                    <label for="subject3">英語</label>
                                    <input id="subject3" type="checkbox" class="form-control @error('subject3') is-invalid @enderror" name="subject[]" v-model="postForm.subject3" autocomplete="subject3" value="3">

                                    <label for="subject4">理科</label>
                                    <input id="subject4" type="checkbox" class="form-control @error('subject4') is-invalid @enderror" name="subject[]" v-model="postForm.subject4" autocomplete="subject4" value="4">

                                    <label for="subject5">社会</label>
                                    <input id="subject5" type="checkbox" class="form-control @error('subject5') is-invalid @enderror" name="subject[]" v-model="postForm.subject5" autocomplete="subject5" value="5">

                                    <label for="subject6">日本語</label>
                                    <input id="subject6" type="checkbox" class="form-control @error('subject6') is-invalid @enderror" name="subject[]" v-model="postForm.subject6" autocomplete="subject6" value="6">

                                    <label for="subject7">その他</label>
                                    <input id="subject7" type="checkbox" class="form-control @error('subject7') is-invalid @enderror" name="subject[]" v-model="postForm.subject7" autocomplete="subject7" value="7">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="text_name_first" class="col-md-4 col-form-label text-md-right">使った教材1</label>

                                <div class="col-md-6">
                                    <input id="text_name_first" type="text" class="form-control @error('text_name_first') is-invalid @enderror" name="text_name_first" v-model="postForm.text_name_first" v-on:input="searchText" autocomplete="text_name_first">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="text_name_second" class="col-md-4 col-form-label text-md-right">使った教材2</label>

                                <div class="col-md-6">
                                    <input id="text_name_second" type="text" class="form-control @error('text_name_second') is-invalid @enderror" name="text_name_second" v-model="postForm.text_name_second" v-on:input="searchText" autocomplete="text_name_second">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="new_text_name_first" class="col-md-4 col-form-label text-md-right">教材の追加1</label>

                                <div class="col-md-6">
                                    <input id="new_text_name_first" type="text" class="form-control @error('new_text_name_first') is-invalid @enderror" name="new_text_name_first" v-model="postForm.new_text_name_first" autocomplete="new_text_name_first">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="new_text_name_second" class="col-md-4 col-form-label text-md-right">教材の追加2</label>

                                <div class="col-md-6">
                                    <input id="new_text_name_second" type="text" class="form-control @error('new_text_name_second') is-invalid @enderror" name="new_text_name_second" v-model="postForm.new_text_name_second" autocomplete="new_text_name_second">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="other_materials" class="col-md-4 col-form-label text-md-right">その他使った教材など</label>

                                <div class="col-md-6">
                                    <input id="other_materials" type="text" class="form-control @error('other_materials') is-invalid @enderror" name="other_materials" v-model="postForm.other_materials" autocomplete="other_materials">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="motivation" class="col-md-4 col-form-label text-md-right">今日の気分</label>

                                <div class="col-md-6">
                                    <select id="motivation" class="form-control @error('motivation') is-invalid @enderror" name="motivation" v-model="postForm.motivation">
                                        <option value>----</option>
                                        <option value="0">最高</option>
                                        <option value="1">まあまあ</option>
                                        <option value="2">普通</option>
                                        <option value="3">ちょっと</option>
                                        <option value="4">終わっている</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="note" class="col-md-4 col-form-label text-md-right">学習の感想</label>

                                <div class="col-md-6">
                                    <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" v-model="postForm.note" required autocomplete="note">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        学習報告の提出
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      postForm: {
        study_content: null,
        subject1: false,
        subject2: false,
        subject3: false,
        subject4: false,
        subject5: false,
        subject6: false,
        subject7: false,
        text_name_first: null,
        text_name_second: null,
        searchWord: null,
        new_text_name_first: null,
        new_text_name_second: null,
        other_materials: null,
        motivation: null,
        note: null,
        user_id: null,
      },
    }
  },
  computed: {
    getUserId() {
      return this.$store.getters['auth/id']
    }
  },
  methods: {
    async createReport() {
      this.postForm.user_id = this.getUserId
      await this.$store.dispatch('report/post', this.postForm) // この中でAPIを呼び出す
      if (this.apiStatus) {
        this.$router.push('/child/report')
      }
    },
    searchText: function(e) {
      this.searchWord = document.getElementById("text_name_first").value;
      axios.get('/api/text-serach', {
        params: {
          text_name: null
        }
      })
      .then(response => {
        
      })
    }
  }
}
</script>
