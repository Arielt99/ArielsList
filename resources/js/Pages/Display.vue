<template>
    <app-layout :current_city="current_city">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <jet-nav-link :href="route('home')">
                    {{ current_city ?  ''+current_city.name : 'Cities'}}
                </jet-nav-link>
                <span v-if="current_city">
                    >
                </span>
                <jet-nav-link :href="route('city', {city_slug : current_city.slug})">
                    {{ current_category ?  ''+current_category.name : 'city'}}
                </jet-nav-link>
                <span v-if="current_category">
                    >
                </span>
                <jet-nav-link v-if="current_subcategory" :href="route('category',{city_slug : current_city.slug, category_slug : current_category.slug} )">
                    {{ current_subcategory ?  ''+current_subcategory.name : ''}}
                </jet-nav-link>
                <span v-if="current_subcategory">
                    >
                </span>
                <jet-nav-link :href="'#'">
                   Results
                </jet-nav-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-3 p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <post-card v-if="posts" :post="posts"/>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from './../Layouts/AppLayout'
    import JetNavLink from './../Jetstream/NavLink'
    import PostCard from './../Components/PostCard'

    export default {
        components: {
            AppLayout,
            JetNavLink,
            PostCard
        },
        props: ['posts','current_city','current_category','current_subcategory'],

        methods: {
        },
    }
</script>
