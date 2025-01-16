<template>
  <div class="login-container">
    <div class="top-line"></div>
    <header class="header">
      <img src="image/banner-portal.png" alt="Logo" class="logo" />
      <h1>Portal Sistemas | SERIN</h1>
    </header>

    <div class="login-box">
      <div>
        <a href="/" class="logo-link">Bem-Vindo(a)!</a>
      </div>

      <form @submit.prevent="submit">
        <!-- Campo Email -->
        <div class="form-group">
          <input
            v-model="form.email"
            type="email"
            class="form-control"
            id="email"
            placeholder="Digite seu e-mail"
            required
          />
          <!-- Exibição de Erro para o Email -->
          <InputError :message="form.errors.email ? form.errors.email[0] : null" />
        </div>

        <!-- Campo Senha -->
        <div class="form-group password-group">
          <input
            v-model="form.password"
            :type="passwordVisible ? 'text' : 'password'"
            class="form-control"
            id="password"
            placeholder="Digite sua senha"
            required
          />
          <button
            type="button"
            class="btn-show-password"
            @click="togglePassword"
          >
            <i :class="passwordVisible ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
          </button>
          <!-- Exibição de Erro para a Senha -->
          <InputError :message="form.errors.password ? form.errors.password[0] : null"  />
        </div>

        <!-- Exibição de Mensagens de Erro (Caso as credenciais sejam inválidas) -->
        <InputError :message="form.errors.auth ? form.errors.auth[0] : null" />

        <div class="form-group remember-me">
          <label>
            <input
              type="checkbox"
              v-model="form.rememberMe"
              :checked="form.rememberMe"
            /> Lembrar-me
          </label>
        </div>

        <button type="submit" class="btn-login btn btn-primary" :disabled="form.processing">Entrar</button>

        <div class="forgot-password-link">
          <Link href="#">Esqueceu a senha?</Link>
        </div>
      </form>
    </div>

    <footer class="footer">
      <div class="bottom-line"></div>
      <p>
        © Copyright 2012 - 2024 - SERIN - Todos os Direitos Reservados
        SERIN - 3ª Avenida, nº 390, Plataforma IV, 3º andar - Centro Administrativo da Bahia CEP 41.745-005 - Salvador - Bahia - Brasil
      </p>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm, Link } from '@inertiajs/inertia-vue3';
import InputError from '../Components/InputError.vue'; // Importando o componente de erro

const passwordVisible = ref(false);

// Recebendo as props de erros e valores do formulário
const props = defineProps({
  input: Object,
  errors: Object,
});

// Inicializando o formulário com valores passados por props ou vazios
const form = useForm({
  email: props.input?.email || '',
  password: '',
  rememberMe: props.input?.rememberMe || false,
  errors: props.errors || {}, // Inicializa com os erros passados pelo backend
});

// Função para submeter o formulário
const submit = () => {

  form.post("login", {
    
    onError: () => { 
      form.password = ""; // Limpa o campo de senha manualmente
    },
    onFinish: () => {
      form.password = ""; // Garante que a senha seja sempre limpa manualmente
    },
  });
};

// Função para alternar a visibilidade da senha
const togglePassword = () => {
  passwordVisible.value = !passwordVisible.value;
};
</script>

<style lang="scss">
@import "../../sass/app.scss";
@import "../../sass/components/_form.scss";
@import "../../sass/pages/_login.scss";
</style>
