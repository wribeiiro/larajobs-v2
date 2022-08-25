<template>
	<main class="form-signin">
		<form>
			<div class="text-center">
				<h1 class="h3 mb-3 fw-normal">Criar uma conta</h1>
			</div>
			<div class="form-floating form-signin-up">
				<input type="text" class="form-control" v-model="form.name" id="name" placeholder="J">
				<label for="name">Nome</label>
			</div>
			<div class="form-floating mt-1">
				<input type="email" class="form-control" v-model="form.email" id="email" placeholder="name@example.com">
				<label for="email">Email</label>
			</div>
			<div class="form-floating mt-1">
				<input type="password" class="form-control" v-model="form.password" id="senha" placeholder="Password">
				<label for="senha">Senha</label>
			</div>
			<button class="w-100 btn btn-lg btn-primary mt-3" @click.prevent="register" type="submit">Criar</button>
			<p class="mt-2 mb-3 text-muted text-center">version {{ version }}</p>
		</form>
	</main>
</template>

<script>
import { useToast } from "vue-toastification";

export default {
	name: 'RegisterView',
	data() {
		return {
			form: {
				name: '',
				email: '',
				password: ''
			},
			version: '1.0.0'
		}
	},
	methods: {
		register() {
			this.axios.post('/api/users/register', this.form).then((response) => {
				debugger;
				localStorage.setItem("Token_Api", response.data);
				this.$router.push({ name: "Login" });
			}).catch((error) => {
				const toast = useToast();
				const { message } = error.response.data;

				if (message.name) {
					toast.warning(message.name[0]);
				}

				if (message.email) {
					toast.warning(message.email[0]);
				}

				if (message.password) {
					toast.warning(message.password[0]);
				}
			})
		}
	}
}
</script>

<style scoped>
body {
	height: 100%;
}

body {
	display: flex;
	align-items: center;
	padding-top: 40px;
	padding-bottom: 40px;
	background-color: #f5f5f5;
}

.form-signin {
	width: 100%;
	max-width: 330px;
	padding: 15px;
	margin: auto;
	margin-top: 150px;
	margin-bottom: 150px;
}
</style>