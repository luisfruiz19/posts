<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Posts
                        <button class="btn btn-sm btn-outline-secondary" @click="modalNewPost = true">
                            <i class="fas fa-plus-circle"></i>
                            Agregar Post
                        </button>
                    </div>

                    <div class="card-body">
                        <card-component  v-for="(row,index) in posts" :key="'post_'+row.id" class="mt-2">
                            <template #header>
                               {{index + 1}}. {{row.user.name}} - {{row.name }}
                            </template>
                            <template #body>
                                <div style="display: block">
                                    # <span class="badge bg-info text-white">{{row.tag.name}}</span> - <small>{{formatedDate(row.created_at)}}</small>
                                </div>
                                <div style="display: block">
                                    <a href="#" v-if="row.comments.length>0">
                                        <div v-if="row.comments.length===1 && !row.show_comments" style="display: inline-block" @click.stop.prevent="row.show_comments=true">
                                            <span>Ver {{row.comments.length}} Comentario </span>
                                        </div>
                                        <div v-else-if="row.comments.length>1 && !row.show_comments" style="display: inline-block" @click.stop.prevent="row.show_comments=true">
                                            <span>Ver {{row.comments.length}} Comentarios </span>
                                        </div>
                                        <div v-if="row.show_comments" style="display: inline-block" @click.stop="row.show_comments=false">
                                            <span>Ocultar Comentario</span>
                                        </div>
                                    </a>
                                    <span @click="row.show_new_comment=!row.show_new_comment" style="cursor: pointer;color: #1d68a7">
                                    {{row.show_new_comment?`Cancelar`:`(+ Comentar)`}}
                                   </span>
                                    <div v-if="row.show_new_comment">
                                        <comment-form :post_id="row.id" @update-comments="getAllPosts();row.show_comments=true"></comment-form>
                                    </div>
                                </div>
                            </template>
                            <template #custom>
                                <div style="display: block">
                                    <comment-component  :comments="row.comments"  v-if="row.show_comments" />
                                </div>
                            </template>
                        </card-component>

                    </div>
                    <modal-component v-if="modalNewPost" @close="modalNewPost=false">
                            <template #header>
                                    Agregar Nuevo Post
                            </template>
                            <template #body>
                                <form-post @update-post="getAllPosts();modalNewPost=false" ref="post"></form-post>
                            </template>
                            <template #footer>
                                <button class="btn btn-sm btn-primary" @click="$refs.post.savePost()">Guardar Post</button>
                            </template>
                    </modal-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import FormPost from "../Form/FormPost";
import CommentComponent from "./CommentComponent";
export default {
    name: "MainComponent", components: {CommentComponent, FormPost}, data () {
        return {
            modalNewPost:false,
            posts:[],
            showFormNewComment:false
        }
    },
    mounted() {
      this.getAllPosts()
    },
    methods:{
        async getAllPosts(){
            try{
                let data = {
                    params:{
                        with:['tag','user','comments.user','comments.files']
                    }
                }
                const response = await axios.get('/posts',data)
                this.posts = response.data.posts.map(post=>{
                        post.show_comments=false
                        post.show_new_comment=false
                        return post
                })
            }catch (e) {
                console.error(e.response)
            }
        },
        formatedDate (dateBack) {
            const date = new Date(dateBack)
            const year = date.getFullYear()
            let month = date.getMonth()
            let day = date.getDate()
            month++
            if (day < 10) {
                day = '0' + dt
            }
            if (month < 10) {
                month = '0' + month
            }
            return `${day}/${month}/${year}`
        },
        handleClicked(row){
            this.blockComments = row
        }

    }
}
</script>

<style scoped>

</style>
