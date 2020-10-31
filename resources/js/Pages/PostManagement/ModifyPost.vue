<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                <jet-nav-link :href="route('home')">
                    Home
                </jet-nav-link>
                <span class="inline-flex items-center">
                    >
                </span>
                <jet-nav-link :href="route('userPosts')">
                    Vos Annonces
                </jet-nav-link>
                <span class="inline-flex items-center">
                    >
                </span>
                <jet-nav-link :href="route('updatepost',{post_slug : post.slug})">
                    Modification
                </jet-nav-link>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Title -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="title" value="Titre" />
                        <jet-input v-model="modifyPost.title" id="title" type="title" ref="title" class="mt-1 block w-full" />
                        <jet-input-error :message="modifyPost.error('title')" class="mt-2" />
                    </div>
                    <!-- Description -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="description" value="Description" />
                        <textarea v-model="modifyPost.description" id="description" type="description" class="form-input h-40 block rounded-md shadow-sm mt-1 w-full border text-gray-700 py-2.5 px-4 pr-8 rounded leading-tight focus:outline-none" />
                        <jet-input-error :message="modifyPost.error('description')" class="mt-2" />
                    </div>
                    <!-- City -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="city" value="Ville" />
                        <select v-model="modifyPost.city" ref="city" class="form-input block rounded-md shadow-sm mt-1 w-full border text-gray-700 py-2.5 px-4 pr-8 rounded leading-tight focus:outline-none" id="grid-state">
                            <option v-for="city in cities" :value="city.id" v-bind:key="city.id">{{city.name}}</option>
                        </select>
                        <jet-input-error :message="modifyPost.error('city')" class="mt-2" />
                    </div>
                    <!-- Category & subcategory -->
                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="subcategory" value="Categorie et sous categorie" />
                        <select v-model="modifyPost.subcategory" ref="subcategory" class=" form-input block rounded-md shadow-sm mt-1 w-full border text-gray-700 py-2.5 px-4 pr-8 rounded leading-tight focus:outline-none" id="grid-state">
                            <optgroup v-for="category in categories" v-bind:key="category.id" :label="category.name">
                                {{category.name}}
                                <option v-for="subcategory in category.subcategories" :value="subcategory.id" v-bind:key="subcategory.id">
                                    {{subcategory.name}}
                                </option>
                            </optgroup>
                        </select>
                        <jet-input-error :message="modifyPost.error('subcategory')" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-4">
                        <jet-label for="isActive" value="Visible"/>
                        <input v-model="modifyPost.isActive" type="checkbox" ref="isActive">
                    </div>

                    <jet-action-message :on="modifyPost.recentlySuccessful" class="mr-3">
                        Saved.
                    </jet-action-message>
                    <button @click="addPost()" type="submit" :class="{ 'opacity-25': modifyPost.processing }"  :disabled="modifyPost.processing" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                        Modifier
                    </button>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import JetActionMessage from './../../Jetstream/ActionMessage'
    import JetNavLink from './../../Jetstream/NavLink'
    import AppLayout from './../../Layouts/AppLayout'
    import JetFormSection from './../../Jetstream/FormSection'
    import JetButton from './../../Jetstream/Button'
    import JetInput from './../../Jetstream/Input'
    import JetInputError from './../../Jetstream/InputError'
    import JetLabel from './../../Jetstream/Label'


    export default {
        components: {
            JetActionMessage,
            JetNavLink,
            AppLayout,
            JetButton,
            JetInput,
            JetFormSection,
            JetInputError,
            JetLabel,
        },

        props:['cities', 'categories', 'post'],

        data() {
            return {
                selectedSubcategory:null,
                selectedCity:null,
                modifyPost: this.$inertia.form({
                    '_method': 'PUT',
                    title: this.post.title,
                    description: this.post.description,
                    city: this.post.city.id,
                    subcategory: this.post.subcategory.id,
                    isActive: this.post.isActive,
                }, {
                    bag: 'modifyPost',
                }),
            }
        },

        methods: {
            addPost() {
            this.modifyPost.post(route('updatecurrentpost',{post_slug : this.post.slug}), {
                preserveScroll: true
            }).then(() => {
                this.modifyPost = this.$inertia.form({
                    '_method': 'PUT',
                    title: this.post.title,
                    description: this.post.description,
                    city: this.post.city.id,
                    subcategory: this.post.subcategory.id,
                    isActive: this.post.isActive,
                }, {
                    bag: 'modifyPost',
                })
            })
            },
        },
    }
</script>
