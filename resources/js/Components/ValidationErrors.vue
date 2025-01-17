<template>
    <transition name="fade">
        <div v-if="hasErrors" class="w-full bg-red-400 rounded p-4 text-white my-2">
            <div class="grid grid-cols-3">
                <div class="font-bold text-xl col-span-2">Ops! algo de errado aconteceu.</div>
                <div class="text-right"><i class="fas fa-times text-xl cursor-pointer" @click="fechar"></i></div>
            </div>

            <ul class="mt-3 list-disc list-inside text-sm list-none">
                <li class="ml-4" v-for="(error, key) in errors" :key="key">{{ error }}</li>
            </ul>
        </div>
    </transition>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        computed: {
            errors() {
                return this.$page.props.errors
            },

            hasErrors() {
                return Object.keys(this.errors).length > 0;
            },

            fechar(){
                this.$page.props.errors = []
            },
        }
    })
</script>