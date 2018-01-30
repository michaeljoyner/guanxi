<style></style>

<template>
    <div class="tagger-component">
        <p class="h6 text-uppercase">Tags</p>
        <div class="added-tags">
            <div class="spinner"
                 v-show="!ready">
                <div class="bounce1"></div>
                <div class="bounce2"></div>
                <div class="bounce3"></div>
            </div>
            <div v-for="(tag, index) in added_tags"
                 class="tag"
                 :class="{'temp': tag.id === null}">
                {{ tag.name }}
                <span class="tag-delete-btn"
                      v-on:click="removeTag(index)">&times;</span>
            </div>
        </div>
        <div class="tag-input">
            <input type="text"
                   v-model="query"
                   autocomplete="off"
                   class="tagger-input"
                   placeholder="Enter a tag for this article"
                   :disabled="!ready"
                   v-on:keydown.down="down"
                   v-on:keydown.up="up"
                   v-on:keydown.enter="hit"
                   v-on:keydown="letterPress($event)"
            >
            <ul class="list-group suggestion-list">
                <li v-for="match in matches"
                    v-on:mouseenter="setCurrent(match)"
                    v-on:mousedown="hit"
                    :class="{'selected': isCurrent(match)}"
                    class="list-group-item"
                >{{ match.name }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ['article-id'],

        data() {
            return {
                query: '',
                choices: [],
                added_tags: [],
                current: null,
                current_index: null,
                ready: false
            }
        },

        computed: {
            matches() {
                if (this.query === '') {
                    return;
                }
                return this.choices.filter((tag) => tag.name.indexOf(this.query) !== -1);
            }
        },

        mounted() {
            this.fetchPossibleTags();
            this.fetchArticleTags();
        },

        methods: {

            fetchPossibleTags() {
                axios.get('/admin/api/tags')
                     .then(({data}) => this.choices = data)
                     .catch(() => this.alertError(
                         'Unable to fetch list of possible tags. Maybe refresh page if you need them'
                     ));
            },

            fetchArticleTags() {
                axios.get(`/admin/content/articles/${this.articleId}/tags`)
                    .then(({data}) => {
                        this.added_tags = data;
                        this.ready = true;
                    })
                    .catch(() => this.alertError(
                        'Failed to retrieve the article tags. Please refresh the page if you need to work with tags.'
                    ));
            },

            postTag(tagname) {
                axios.post(`/admin/content/articles/${this.articleId}/tags`, {name: tagname})
                    .then(({data}) => this.added_tags = data)
                    .catch(() => this.alertError('There was an issue saving the tag. Please refresh the page'));
            },

            syncAddedTags() {
                axios.put(`/admin/content/articles/${this.articleId}/tags`, {tag_ids: this.getAddedTagIds()})
                    .then(({data}) => this.added_tags = data)
                    .catch(() => this.alertError('There was an issue syncing the tag. Please refresh the page'));
            },

            removeTag(index) {
                this.added_tags.splice(index, 1);
                this.syncAddedTags();
            },

            getAddedTagIds() {
                return this.added_tags.filter((tag) => tag.id).map((validTag) => validTag.id);
            },

            isCurrent(match) {
                return this.current && (this.current.id === match.id);
            },

            setCurrent(match) {
                this.current_index = this.matches.indexOf(match);
                this.current = this.matches[this.current_index];
            },

            down() {
                this.incCurrentIndex();
                this.current = this.matches[this.current_index];
            },

            up() {
                this.decCurrentIndex();
                this.current = this.matches[this.current_index];
            },

            letterPress(ev) {
                if (ev.keyCode === 40 || ev.keyCode === 38) {
                    return;
                }

                this.resetCurrent();
            },

            hit() {
                if (this.current_index === null) {
                    return this.addQueryAsTag();
                }
                this.added_tags.push(this.current);
                this.syncAddedTags();
                this.query = '';
                this.resetCurrent();
            },

            addQueryAsTag() {
                if (this.query === '') {
                    return;
                }
                const tags = this.query.split(',');
                tags.forEach((tag) => this.commitTag(tag.trim()))
                this.query = '';
                this.resetCurrent();
            },

            commitTag(tag) {
                this.postTag(tag);
                this.added_tags.push({id: null, name: tag});
            },

            resetCurrent() {
                this.current = null;
                this.current_index = null;
            },

            incCurrentIndex() {
                if (this.current_index === null) {
                    return this.current_index = 0;
                }

                if (this.current_index >= this.matches.length - 1) {
                    return; // this.current_index = this.matches.length - 1;
                }

                return this.current_index += 1;
            },

            decCurrentIndex() {
                if (this.current_index === 0) {
                    return; // this.current_index = null;
                }

                if (this.current_index >= this.matches.length - 1) {
                    return this.current_index = this.matches.length - 2;
                }

                return this.current_index -= 1;
            },

            alertError(message) {
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'Oh dear! An error!',
                    text: message,
                    confirm: true
                });
            }
        }
    };
</script>