<template>
    <div class="card">
        <div class="card-header">Publicado en {{pensamiento.created_at}} ultima actualización {{pensamiento.updated_at}}</div>

        <div class="card-body">

            <input v-if="editModo" type="text" class="form-control" v-model="pensamiento.descripcion">
            <p v-else>{{ pensamiento.descripcion }}</p>
            
        </div>

        <div class="card-footer">
            <button v-if="editModo" class="btn btn-success" v-on:click="onClickUpdate()">Guardar cambios</button>
            <button v-else class="btn btn-primary" v-on:click="onClickEdit()">Editar</button>
            <button class="btn btn-danger" v-on:click="onClickDeleted()">Eliminar</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['pensamiento'],

        data(){
            return{
                editModo: false
            };
        },
        mounted() {
            console.log('Component "Pensamiento" mounted.')
        },
        methods: {
            onClickDeleted(){
                axios.delete(`/pensamientos/${this.pensamiento.id}`).then(() => {
                    this.$emit('delete');
                });
            },
            onClickEdit(){
                this.editModo = true;
            },
            onClickUpdate(){

                const params = {
                    descripcion: this.pensamiento.descripcion,
                };

                axios.put(`/pensamientos/${this.pensamiento.id}`, params).then((response) => {
                    this.editModo = false;
                    const pensamiento = response.data;
                    this.$emit('update', pensamiento)
                    });
                
            }
        }
    }
</script>
