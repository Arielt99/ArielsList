<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <jet-nav-link :href="route('home')">
                    Home
                </jet-nav-link>
                <span class="inline-flex items-center" v-if="post.city">
                    >
                </span>
                <jet-nav-link :href="route('city', {city_slug : post.city.slug})">
                    {{ post.city ?  ''+post.city.name : 'Cities'}}
                </jet-nav-link>
                <span class="inline-flex items-center" v-if="post.category">
                    >
                </span>
                <jet-nav-link :href="route('category',{city_slug : post.city.slug, category_slug : post.category.slug})">
                    {{ post.category ?  ''+post.category.name : 'Categories'}}
                </jet-nav-link>
                <span class="inline-flex items-center" v-if="post.subcategory">
                    >
                </span>
                <jet-nav-link :href="route('subcategory',{city_slug : post.city.slug, category_slug : post.category.slug, subcategory_slug : post.subcategory.slug})">
                    {{ post.subcategory ?  ''+post.subcategory.name : ''}}
                </jet-nav-link>
                <span class="inline-flex items-center" v-if="post">
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
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center py-5 inline-block align-middle items-center w-full">{{post.title}}</h2>
                    <div class="px-8">
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
                    <button v-if="$page.user">
                        ajouter aux favoris
                    </button>
                    <button v-if="$page.user">
                        masquer
                    </button>
                    <div>
                        <share-facebook id="share" :url="currentURL"/>
                        <share-twitter id="share" :url="currentURL"/>
                        <share-google-plus id="share" :url="currentURL"/>
                        <share-line id="share" :url="currentURL"/>
                    </div>
                </div>
            </div>

        </div>
    </app-layout>
</template>

<script>
    import { ShareFacebook, ShareTwitter, ShareGooglePlus, ShareHatena, ShareLine } from 'vue-share-social'
    import AppLayout from './../Layouts/AppLayout'
    import JetNavLink from './../Jetstream/NavLink'

    export default {
        components: {
            AppLayout,
            JetNavLink,
            ShareFacebook,
            ShareTwitter,
            ShareGooglePlus,
            ShareHatena,
            ShareLine
        },
        data () {
            return {
                currentURL: window.location.href,
            }
        },
        props: ['post'],
        methods:{
            configDateTime(date) {
                return this.$moment(date).startOf('second').locale('fr').fromNow()
            },
        },
    }
</script>

<style>
#share > svg{
    width: 80% !important;
    height: 80% !important;
    margin: auto;
    margin-top: 10%;
    margin-bottom: 10%;
}
</style>
