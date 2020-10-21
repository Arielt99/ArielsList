<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Votre ville
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex text-center justify-center items-center h-10 cursor-pointer" v-for="city in cities" v-bind:key="city.id">
                        <jet-nav-link :href="'city/'+city.name">
                                {{city.name}}
                        </jet-nav-link>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import JetNavLink from './../Jetstream/NavLink'

    export default {
        components: {
            AppLayout,
            JetNavLink,
        },
        props: ['cities'],

        methods: {
        },
    }
</script>
