<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <jet-nav-link :href="route('home')">
                    Home
                </jet-nav-link>
                <span v-if="post.city">
                    >
                </span>
                <jet-nav-link :href="route('city', {city_slug : post.city.slug})">
                    {{ post.city ?  ''+post.city.name : 'Cities'}}
                </jet-nav-link>
                <span v-if="post.category">
                    >
                </span>
                <jet-nav-link :href="route('category',{city_slug : post.city.slug, category_slug : post.category.slug})">
                    {{ post.category ?  ''+post.category.name : 'Categories'}}
                </jet-nav-link>
                <span v-if="post.subcategory">
                    >
                </span>
                <jet-nav-link :href="route('subcategory',{city_slug : post.city.slug, category_slug : post.category.slug, subcategory_slug : post.subcategory.slug})">
                    {{ post.subcategory ?  ''+post.subcategory.name : ''}}
                </jet-nav-link>
                <span v-if="post">
                    >
                </span>
                <jet-nav-link :href="route('post',{city_slug : post.city.slug, category_slug : post.category.slug, subcategory_slug : post.subcategory.slug, post_slug : post.slug})">
                    {{ post.title ?  ''+post.title : 'Annonce'}}
                </jet-nav-link>
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
                <button v-if="$page.user">
                    ajouter aux favoris
                </button>
                <button v-if="$page.user">
                    masquer
                </button>
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
