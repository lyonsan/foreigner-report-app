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
                                    <input id="text_name_first" type="text" class="form-control @error('text_name_first') is-invalid @enderror" name="text_name_first" v-model="postForm.text_name_first" v-on:input="inputSearchWord('text_name_first')" autocomplete="text_name_first">
                                    <div v-bind:class="{ textsWrap: texts_first.length != 0 }">
                                      <div v-for="(text, index) in texts_first" v-on:click="select(text.text_name, 'text_name_first')">
                                        <div v-if="index < 10" class="item" v-bind:class="{ isEven: index%2 == 1 }">
                                          <p>
                                            {{ text.text_name }}
                                          </p>
                                      </div>
                                      </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="text_name_second" class="col-md-4 col-form-label text-md-right">使った教材2</label>

                                <div class="col-md-6">
                                    <input id="text_name_second" type="text" class="form-control @error('text_name_second') is-invalid @enderror" name="text_name_second" v-model="postForm.text_name_second" v-on:input="inputSearchWord('text_name_second')" autocomplete="text_name_second">
                                    <div v-bind:class="{ textsWrap: texts_second.length != 0 }">
                                      <div v-for="(text, index) in texts_second" v-on:click="select(text.text_name, 'text_name_second')">
                                        <div v-if="index < 10" class="item" v-bind:class="{ isEven: index%2 == 1 }">
                                          <p>
                                            {{ text.text_name }}
                                          </p>
                                      </div>
                                      </div>
                                    </div>
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
        new_text_name_first: null,
        new_text_name_second: null,
        other_materials: null,
        motivation: null,
        note: null,
        user_id: null,
      },
      searchWord: '',
      searchWordOne: '',
      searchWordTwo: '',
      texts_first: [],
      texts_second: []
    }
  },
  watch: {
    // ここで二つの変数をwatchしようとしてエラーが生じている様子
    // searchWordOne: function () {
    //   this.searchTextOneWithInterval()
    // },
    // searchWordTwo: function () {
    //   this.searchTextTwoWithInterval()
    // }
    _allWatch(value, oldValue) {
      console.log(value, oldValue)
      if (value[0] != oldValue[0]) {
        this.searchText('text_name_first')
      } else if (value[1] != oldValue[1]) {
        this.searchText('text_name_second')
      }
    }
  },
  created: function () {
    this.searchTextOneWithInterval = _.throttle(this.searchText('text_name_first'), 500)
    this.searchTextTwoWithInterval = _.throttle(this.searchText('text_name_second'), 500)
  },
  computed: {
    getUserId() {
      return this.$store.getters['auth/id']
    },
    _allWatch() {
      return [this.$data.searchWordOne, this.$data.searchWordTwo]
    }
  },
  methods: {
    async createReport() {
      this.postForm.user_id = this.getUserId
      await this.$store.dispatch('report/post', this.postForm)
      if (this.apiStatus) {
        this.$router.push('/child/report')
      }
    },
    inputSearchWord: function(text_name) {
      if (text_name == 'text_name_first') {
        this.searchWordOne = document.getElementById(text_name).value
      } else if (text_name == 'text_name_second') {
        this.searchWordTwo = document.getElementById(text_name).value
      }
    },
    searchText: function(text_name) {
      if (this.searchWordOne == '' && text_name == 'text_name_first') {
        this.texts_first = []
      } else if (this.searchWordTwo == '' && text_name == 'text_name_second') {
        this.texts_second = []
      } else {
        if (text_name == 'text_name_first') {
          this.searchWord = this.searchWordOne
        } else if (text_name == 'text_name_second') {
          this.searchWord = this.searchWordTwo
        }
        axios.get('/api/text-search', {
          params: {
            text_name: this.searchWord // これでは呼び出せない
          }
        })
        .then(function (response) {
          console.log(response.data.text_infos)
          if (text_name == 'text_name_first') {
            this.texts_first = response.data.text_infos
          } else if (text_name == 'text_name_second') {
            this.texts_second = response.data.text_infos
          }
        }.bind(this))
      }
    },
    select: function (textName, textNameNum) {
      if (textNameNum == 'text_name_first') {
        this.postForm.text_name_first = textName;
        this.texts_first = []
      } else if (textNameNum == 'text_name_second') {
        this.postForm.text_name_second = textName;
        this.texts_second = []
      }
    }
  }
}
</script>

<style lang="scss" scoped>
#text_name_first {
  position: absolute;
}

.textsWrap{
    position: relative;
    top: 30px;
    width: 304px;
    border: solid 1px #000000;
    z-index: 10;
}

.item p{
    margin: 0px;
}

.isEven{
    background-color: #dddddd;
}
</style>