<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <form-pensamiento-component @new="addPensamiento"></form-pensamiento-component>

            <pensamiento-component 
                v-for="(pensamiento, index) in pensamientos" 
                :key="pensamiento.id"
                :pensamiento = "pensamiento"
                @update="updatePensamiento(index, ...arguments)"
                @delete="deletePensamiento(index)"
            ></pensamiento-component>

        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                pensamientos: []
            }
        },

        mounted() {
            axios.get('/pensamientos').then((response) => {
                this.pensamientos = response.data;
            });
            console.log('Component "Content" mounted.')
        },
        
        methods: {
            addPensamiento(pensamiento){
                this.pensamientos.push(pensamiento);
            },
            updatePensamiento(index, pensamiento){
                this.pensamientos[index] = pensamiento;
            },
            deletePensamiento(index){
                this.pensamientos.splice(index, 1);
            }
        }
    }
</script>
