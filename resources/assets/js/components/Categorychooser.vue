<style></style>

<template>
    <div class="article-category-selector col-md-12">
        <p class="h6 text-uppercase">Categories</p>
        <div class="category-options">
            <div v-for="category in categories" class="category-choice">
                <input class="dd-labelled-checkbox" type="checkbox" v-on:change="sync" :value="category.id" :id="category.id" v-model="selected_categories">
                <label class="dd-checkbox-label" :for="category.id">{{ category.name }}</label>
            </div>
        </div>
        <div class="article-category-selector-footer">
            <div class="syncing-indicator">
                <div class="spinner" v-show="syncing">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {

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
                this.$http.get('/admin/api/content/categories')
                        .then((res) => this.setupChoices(res.body))
                        .catch((err) => console.log('error occured'))
            },

            setupChoices(categories) {
                this.categories = categories;
                this.selected_categories = JSON.parse(this.currentCategories);
            },

            sync() {
                this.syncing = true;
                this.$http.post('/admin/api/content/articles/' + this.articleId + '/categories', {categories: this.selected_categories})
                        .then((res) => this.syncSuccess(res.body.article_categories))
                        .catch((err) => console.log('fucking errors'));
            },

            syncSuccess(ids) {
                this.syncing = false;
                this.selected_categories = ids;
            }
        }
    }
</script>