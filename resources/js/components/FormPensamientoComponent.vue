<template>
    <div class="card">
        <div class="card-header">¿En que estas pensando ahora?</div>

        <div class="card-body">
            <form action="" v-on:submit.prevent="newPensamiento()">
                <div class="form-group">
                    <label for="pensamiento">Ahora estoy pensando en:</label>
                    <input 
                        type="text" 
                        class="form-control"
                        v-model="descripcion"
                    >
                    <br>
                    <button type="submit" class="btn btn-primary">Enviar pensamiento</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                descripcion: ''
            }
        },
        mounted() {
            console.log('Component "Formulario" mounted.')
        },
        methods: {
            newPensamiento(){

                const params = {
                    descripcion: this.descripcion,
                };

                this.descripcion = '';
                
                axios.post('/pensamientos', params).then((response) => {
                    const pensamiento = response.data;
                    this.$emit('new', pensamiento);

                });
            }
        }

    }
</script>
