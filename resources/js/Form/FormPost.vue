<template>
<div>
    <div class="form-group">
        <input type="text" v-model="form.name" class="form-control" placeholder="Escribe el nombre del post">
    </div>
    <div class="form-group">
        <select class="form-control" v-model="form.tag_id">
            <option :value="null" selected disabled>-- Seleccione Tag --</option>
            <option :value="tag.id" v-for="(tag,index) in tags" :key="index">
                {{tag.name}}
            </option>
        </select>
    </div>
</div>
</template>

<script>
export default {
    name: "FormPost",
    data () {
        return {
            form:{
                name:null,
                tag_id:null
            },
            tags:[],
        }
    },
    mounted() {
        this.getAllTags();
    },
    methods:{
        async getAllTags(){
            try{
                let data = {}
                const response = await axios.get('/tags',data)
                this.tags = response.data.tags
            }catch (e) {
                console.log(e)
            }
        },
        async savePost(){
            try{
                let data = {...this.form}
                const response = await axios.post('/posts',data)
                this.$emit('update-post')
            }catch (e) {
                console.log(e)
            }
        },
    }
}
</script>

<style scoped>

</style>
