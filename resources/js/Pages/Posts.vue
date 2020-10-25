<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Annonce
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
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
                {{configDateTime(post.created_at)}}
                <br>
                last update : {{configDateTime(post.updated_at)}}
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
        props: ['post'],
        methods:{
            configDateTime(date) {
                return this.$moment(date).startOf('second').locale('fr').fromNow()
            },
        },
    }
</script>
