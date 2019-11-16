<template>
    <div class="">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card ml-5 mr-5">
                    <div class="card-header">
                    <div class="row">
                            <div class="col-lg-8">
                                <p class="card-title">Lista de trabajos</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>OBJETIVO</th>
                                    <th>HRS</th>
                                    <th>ASIGNADO A</th>
                                    <th>COMPLEJIDAD</th>
                                    <th>ESTATUS</th>
                                    <th>FECHA ESTIMADA</th>
                                    <th>DETALLES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="work in arrayWorks" :key="work.id">
                                    <td v-text="work.name"></td>
                                    <td>
                                        <input type="number" class="form-control" v-model="work.time" @change="updateWork(work)">
                                    </td>
                                    <td>
                                        <select name="work_user_id" id="work_user_id" v-model="work.user_id" :value="work.user_id" class="form-control" @change="updateWork(work)">
                                            <option v-for="user in arrayUsers" :key="user.id" :value="user.id" v-text="user.name"></option>
                                        </select>
                                    </td>
                                    <td v-text="work.complexity.name" :style="'color:'+work.complexity.color"></td>
                                    <td>
                                        <select name="work_progress_id" id="work_progress_id" v-model="work.progress_id" :value="work.progress_id" class="form-control" @change="updateWork(work)">
                                            <option v-for="progress in arrayProgress" :key="progress.id" :value="progress.id" v-text="progress.name"></option>
                                        </select>
                                    </td>
                                    <td v-text="work.dead_line"></td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" :data-target="'#modalDetails'+work.id">
                                            Ver detalles
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div v-for="work in arrayWorks" :key="work.id" class="modal fade" :id="'modalDetails'+work.id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <span class="modal-title">Detalles</span>
                        <button class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="name">Objetivo:</label>
                                <span v-text="work.name"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="name">Asinado a:</label>
                                <span v-text="work.user.name"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="name">Complejidad:</label>
                                <span v-text="work.complexity.name"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="name">Estatus:</label>
                                <span v-text="work.progress.name"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="name">Fecha estimada:</label>
                                <span v-text="work.dead_line"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12">
                                <label for="name">Descripción:</label>
                                <p v-text="work.description"></p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary-outline" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    mounted() {
        this.getAllWorks();
    },
    data() {
        return {
            arrayWorks: [],
            arrayUsers: [],
            arrayComplexities: [],
            arrayProgress: [],
            work: {
                name: "",
                time: 0,
                user_id: 0,
                complexity_id: 0,
                progress_id: 0,
                dead_line: "",
                description: ""
            }
        }
    },
    methods: {
        getAllWorks(){
            let that = this;
            that.work.name = "";
            that.work.time = "";
            that.work.user_id = 0;
            that.work.complexity_id = 0;
            that.work.progress_id = 0;
            that.work.dead_line = "";
            axios.get('http://localhost:8000/api/works').then((result) => {
                that.arrayWorks = result.data.arrayWorks;
                that.arrayUsers = result.data.arrayUsers;
                that.arrayComplexities = result.data.arrayComplexities;
                that.arrayProgress = result.data.arrayProgress;
            }).catch((err) => {
                console.error(err);
            });
        },
        updateWork(work){
            let that = this;
            console.log(work);
            axios.post('http://localhost:8000/api/update/work', work).then((result) => {
                that.getAllWorks();
            }).catch((err) => {
                 console.error(err);
            });
        }
    },
}
</script>