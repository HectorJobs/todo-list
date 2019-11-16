<template>
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-8">
                                    <p class="card-title">Progresos</p>
                                </div>
                                <div class="col-lg-4 float-right">
                                    <a href="#modalStore" data-toggle="modal" class="btn btn-success">Registrar progreso</a>
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
                                    <tr v-for="complexity in arrayComplexities" :key="complexity.id">
                                        <td v-text="complexity.id"></td>
                                        <td v-text="complexity.name"></td>
                                        <td><div :style="'height:20px; width:20px; background:'+complexity.color"></div></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm">
                                                Editar
                                            </button>
                                            <button class="btn btn-danger btn-sm">
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
                        <button data-dimiss="modal" class="close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" v-model="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Color:</label>
                            <input type="color" v-model="color" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary-outline" data-dimiss="modal">Cancelar</button>
                        <button class="btn btn-success" @click="storeProgress()">Registrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    mounted() {
        console.log("hola mundo");
    },
    data() {
        return {
            arrayProgress: [],
            name: ""
        }
    },
    methods: {
        getAllProcess(){

        },
        storeProgress(){

        },
        updateProgress(){

        },
        deleteProgress(){

        },
    },
}
</script>