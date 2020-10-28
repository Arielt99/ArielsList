<template>
    <app-layout :current_city="current_city">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <jet-nav-link :href="route('home')">
                    Home
                </jet-nav-link>
                <span v-if="current_city">
                    >
                </span>
                <jet-nav-link v-if="current_city" :href="route('city', {city_slug : current_city.slug})">
                    {{ current_city ?  ''+current_city.name : 'Cities'}}
                </jet-nav-link>
                <span v-if="current_category">
                    >
                </span>
                <jet-nav-link v-if="current_category" :href="route('category',{city_slug : current_city.slug, category_slug : current_category.slug})">
                    {{ current_category ?  ''+current_category.name : 'Categories'}}
                </jet-nav-link>
                <span v-if="current_subcategory">
                    >
                </span>
                <jet-nav-link v-if="current_subcategory" :href="route('subcategory',{city_slug : current_city.slug, category_slug : current_category.slug, subcategory_slug : current_subcategory.slug})">
                    {{ current_subcategory ?  ''+current_subcategory.name : ''}}
                </jet-nav-link>
                <span v-if="search_content">
                    >
                </span>
                <jet-nav-link v-if="search_content" :href="route('search', {search_content : search_content})">
                    resultat pour {{search_content}}
                </jet-nav-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-if="posts">
                        <post-card v-for="post in PostResearch" v-bind:key=" post.id" :post="post"/>
                    </div>
                </div>
            </div>
        </div>
        <nav class="paginateNav" v-if="pages.length > 1">
            <div class="prev">
                <div v-if="page != 1">
                <button type="button" @click="page = 1" > &#60;&#60;</button>
                <button type="button" @click="page--" > &#60; </button>
                </div>
            </div>
            <div class="miniNav">
                <div v-for="(pageNumber, index) in pages" @click="page = pageNumber" :key="index">
                    <div v-bind:class="{ active: pageNumber==page }" v-if="page-2<=pageNumber && pageNumber<=page+2 || pageNumber<=5 && pageNumber>=page+2 || pageNumber>=pages.length-4 && pageNumber<= page+2">
                        <button type="button">
                        {{pageNumber}}
                        </button>
                    </div>
                </div>
            </div>
            <div class="next">
                <div v-if="page < pages.length">
                <button type="button" @click="page++" > &#62; </button>
                <button type="button" @click="page = pages.length" > &#62;&#62; </button>
                </div>
            </div>
        </nav>
    </app-layout>
</template>
<script>
    import AppLayout from './../Layouts/AppLayout'
    import JetNavLink from './../Jetstream/NavLink'
    import PostCard from './../Components/PostCard'

    export default {
        data () {
            return {
                page: 1,
                perPage: 10,
                pages: [],
                active: true
            }
        },
        components: {
            AppLayout,
            JetNavLink,
            PostCard
        },
        props: ['posts','current_city','current_category','current_subcategory','search_content'],

        methods:{
		setPages () {
            let numberOfPages = Math.ceil(this. posts.length / this.perPage)
            this.pages =[]
			for (let index = 1; index <= numberOfPages; index++) {
				this.pages.push(index)
			}
		},
		paginate () {
			let page = this.page
			let perPage = this.perPage
			let from = (page * perPage) - perPage
			let to = (page * perPage)
			return  this.posts.slice(from, to)
		}
	},
	computed: {
		PostResearch () {
			return this.paginate(this.posts)
        },

	},
    created: function(){
            this.page = 1
            this.setPages()
            this.paginate()

    },
    }
</script>
<style>
.paginateNav{
    display: flex;
    flex-direction: row;
    width: auto;
    justify-content: center;
    height: 20px;
    padding-top: 10px;
}
.paginateNav button{
    border-radius: 3px;
    border: none;
    background-color:#FFFFFF;
    height: 25px;
    width: 30px;
    color:  #6875F5;
    font-weight: bolder;
}
.currentPage{
    justify-content: center;
}
.miniNav{
    width: 200px;
    display: flex;
    justify-content: center;
    height: 100%;
    align-items: center;
    margin: 0px 5px;
}
.miniNav button{
    margin: 0px 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-wrap: nowrap;
}
.prev{
    width: 150px;
    display: flex;
    flex-direction:row ;
    justify-content: flex-end;
    align-items: center;
}
.prev div{
    display: flex;
    flex-direction:row ;
    justify-content: flex-end;
    align-items: center;
}
.prev button{
    margin: 0px 5px;
}
.next{
    width: 150px;
    display: flex;
    flex-direction:row ;
    justify-content: flex-start;
    align-items: center;
}
.next div{
    display: flex;
    flex-direction:row ;
    justify-content: flex-start;
    align-items: center;
}
.next button{
    margin: 0px 5px;
}
.active button{
    background-color:#6875F5;
    color: #FFFFFF;
    display: flex;
}
</style>
