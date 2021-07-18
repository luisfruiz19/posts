<template>
    <transition name="fade">
        <div v-if="comments.length>0">
            <div class="card card-body" v-for="(comment,index) in comments" :key="'comment_'+index">
                <strong>De: {{comment.user.name}}</strong>
                <p>
                    {{comment.description}}
                </p>
                <div style="display: block">
                    <button class="btn btn-sm btn-outline-secondary" @click="showFiles = comment">
                        <i class="fas fa-file"></i>&nbsp;
                        Ver Archivos
                    </button>
                </div>
            </div>
            <modal-component v-if="showFiles!=null" @close="showFiles=null">
                <template #header>
                    Archivos
                </template>
                <template #body>
                   <div class="table-responsive-sm">
                       <table class="table table-hover">
                               <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Digital</th>
                                    <th>Descargar</th>
                                </tr>
                               </thead>
                               <tbody v-if="files.length>0" >
                                <tr v-for="(file,index) in files" :key="'file_'+index">
                                    <td>
                                        {{index + 1}}
                                    </td>
                                    <td>
                                        <a :href="file.path" target="_blank">
                                            <i class="fas fa-file 2x"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="">
                                            Dowlonad
                                        </a>
                                    </td>
                                </tr>
                               </tbody>
                               <tbody v-else>
                                <tr>
                                    <td colspan="3">No hay datos</td>
                                </tr>
                               </tbody>
                       </table>
                   </div>
                </template>
            </modal-component>
        </div>
    </transition>
</template>

<script>

export default {
    name: "CommentComponent",
    props:{
        comments:{
            type:Array,
            default:function (){
                return []
            },
        }
    },
    data () {
        return {
            showFiles:null,
            files:[],
        }
    },
    methods:{
        async getAllFilesByIdComment(comment){
            try{
                let data = {
                    params:{
                        comment_id:comment.id
                    }
                }
                const response = await axios.get(`/files`,data)
                this.files = response.data.files
            }catch (e) {
                console.error(e.response)
            }
        }
    },
    watch:{
        showFiles(value){
            if (value!=null){
                this.getAllFilesByIdComment(value)
            }
        }
    }
}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
    transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
    opacity: 0;
}
</style>
