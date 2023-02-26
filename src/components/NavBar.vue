<template>    
    <nav class="d-flex justify-content-between align-items-center bg-secondary bg-gradient p-3 mb-3 shadow">
        <div class="d-flex justify-content-start">
            <h2 class="text-white">Agencia de seguros</h2>
        </div>
        <div class="d-flex justify-content-end">
            <router-link :to="{name:'listarclientes' }" class="btn btn-outline-light me-5">Clientes</router-link>
            <router-link :to="{ name: 'listarpolizas' }" class="btn btn-outline-light me-5">Pólizas</router-link>
            <button @click="logout" class="btn btn-danger ms-5">Logout</button>
        </div>
    </nav>
</template>
<script>
    export default {
        methods: {
            logout(){
                this.$router.replace({ path: 'login' })
            }
        },
    }
</script>