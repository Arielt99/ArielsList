<template>
    <div>
        <h3 class="h-15 flex text-center flex-wrap justify-center items-center w-max-content text-2xl cursor-pointer font-bold">
            <jet-nav-link class="h-15 text-2xl cursor-pointer font-bold" :href="route('category',{city_slug : current_city.slug, category_slug : category.slug} )">
            {{category.name}}
            </jet-nav-link>
        </h3>
        <div id="subcat" :class="'grid grid-cols-' + spliceSubCategories(category).sizeCol">
            <div v-for="subcategory in category.subcategories" v-bind:key="subcategory.id" >
                <p class="h-8 flex justify-center cursor-pointer">
                    <jet-nav-link class="h-8 cursor-pointer" :href="route('subcategory',{city_slug : current_city.slug, category_slug : category.slug, subcategory_slug : subcategory.slug} )">
                    {{subcategory.name}}
                    </jet-nav-link>
                </p>
            </div>
        </div>
    </div>
</template>
<script>
    import JetNavLink from './../Jetstream/NavLink'

    export default {
        components: {
            JetNavLink,
        },

        data() {
            return {
            }
        },

        props: ['category','current_city'],

        methods: {
            spliceSubCategories (category) {
                let sizeCol = Math.ceil((category.subcategories.length)/15)
                return {
                    sizeCol: sizeCol,
                }
            }
        }
    }
</script>
<style>
</style>
