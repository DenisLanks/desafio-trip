<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header"></div>

          <div class="card-body">
            <form method="POST" v-on:submit.prevent="signin">
              @csrf

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right"
                  >E-Mail Address</label
                >

                <div class="col-md-6">
                  <input
                    id="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    v-model="user.email"
                    required
                    autocomplete="email"
                    autofocus
                  />
                </div>
              </div>

              <div class="form-group row">
                <label
                  for="password"
                  class="col-md-4 col-form-label text-md-right"
                  >Password</label
                >

                <div class="col-md-6">
                  <input
                    id="password"
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    v-model="user.password"
                    required
                    autocomplete="current-password"
                  />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-6 offset-md-4">
                  <div class="form-check">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="remember"
                      id="remember"
                      v-model="user.remember"
                    />

                    <label class="form-check-label" for="remember">
                      Remember Me
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                  <button type="submit" class="btn btn-primary">Login</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
        data(){
          return  {
                user:{
                    email: "",
                    password: "",
                    remember: false
                }
            }
        },
        methods: {
            signin(event){
                event.preventDefault();

                axios.post(`${window.location.origin}/api/login`,{
                    email:this.user.email,
                    password:this.user.password,
                    remember:this.user.remember
                }).then((response)=>{
                    this.$store.commit('changeUser', response.data.user);
                    this.$router.push('home');
                    console.log(this);
                }).catch((err)=>{
                    console.error(err);
                })
            }
        }
    };
</script>

<style>
</style>
