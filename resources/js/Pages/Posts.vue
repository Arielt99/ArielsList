<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Annonce
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                {{post.title}}
                <br>
                {{post.description}}
                <br>
                category : {{post.category.name}}
                <br>
                subcategory : {{post.subcategory.name}}
                <br>
                city : {{post.city.name}}
                <br>
                posted by : {{post.user.name}}
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
        props: ['post'],

        methods: {
        },
    }
</script>
