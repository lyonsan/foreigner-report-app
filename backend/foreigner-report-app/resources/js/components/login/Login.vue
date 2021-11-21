<template>
  <div class="container--small">
    <ul class="tab d-flex flex-row">
      <li
        class="tab__item pr-3"
        :class="{'tab__item--active': tab === 1 }"
        @click="tab = 1"
      >Login</li>
      <li
        class="tab__item pr-3"
        :class="{'tab__item--active': tab === 2 }"
        @click="tab = 2"
      >Register</li>
      <li
        class="tab__item pr-3"
        @click="logout"
      >Logout</li>
    </ul>
    <div class="panel" v-show="tab === 1">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-body">
                      <form class="form" @submit.prevent="login">
                          <div class="form-group row">
                              <label for="login-email" class="col-md-4 col-form-label text-md-right">E Mail Address</label>
                              <div class="col-md-6">
                                  <input id="login-email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email" v-model="loginForm.email" autofocus>
                              </div>
                          </div>

                          <div class="form-group row">
                              <label for="login-password" class="col-md-4 col-form-label text-md-right">Password</label>
                              <div class="col-md-6">
                                  <input id="login-password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" v-model="loginForm.password">
                              </div>
                          </div>
<!-- 
                          <div class="form-group row">
                              <div class="col-md-6 offset-md-4">
                                  <div class="form-check">
                                      <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                      <label class="form-check-label" for="remember">
                                          Remember me
                                      </label>
                                  </div>
                              </div>
                          </div> -->

                          <div class="form-group row mb-0">
                              <div class="col-md-8 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      Login
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <div class="panel" v-show="tab === 2">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form class="form" @submit.prevent="register">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                                <div class="col-md-6">
                                    <input id="user_name" type="text" class="form-control @error('name') is-invalid @enderror" name="user_name" v-model="registerForm.user_name" required autocomplete="user_name" autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" v-model="registerForm.email" required autocomplete="email">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" v-model="registerForm.password" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" v-model="registerForm.password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="user_language" class="col-md-4 col-form-label text-md-right">Language</label>

                                <div class="col-md-6">
                                    <input id="user_language" type="text" class="form-control @error('user_language') is-invalid @enderror" name="user_language" v-model="registerForm.user_language" autocomplete="user_language">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_birthday" class="col-md-4 col-form-label text-md-right">Birthday</label>

                                <div class="col-md-6">
                                    <input type="text" id="user_birthday" name="user_birthday" v-model="registerForm.user_birthday">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_role" class="col-md-4 col-form-label text-md-right">User Role</label>

                                <div class="col-md-6">
                                    <select id="user_role" ref="user_role" class="form-control @error('user_role') is-invalid @enderror" name="user_role" v-model="registerForm.user_role" @change="changeUserRole">
                                        <option value="">------</option>
                                        <option value="child">child</option>
                                        <option value="teacher">teacher</option>
                                        <option value="parent">parent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row d-none" id="user_school_wrapper" ref="user_school_wrapper">
                                <label for="user_school" class="col-md-4 col-form-label text-md-right">School</label>

                                <div class="col-md-6">
                                    <input id="user_school" type="text" class="form-control @error('user_school') is-invalid @enderror" name="user_school" v-model="registerForm.user_school" autocomplete="school">
                                </div>
                            </div>

                            <div class="form-group row d-none" id="user_edu_org_wrapper" ref="user_edu_org_wrapper">
                                <label for="user_edu_org" class="col-md-4 col-form-label text-md-right">Organization</label>

                                <div class="col-md-6">
                                    <input id="user_edu_org" type="text" class="form-control @error('user_edu_org') is-invalid @enderror" name="user_edu_org" v-model="registerForm.user_edu_org" autocomplete="user_edu_org">
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
      tab: 1,
      loginForm: {
        email: '',
        password: ''
      },
      registerForm: {
        user_name: '',
        email: '',
        password: '',
        password_confirmation: '',
        user_language: '',
        user_birthday: '',
        user_role: '',
        user_school: '',
        user_edu_org: ''
      },
    }
  },
  computed: {
      apiStatus () {
          return this.$store.state.auth.apiStatus
      }
  },
  mounted() {
      const userSchoolElement = this.$refs.user_school_wrapper
      const userEduOrgElement = this.$refs.user_edu_org_wrapper
  },
  methods: {
    async login() {
      console.log('loginメソッド')
      await this.$store.dispatch('auth/login', this.loginForm)
      if (this.apiStatus) {
          this.$router.push('/')
      }
    },
    async register() {
      // authストアのregisterアクションを呼び出す
      // index.jsでVuexプラグインの作成を宣言したためthis.$storeからストアを参照できる
      // アクションを呼び出すためにはdispatchを使う
      await this.$store.dispatch('auth/register', this.registerForm)

      // index.jsでVuexプラグインの作成を宣言したためthis.$routerでルーターオブジェクトを使える
      this.$router.push('/')
    },
    async logout() {
        await this.$store.dispatch('auth/logout')
        this.$router.push('/login', () => {})
    },
    changeUserRole (value) {
        const userRole = this.registerForm.user_role
        const userEduOrgElement = this.$refs.user_edu_org_wrapper
        const userSchoolElement = this.$refs.user_school_wrapper
        console.log(userRole)
        if(userRole === 'child') {
            userSchoolElement.classList.remove('d-none');
            userEduOrgElement.classList.add('d-none');
        }
        else if(userRole === 'teacher') {
            userSchoolElement.classList.add('d-none');
            userEduOrgElement.classList.remove('d-none');
        }
        else {
            userSchoolElement.classList.add('d-none');
            userEduOrgElement.classList.add('d-none');
        }
    }
  }
}
</script>