<template>
    <app-layout :current_city="current_city">
        <template #header>
            <div class="flex flex-row justify-between">
                <h2 class="flex flex-row font-semibold text-xl text-gray-800 leading-tight">
                    <jet-nav-link :href="route('home')">
                        Home
                    </jet-nav-link>
                    <span class="inline-flex items-center">
                        >
                    </span>
                    <jet-nav-link :href="route('userPosts')">
                        Vos Annonces
                    </jet-nav-link>
                </h2>
                <div>        <!-- Research -->
                    <div class="pt-2 relative mx-auto text-gray-600">
                        <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
                        type="search" name="search" v-model="Search"  placeholder="rechercher">
                        <button class="absolute right-0 top-0 mt-5 mr-4">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
                            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                            width="512px" height="512px">
                            <path
                            d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                        </button>
                    </div>
                </div>
            </div>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid p-6 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div v-if="posts">
                        <current-user-post-card v-for="post in PostResearch" v-bind:key=" post.id" :post="post"/>
                    </div>
                    <div class="text-center" v-if="!posts[0]">
                        wow so empty !
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
    import AppLayout from './../../Layouts/AppLayout'
    import JetNavLink from './../../Jetstream/NavLink'
    import CurrentUserPostCard from './../../Components/CurrentUserPostCard'

    export default {
        data () {
            return {
                page: 1,
                perPage: 10,
                pages: [],
                active: true,
                Search: '',
            }
        },
        components: {
            AppLayout,
            JetNavLink,
            CurrentUserPostCard
        },
        props: ['posts','cities','current_city','current_category','current_subcategory','search_content','route_name'],

        methods:{
		setPages () {
            let numberOfPages = Math.ceil(this. ResearchResult.length / this.perPage)
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
			return  this.ResearchResult.slice(from, to)
		}
	},
	computed: {
        ResearchResult(){
            return this.posts.filter(post =>{
            return post.title.toLowerCase().includes(this.Search.toLowerCase())
            })
        },
		PostResearch () {
            return this.paginate(this.ResearchResult)
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
