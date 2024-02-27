<template>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h3>APPLICATION CRUD DE VUE JS ET LARAVEL</h3>
            <div class="row">
                <div class="col-6">
                <form @submit.prevent="save">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nom</label>
                        <input type="text" class="form-control" v-model="etudiant.name" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Adresse</label>
                        <input type="text" class="form-control" v-model="etudiant.adress" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Télephone</label>
                        <input type="text" class="form-control" v-model="etudiant.phone" id="exampleInputPassword1">
                    </div>

                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>

            <div class="col-6">
                <h3>Liste des étudiants</h3>
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="etudiant in result" v-bind:key="etudiant.id">
                        <th scope="row">{{ etudiant.id }}</th>
                        <td>{{ etudiant.name }}</td>
                        <td>{{ etudiant.adress }}</td>
                        <td>{{ etudiant.phone }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" @click="edit(etudiant)">Modifier</button>
                            <button type="button" class="btn btn-danger" @click="remove(etudiant)">Supprimer</button>
                        </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';
    export default{
        name: "etudiant",
        data(){
            return{

            result: {},
            etudiant:{
                id:'',
                name:'',
                adress: '',
                phone: ''
            }
            }
        },
        created(){
            this.etudiantLoad();
        },
        mounted(){
            console.log("mounted() called.......");
        },
        methods:{
            etudiantLoad(){
                var page = "http://127.0.0.1:8000/api/etudiant";
                axios.get(page)
                .then(
                    ({data})=>{
                        console.log(data);
                        this.result = data;
                    }
                );
            },
            save(){
                if(this.etudiant.id == ''){
                    this.saveData();
                }else{
                    this.updateData();
                }
            },
            saveData(){
                axios.post("http://127.0.0.1:8000/api/etudiant", this.etudiant)
                .then(
                    ({data})=>{
                        alert("Etudiant enregistré avec succès!");
                        this.etudiantLoad();
                        this.etudiant.name = '';
                        this.etudiant.adress = '',
                        this.etudiant.phone = '',
                        this.id = ''

                    }
                )
            },
            edit(etudiant){
                this.etudiant = etudiant;
            },
            updateData(){
                axios.put('http://127.0.0.1:8000/api/etudiant/'+ this.etudiant.id, this.etudiant)
                .then(
                    ({data})=>{
                        this.etudiant.name = '';
                        this.etudiant.adress = '',
                        this.etudiant.phone = '',
                        this.id = ''

                        alert("Etudiant mis à jour avec succès!");
                        this.etudiantLoad();
                    }
                )
            },
            remove(etudiant){
                var url = 'http://127.0.0.1:8000/api/etudiant/'+etudiant.id;
                axios.delete(url);
                alert("Etudiant supprimé avec succès!");
                this.etudiantLoad();
            }
        }

    }

</script>
