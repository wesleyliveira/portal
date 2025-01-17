<template>
    <Head title="Login"/>

    <div class="login-container">
        <div class="top-line"></div>
        <header class="header">
            <img src="image/banner-portal.png" alt="Logo" class="logo"/>
            <h1>Portal Sistemas | SERIN</h1>
        </header>
<!-- 
        <jet-authentication-card>
            <template #logo>
                <jet-authentication-card-logo/>
            </template> -->

            <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                {{ status }}
            </div>

            <div class="login-box">
                <form @submit.prevent="submit">
                    <!-- Campo Email -->
                    <div class="form-group">
                        <jet-label for="email" value="Email"/>
                        <jet-input
                            v-model="form.email"
                            id="email"
                            type="email"
                            class="form-control"
                            placeholder="Digite seu e-mail"
                            required
                            autofocus
                        />
                        <!-- Exibição de Erro para o Email -->
                        <jet-validation-errors class="mb-4" v-if="form.errors.email"/>
                    </div>

                    <!-- Campo Senha -->
                    <div class="form-group password-group">
                        <jet-label for="password" value="Senha"/>
                        <jet-input
                            v-model="form.password"
                            :type="passwordVisible ? 'text' : 'password'"
                            id="password"
                            class="form-control"
                            placeholder="Digite sua senha"
                            required
                        />
                        <button type="button" class="btn-show-password" @click="togglePassword">
                            <i :class="passwordVisible ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                        </button>
                        <!-- Exibição de Erro para a Senha -->
                        <jet-validation-errors class="mb-4" v-if="form.errors.password"/>
                    </div>

                    <!-- Exibição de Mensagens de Erro -->
                    <jet-validation-errors class="mb-4" v-if="form.errors.auth"/>

                    <!-- Checkbox "Lembrar-me" -->
                    <div class="form-group remember-me">
                        <label>
                            <input type="checkbox" v-model="form.remember">
                            <span class="ml-2 text-sm text-gray-600">Lembrar-me</span>
                        </label>
                    </div>

                    <button type="submit" class="btn-login btn btn-primary" :disabled="form.processing">
                        <i v-show="form.processing" class="fas fa-spinner animate-spin mr-2"></i>
                        Entrar
                    </button>

                    <div class="forgot-password-link">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900">
                            Esqueceu sua senha?
                        </Link>
                    </div>
                </form>
            </div>
        <!-- </jet-authentication-card> -->

        <footer class="footer">
            <div class="bottom-line"></div>
            <p>
                © Copyright 2012 - 2024 - SERIN - Todos os Direitos Reservados.
                SERIN - 3ª Avenida, nº 390, Plataforma IV, 3º andar - Centro Administrativo da Bahia CEP 41.745-005 - Salvador - Bahia - Brasil.
            </p>
        </footer>
    </div>
</template>

<script>
import {defineComponent, ref} from 'vue';
import JetAuthenticationCard from '@/Components/AuthenticationCard.vue';
import JetAuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import JetInput from '@/Components/Input.vue';
import JetLabel from '@/Components/Label.vue';
import JetValidationErrors from '@/Components/ValidationErrors.vue';
import {Head, Link} from '@inertiajs/vue3';

export default defineComponent({
    components: {
        Head,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetInput,
        JetLabel,
        JetValidationErrors,
        Link,
    },

    props: {
        canResetPassword: Boolean,
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                remember: false,
            }),
            passwordVisible: ref(false),
        };
    },

    methods: {
        submit() {
            this.form
                .transform((data) => ({
                    ...data,
                    remember: this.form.remember ? 'on' : '',
                }))
                .post(this.route('login.post'), {
                    onFinish: () => this.form.reset('password'),
                });
        },
        togglePassword() {
            this.passwordVisible = !this.passwordVisible;
        },
    },
});
</script>

<style scoped>
/* Estilos herdados do segundo código */
@import '/resources/sass/app.scss'; ;
@import "/resources/sass/components/_form.scss";
@import "/resources/sass/pages/_login.scss";

/* Botões personalizados */
.btn {
    @apply inline-flex justify-center px-4 py-1 border border-transparent rounded-lg transition duration-500 shadow antialiased
    focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:opacity-25;
}

.btn-login {
    @apply bg-sky-600 hover:bg-sky-700 text-white h-8;
}

/* Outros estilos do primeiro código */
.login-container {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 1rem;
    background-color: #f9f9f9;
    min-height: 100vh;
    text-align: center;
}

.header .logo {
    max-width: 200px;
    margin: 0 auto 1rem;
}

.forgot-password-link {
    margin-top: 1rem;
}
</style>