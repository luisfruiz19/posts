<template>
    <div v-if="value">
        <transition name="fade">
            <div class="collapse" >
                <div class="card card-body">
                    <slot #body>
                    </slot>
                </div>
            </div>
        </transition>
    </div>


</template>

<script>
export default {
    name: "CollapseComponent",
    props:{
        value:{
            type:Boolean,
            default:false
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
