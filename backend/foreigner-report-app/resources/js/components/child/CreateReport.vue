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
                                <label for="study_text" class="col-md-4 col-form-label text-md-right">使った教材</label>

                                <div class="col-md-6">
                                    <input id="study_text" type="text" class="form-control @error('study_text') is-invalid @enderror" name="study_text" v-model="postForm.study_text" required autocomplete="study_text">
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
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
        study_content: '',
        study_text: '',
        motivation: ''
      },
    }
  },
  methods: {
    async post() {
      await this.$store.dispatch('report/post') // この中でAPIを呼び出す
      if (this.apiStatus)
    }
  }
}
</script>
