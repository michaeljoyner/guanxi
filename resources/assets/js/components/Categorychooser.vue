<template>
    <div class="my-12 p-4 shadow">
        <p class="text-sm uppercase text-brand-purple">Categories</p>
        <div class="flex my-6">
            <div v-for="category in categories" class="mr-6">
                <input class="dd-labelled-checkbox" type="checkbox" v-on:change="sync" :value="category.id" :id="category.id" v-model="selected_categories">
                <label class="dd-checkbox-label" :for="category.id">{{ category.name }}</label>
            </div>
        </div>

    </div>
</template>

<script type="text/babel">
    import {alertError} from "../utils/alerts";

    export default {

        props: ['current-categories', 'article-id'],

        data() {
            return {
                categories: [],
                syncing: false,
                selected_categories: []
            }
        },

        mounted() {
          this.fetchCategories();
        },

        methods: {
            fetchCategories() {
                axios.get('/admin/api/content/categories')
                        .then(({data}) => this.setupChoices(data))
                        .catch(() => alertError("Failed to fetch categories."))
            },

            setupChoices(categories) {
                this.categories = categories;
                this.selected_categories = JSON.parse(this.currentCategories);
            },

            sync() {
                this.syncing = true;
                axios.post(`/admin/api/content/articles/${this.articleId}/categories`, {categories: this.selected_categories})
                        .then(({data}) => this.syncSuccess(data.article_categories))
                        .catch(() => alertError("Failed to sync categories."));
            },

            syncSuccess(ids) {
                this.syncing = false;
                this.selected_categories = ids;
            }
        }
    }
</script>