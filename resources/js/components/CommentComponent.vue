<template>
    <transition name="fade">
        <div v-if="commentsByProps.length>0">
            <div class="card card-body" v-for="(comment,index) in commentsByProps" :key="'comment_'+index">
                <strong>De: {{comment.user.name}}</strong>
                <p>
                    {{comment.description}}
                </p>
                <div v-if="comment.files.length>0" style="display: inline" v-for="(file,index) in comment.files" :key="'file_'+index">
                    <div>
                        <a :href="file.url" target="_blank">
                            <img :src="file.url" alt="" style="width: 200px;height: 300px;object-fit: contain">
                        </a>
                    </div>
                </div>
            </div>
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
            commentsByProps:[],
            files:[],
        }
    },
    mounted() {
        this.getCommentsByOrder()
    },
    methods:{
        getCommentsByOrder(){
          this.commentsByProps = this.comments.sort(function (a,b){
              return b.id - a.id
          })
        },
    },
    watch:{

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
