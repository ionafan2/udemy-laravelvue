<template>
    <div class="w-50 m-auto">
        <div class="card card-body">
            <form>
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Enter your name"
                        class="form-control"
                        v-model="user.name"
                        :class="[{'is-invalid': errorFor('name')}]"
                    />
                    <validation-errors :errors="errorFor('name')"></validation-errors>
                </div>

                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        placeholder="Enter your e-mail"
                        class="form-control"
                        v-model="user.email"
                        :class="[{'is-invalid': errorFor('email')}]"
                    />
                    <validation-errors :errors="errorFor('email')"></validation-errors>
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        class="form-control"
                        autocomplete="new-password"
                        v-model="user.password"
                        :class="[{'is-invalid': errorFor('password')}]"
                    />
                    <validation-errors :errors="errorFor('password')"></validation-errors>
                </div>

                <div class="mb-3">
                    <label for="password_confirmation">Re-type Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Confirm your password"
                        class="form-control"
                        autocomplete="new-password"
                        v-model="user.password_confirmation"
                        :class="[{'is-invalid': errorFor('password_confirmation')}]"
                    />
                    <validation-errors :errors="errorFor('password_confirmation')"></validation-errors>
                </div>
                <div class="mb-3 d-grid gap-2">
                    <button
                        type="submit"
                        class="btn btn-primary btn-lg"
                        :disabled="loading"
                        @click.prevent="register"
                    >Register
                    </button>
                </div>
                <hr/>

                <div>
                    Already have an account?
                    <router-link :to="{name: 'login'}" class="font-weight-bold">Log-in</router-link>
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
            user: {
                name: null,
                email: null,
                password: null,
                password_confirmation: null
            },
            loading: false
        };
    },
    methods: {
        async register() {
            this.loading = true;
            this.errors = null;

            try {
                const response = await axios.post("/register", this.user);

                if (201 === response.status) {
                    logIn();
                    this.$store.dispatch("loadUser");
                    this.$router.push({ name: "home" });
                }

            } catch (error) {
                this.errors = error.response && error.response.data.errors;
            }

            this.loading = false;
        }
    }
};
</script>
