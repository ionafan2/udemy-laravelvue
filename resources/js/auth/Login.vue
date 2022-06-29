<template>
    <div class="w-50 m-auto">
        <div class="card card-body">
            <form>
                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input
                        autocomplete="username"
                        type="text"
                        name="email"
                        id="email"
                        placeholder="Enter your e-mail"
                        class="form-control"
                        v-model="email"
                        :class="[{'is-invalid': errorFor('email')}]"
                    />
                    <validation-errors :errors="errorFor('email')"></validation-errors>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input
                        autocomplete="current-password"
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        class="form-control"
                        v-model="password"
                        :class="[{'is-invalid': errorFor('password')}]"
                    />
                    <validation-errors :errors="errorFor('password')"></validation-errors>
                </div>

                <div class="mb-3 d-grid gap-2">
                    <button type="submit" :disabled="loading" @click.prevent="login"
                            class="btn btn-primary btn-lg">Log-in
                    </button>
                </div>

                <hr/>

                <div>
                    No account yet?
                    <router-link :to="{name: 'register'}" class="font-weight-bold">Register</router-link>
                </div>

                <div>
                    Forgotten password?
                    <router-link :to="{name: 'home'}" class="font-weight-bold">Reset password</router-link>
                </div>
            </form>
        </div>
    </div>
</template>


<script>
import ValidationErrors from "../shared/mixins/validationErrors";
import {logIn} from "../shared/utils/auth";

export default {
    mixins: [ValidationErrors],
    data() {
        return {
            email: null,
            password: null,
            loading: false
        };
    },
    methods: {
        async login() {
            this.loading = true;
            this.errors = false;

            try {
                await axios.get("/sanctum/csrf-cookie");
                await axios.post("/login", {
                    email: this.email,
                    password: this.password
                });

                logIn();
                await this.$store.dispatch("loadUser");
                await this.$router.push({ name: "home" });

            } catch (error) {
                this.errors = error.response && error.response.data.errors;
            }

            this.loading = false;
        }
    }
};
</script>
