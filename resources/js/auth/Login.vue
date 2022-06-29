<template>
    <div class="w-50 m-auto">
        <div class="card card-body">
            <form>
                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input
                        type="text"
                        name="email"
                        id="email"
                        placeholder="Enter your e-mail"
                        class="form-control"
                        v-model="email"
                        :class="[{'is-invalid': errorFor('email')}]"
                    />
                    <v-errors :errors="errorFor('email')"></v-errors>
                </div>


                <div class="mb-3">
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Enter your password"
                        class="form-control"
                        v-model="password"
                        :class="[{'is-invalid': errorFor('password')}]"
                    />
                    <v-errors :errors="errorFor('password')"></v-errors>
                </div>
                <div class="mb-3 d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Log-in</button>
                </div>

                <hr/>

                <div>
                    No account yet?
                    <router-link :to="{name: 'home'}" class="font-weight-bold">Register</router-link>
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

export default {
    mixins: [ValidationErrors],
    data() {
        return {
            email: null,
            password: null
        };
    }
};
</script>
