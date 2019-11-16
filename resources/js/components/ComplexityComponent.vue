<template>
    <div>
        <div class="">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card ml-5 mr-5">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-8">
                                    <p class="card-title">Complejidades</p>
                                </div>
                                <div class="col-lg-4 right">
                                    <a href="#modalStore" data-toggle="modal" class="btn btn-success">Registrar complejidad</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>COLOR</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="complexity in arrayComplexities" :key="complexity.id">
                                        <td v-text="complexity.id"></td>
                                        <td v-text="complexity.name"></td>
                                        <td><div :style="'height:20px; width:20px; background:'+complexity.color"></div></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" :data-target="'#modalUpdate'+complexity.id">
                                                Editar
                                            </button>
                                            <button class="btn btn-danger btn-sm" @click="deleteComplexity(complexity)">
                                                Borrar
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalStore">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">Agregar complejidad</span>
                        <button data-dismiss="modal" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" v-model="complexity.name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Color:</label>
                            <input type="color" v-model="complexity.color" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary-outline" data-dis miss="modal">Cancelar</button>
                        <button class="btn btn-success" @click="storeComplexity()">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" v-for="complexity in arrayComplexities" :key="complexity.id" :id="'modalUpdate'+complexity.id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">Actualizar complejidad</span>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" v-model="complexity.name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Color:</label>
                            <input type="color" v-model="complexity.color" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary-outline" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" @click="updateComplexity(complexity)">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    data() {
        return {
            arrayComplexities:[],
            complexity: {
                name: "",
                color: "#000000"
            }
        }
    },
    mounted() {
        this.getAllComplexities();
    },
    methods: {
        getAllComplexities(){
            let that = this;
            that.complexity.name = "";
            that.complexity.color = "#000000";
            axios.get('http://localhost:8000/api/complexities').then((result) => {
                that.arrayComplexities = result.data.jsonRes;
            }).catch((err) => {
                console.error(err);
            });
        },
        storeComplexity(){
            let that = this;
            let json = {
                name: that.complexity.name,
                color: that.complexity.color
            }
            axios.post('http://localhost:8000/api/store/complexity', json).then((result) => {
                window.$('.modal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                    confirmButtonColor: "#38c172"
                });
                that.getAllComplexities();                
            }).catch((err) => {
                console.error(err);
            });
        },
        updateComplexity(complexity){
            let that = this;
            let json = {
                id: complexity.id,
                name: complexity.name,
                color: complexity.color
            }
            axios.post('http://localhost:8000/api/update/complexity', json).then((result) => {
                window.$('.modal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Actualización exitosa',
                    confirmButtonColor: "#38c172"
                });
                that.getAllComplexities();
            }).catch((err) => {
                console.error(err);
            });
        },
        deleteComplexity(complexity){
            let that = this;
            let json = {
                id: complexity.id
            }
            Swal.fire({
                icon: 'warning',
                title: '¿Esta seguro de eliminar este registro?',
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonColor: "#38c172",
                cancelButtonColor: "#c51f1a",
                preConfirm: () => {
                    axios.post('http://localhost:8000/api/delete/complexity', json).then((result) => {
                        if(result.intRes == 200) return true;
                    }).catch((err) => {
                        console.error(err);
                    });
                },
            }).then((result) => {
                if(result && !result.dismiss){
                    that.getAllComplexities();
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado exitoso',
                        confirmButtonColor: "#38c172"
                    });
                }
            });
            
        }
    },
}
</script>