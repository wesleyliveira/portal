<template>
  <div class="login-container">
    <div class="top-line"></div>
    <header class="header">
      <img src="image/banner-portal.png" alt="Logo" class="logo">
      <h1>Portal Sistemas | SERIN</h1>
    </header>

    <div class="login-box">
      <div>
        <a href="/" class="logo-link">Bem-Vindo(a)!</a>
      </div>

      <form @submit.prevent="submit">
        <!-- Campo Username -->
        <div class="form-group">
          <input
            v-model="form.email"
            type="email"
            class="form-control"
            id="email"
            placeholder="Digite seu e-mail"
            required
          />
        </div>

        <!-- Campo Password -->
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
        </div>

        <!-- Exibição de Mensagens de Erro -->
        <div v-if="error" class="alert alert-danger">
          <p>{{ error }}</p>
        </div>

        <div v-if="form.errors.email" class="alert alert-danger">
          <p>{{ form.errors.email }}</p>
        </div>
        <div v-if="form.errors.password" class="alert alert-danger">
          <p>{{ form.errors.password }}</p>
        </div>

        <div class="form-group remember-me">
          <label>
            <input type="checkbox" v-model="form.rememberMe" /> Lembrar-me
          </label>
        </div>

        <button type="submit" class="btn-login btn btn-primary">Entrar</button>

        <div class="forgot-password-link">
          <Link href="/dashboard">Esqueceu a senha?</Link>
        </div>
      </form>
    </div>

    <footer class="footer">
      <div class="bottom-line"></div>
      <p>&copy; Copyright 2012 - 2024 - SERIN - Todos os Direitos Reservados
        SERIN - 3ª Avenida, nº 390, Plataforma IV, 3º andar - Centro Administrativo da Bahia CEP 41.745-005 - Salvador - Bahia - Brasil</p>
    </footer>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';  // Importação do Link

const form = useForm({
  email: '',
  password: '',
  rememberMe: false,  // Necessário para o cookie "remember me"
});

const passwordVisible = ref(false);
const error = ref('');

// Função para enviar o formulário
const submit = () => {
  form.post('/login', {
    onFinish: () => {
      // Verificar se não há erros antes de redirecionar
      if (!form.hasErrors) {
        Inertia.visit('/dashboard');
      }
    },
    onError: (errors) => {
      // Capturar os erros enviados pelo backend
      if (errors.email) {
        form.errors.email = 'O e-mail fornecido não é válido ou não está registrado.';
      }
      if (errors.password) {
        form.errors.password = 'A senha informada está incorreta. Tente novamente ou clique em "Esqueci minha senha" para redefinir.';
      }

      // Exibir erro geral se houver falha no login
      error.value = 'As credenciais fornecidas são inválidas.';
    },
    // Certifique-se de que estamos manipulando o erro do formulário corretamente
    preserveState: true
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
