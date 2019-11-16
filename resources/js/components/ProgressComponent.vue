<template>
    <div>
        <div class="">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="card ml-5 mr-5">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-8">
                                    <p class="card-title">Progresos</p>
                                </div>
                                <div class="col-lg-4 float-right">
                                    <a href="#modalStore" data-toggle="modal" class="btn btn-success">Registrar progresos</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>ACCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="progress in arrayProgress" :key="progress.id">
                                        <td v-text="progress.id"></td>
                                        <td v-text="progress.name"></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-toggle="modal" :data-target="'#modalUpdate'+progress.id">
                                                Editar
                                            </button>
                                            <button class="btn btn-danger btn-sm" @click="deleteProgress(progress)">
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
                            <input type="text" v-model="progress.name" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary-outline" data-dis miss="modal">Cancelar</button>
                        <button class="btn btn-success" @click="storeProgress()">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" v-for="progress in arrayProgress" :key="progress.id" :id="'modalUpdate'+progress.id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">Actualizar complejidad</span>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" v-model="progress.name" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary-outline" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-success" @click="updateProgress(progress)">Actualizar</button>
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
            arrayProgress:[],
            progress: {
                name: ""
            }
        }
    },
    mounted() {
        this.getAllProgress();
    },
    methods: {
        getAllProgress(){
            let that = this;
            that.progress.name = "";
            axios.get('http://localhost:8000/api/progress').then((result) => {
                that.arrayProgress = result.data.jsonRes;
            }).catch((err) => {
                console.error(err);
            });
        },
        storeProgress(){
            let that = this;
            let json = {
                name: that.progress.name
            }
            axios.post('http://localhost:8000/api/store/progress', json).then((result) => {
                window.$('.modal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                });
                that.getAllProgress();                
            }).catch((err) => {
                console.error(err);
            });
        },
        updateProgress(progress){
            let that = this;
            let json = {
                id: progress.id,
                name: progress.name,
            }
            axios.post('http://localhost:8000/api/update/progress', json).then((result) => {
                window.$('.modal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Actualización exitosa',
                });
                that.getAllProgress();
            }).catch((err) => {
                console.error(err);
            });
        },
        deleteProgress(progress){
            let that = this;
            let json = {
                id: progress.id
            }
            Swal.fire({
                icon: 'warning',
                title: '¿Esta seguro de eliminar este registro?',
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonColor: "#38c172",
                cancelButtonColor: "#c51f1a",
                preConfirm: () => {
                    axios.post('http://localhost:8000/api/delete/progress', json).then((result) => {
                        if(result.intRes == 200) return true;
                    }).catch((err) => {
                        console.error(err);
                    });
                },
            }).then((result) => {
                if(result && !result.dismiss){
                    that.getAllProgress();
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado exitoso',
                    });
                }
            });
            
        }
    },
}
</script>