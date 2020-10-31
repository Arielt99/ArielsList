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
                    <h2 class="font-bold text-3xl text-gray-800 leading-tight text-center py-5 inline-block align-middle items-center w-full">{{post.title}}</h2>
                    <div class="flex justify-end">
                        <button @click="addToFavorite()" v-if="$page.user" class="inline-flex items-center px-3 py-1 my-2 mx-1 bg-yellow-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-200 active:bg-yellow-400 focus:outline-none focus:border-yellow-400 focus:shadow-outline-gray transition ease-in-out duration-150">
                            ★
                        </button>
                        <button v-if="$page.user" class="inline-flex mr-5 items-center px-3 py-1 my-2 mx-1 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red active:bg-red-600 transition ease-in-out duration-150">
                            ✕
                        </button>
                    </div>
                    <div class="px-8">
                        <div class="flex justify-around pb-5">
                            <p class="inline-flex items-center">city : {{post.city.name}}</p>
                            <p class="inline-flex items-center">category : {{post.category.name}}</p>
                            <p class="inline-flex items-center">category : {{post.category.name}}</p>
                        </div>
                        <p id="description" class="h-auto inline-flex items-center">{{post.description}}</p>
                        <div class="flex flex-row justify-around py-5">
                            <p class="inline-flex items-center">posté par : {{post.user.name}} {{configDateTime(post.created_at)}}</p>
                            <p class="inline-flex items-center">dernière modification : {{configDateTime(post.updated_at)}}</p>
                            <div>
                                <share-facebook id="share" :url="currentURL"/>
                                <share-twitter id="share" :url="currentURL"/>
                                <share-google-plus id="share" :url="currentURL"/>
                                <share-line id="share" :url="currentURL"/>
                            </div>
                        </div>
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
                addFav: this.$inertia.form({
                    '_method': 'PUT',
                    post_slug: this.post.slug,
                }, {
                    bag: 'addFavorite',
                }),
            }
        },
        props: ['post'],
        methods:{
            configDateTime(date) {
                return this.$moment(date).startOf('second').locale('fr').fromNow()
            },
            addToFavorite(){
            this.addFav.put(route('addfavorite'), {
                preserveScroll: true
            })
            }
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
#description{
    min-height: 200px;
    margin: auto;
}
</style>
