<style></style>

<template>
    <div class="article-category-selector col-md-12 featured-article-selector">
        <p class="h6 text-uppercase component-title">Featured Article</p>
        <p class="lead">Do you want this to be the featured article on the homepage?</p>
        <div class="switch-box">
            <toggle-switch identifier="featured"
                           true-label="yes"
                           false-label="no"
                           :initial-state="initiallyFeatured"
                           :toggle-url="'/admin/content/articles/' + articleId + '/feature'"
                           toggle-attribute="feature"
                           v-on:changed-toggle-state="this.updateFeatured"
            ></toggle-switch>
        </div>
        <div class="current-featured-block">
            <p>
                <strong>Current Featured: </strong>
                <a :href="'/admin/content/articles/' + current_featured.id"
                   v-show="!isCurrent"
                >{{ current_featured.title }}</a>
                <span v-show="isCurrent">This is the currently featured article</span>
            </p>
        </div>
    </div>
</template>

<script type="text/babel">
    export default {

        props: ['article-id', 'initially-featured'],

        data() {
            return {
                current_featured: {title: null, id: null},
                is_featured: null
            }
        },

        computed: {
            isCurrent() {
                return this.current_featured.id === parseInt(this.articleId)
            }
        },

        mounted() {
            this.fetchCurrentFeatured();
        },

        methods: {

            fetchCurrentFeatured() {
                this.$http.get('/admin/content/articles/featured')
                        .then(({body}) => this.current_featured = body)
                        .catch(err => console.log(err));
            },

            updateFeatured(toggleState) {
                if(toggleState) {
                    this.current_featured.id = this.articleId;
                    return;
                }

                this.fetchCurrentFeatured();
            }
        }

    }
</script>