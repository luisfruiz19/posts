<template>
<div>
    <transition name="fade">
        <div class="row">
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control"
                           v-model="form.name"
                           placeholder="Escribe un comentario..."
                           @keyup.enter="saveComment()">
                    <div class="input-group-append">
                        <label for="in">
                            <i class="fas fa-camera fa-2x text-black"></i>
                        </label>
                        <input type="file" hidden id="in" :accept="acceptFile" @change="handleFiles">
                    </div>
                </div>
                <div>
                    <i class="fas fa-times-circle fa-1x text-danger" @click="deletePreviewImage()" v-show="previewImage" style="z-index: 9999;position: relative;top: -100pt;left: 210px"></i>
                    <img src="" alt="" id="img" style="width: 200px;height: 300px;object-fit: contain" v-show="previewImage">
                </div>

            </div>
        </div>

    </transition>
</div>
</template>

<script>
export default {
    name: "CommentForm",
    props:{
        post_id:{
          type:Number,
          default:0,
        }
    },
    data () {
        return {
            form:{
                name:null,
                file:[],
            },
            acceptFile:[
                'image/jpeg',
                'image/png'
            ],
            previewImage:false,
        }
    },
    methods:{
      deletePreviewImage(){
            this.form.file = []
            this.previewImage= false
            const data = document.getElementById('img')
            data.src = ""
      },
      handleFiles(event){
                const file = event.target.files
                for (let i =0;i<file.length;i++){
                    if(!this.acceptFile.includes(file[i].type)){
                        alert("Debe permitir archivos validos.")
                        return;
                    }
                }
              this.form.file = file
              this.previewImage=true
              var output = document.getElementById('img');
              console.log(URL)
              output.src = URL.createObjectURL(this.form.file[0]);
              output.onload = function() {
                  URL.revokeObjectURL(output.src) // free memory
              }

      },
      saveComment(){
          let data = new FormData();
          data.append('description',this.form.name)
          data.append('post_id',this.post_id>0?this.post_id:null)
          for (let i =0;i<this.form.file.length;i++){
              data.append('file',this.form.file[i]);
          }
          let config = {headers:{'Content-Type':'multipart/form-data'}}
          axios.post('/comments',data, config)
                 .then(response=>{
                     this.$emit('update-comments')
                 }).catch(e => console.log(e.response))

      }
    },
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
