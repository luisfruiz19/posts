<template>
    <div class="card">
        <div class="card-header">
            <slot name="header">
            </slot>
        </div>
        <div class="card-body">
            <slot name="body">
            </slot>
            <slot name="custom">

            </slot>
        </div>
    </div>
</template>

<script>
export default {

    data() {
        return {

        }
    },
}
</script>

<style>

</style>
