<template>
    <div class="container">
        <div class="row">
            <div class="col col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" 
                                    v-model="user.nome"
                                    placeholder="Seu nome..." :disabled="loading">
                                </div>
                            </div>
                            <div class="col col-md-6 mt-2">
                                <div class="form-group">
                                    <label for="apelido">Apelido</label>
                                    <input type="text" class="form-control" id="apelido" 
                                    v-model="user.apelido"
                                    placeholder="Seu apelido..." :disabled="loading">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-md-12">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" 
                                    v-model="user.email"
                                    disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col col-md-12" v-if="!user.foto">
                                <label for="foto">Foto</label>
                                <input type="file" class="form-control" id="foto" 
                                @change="onFotoChange"
                                placeholder="Foto" :disabled="loading">
                            </div>
                            <div class="col offset-md-3 col-md-12" v-if="user.foto">
                                <img v-if="typeof(user.foto) == 'file' || !imgPreview" 
                                :src="'http://www.zleague.com.br:8000/storage/'+user.foto"
                                width="200px" height="200px" style="border-radius: 50%">
                                <img v-else :src="imgPreview"
                                width="200px" height="200px" style="border-radius: 50%">
                                <a href="javascript:void(0)" @click="user.foto = null;imgPreview = null">
                                    <i class="tim-icons icon-simple-remove remove-foto"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-block" 
            @click="editUser()" :disabled="loading">
                <span v-if="!loading">
                    Editar Perfil
                </span>
                <div v-if="loading" class="loader"></div>
            </button>
        </div>
    </div>
</template>
<script>
  export default {
    mounted(){
        if(this.$auth.isAuthenticated()){
            this.user = this.$auth.getUser();
            console.log(this.user);
        }
    },
    data(){
        return {
            user: {
                id: null,
                nome: null,
                apelido: null,
                foto: null,
                email: null,
                foto: null
            },
            loading: null,
            imgPreview: null
        }
    },
    methods: {
        onFotoChange(event){
            this.user.foto = event.target.files[0];
            this.previewFoto(this.user.foto);
        },
        previewFoto(foto) {
            let reader = new FileReader();
            reader.readAsDataURL(foto);
            reader.onloadend = () => {
                this.imgPreview = reader.result;
            }
        },
        editUser(){
            this.loading = true;
            const fd = new FormData();
            fd.append('foto', this.user.foto, this.user.foto.name);
            fd.append('apelido', this.user.apelido);
            fd.append('nome', this.user.nome);
            fd.append('_method', 'put');
            axios.post("usuarios/"+this.user.id, fd)
                .then(response => {
                    console.log(response);
                    this.loading = false;
                    this.$auth.setUser(response.data.usuario);
                    this.$notify({type: 'success', message: 'Usuário editado com sucesso!'});
                })
        }
    }
  }
</script>
<style lang="scss" scoped>
.remove-foto {
    font-size: 30px;
}

.loader {
    border: 5px solid #f3f3f3;
    border-top: 5px solid #e14eca; /* Roxo */
    border-radius: 50%;
    width: 30px;
    height: 30px;
    animation: spin 2s linear infinite;
    left: 47%;
    position: relative;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>