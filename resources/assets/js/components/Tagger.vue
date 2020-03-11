<template>
    <div class="">
        <p class="text-sm uppercase text-brand-purple mb-6">Tags</p>
        <div class="w-64 relative">
            <input type="text"
                   v-model="query"
                   autocomplete="off"
                   class="input-text w-64"
                   placeholder="Enter a tag for this article"
                   :disabled="!ready"
                   v-on:keydown.down="down"
                   v-on:keydown.up="up"
                   v-on:keydown.enter="hit"
                   v-on:keydown="letterPress($event)"
            >
            <ul class="absolute z-50 left-0 w-full bg-white shadow" style="top: 2.5rem;">
                <li v-for="match in matches"
                    v-on:mouseenter="setCurrent(match)"
                    v-on:mousedown="hit"
                    :class="{'bg-brand-super-soft-purple': isCurrent(match)}"
                    class="cursor-pointer hover:bg-gray-100 p-2"
                >{{ match.name }}
                </li>
            </ul>
        </div>
        <div class="">

            <div v-for="(tag, index) in added_tags"
                 class="inline-flex flex-wrap text-white bg-brand-soft-purple px-2 rounded my-4 mr-4"
                 :class="{'temp': tag.id === null}">
                <span>{{ tag.name }}</span>
                <span class="border-l border-brand-purple pl-1 ml-1 text-lg text-white cursor-pointer hover:text-brand-purple"
                      v-on:click="removeTag(index)">&times;</span>
            </div>
        </div>

    </div>
</template>

<script type="text/babel">
    import {alertError} from "../utils/alerts";

    export default {

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
                     .catch(() => alertError('Unable to fetch list of possible tags.'));
            },

            fetchArticleTags() {
                axios.get(`/admin/content/articles/${this.articleId}/tags`)
                    .then(({data}) => {
                        this.added_tags = data;
                        this.ready = true;
                    })
                    .catch(() => alertError('Failed to retrieve the article tags.'));
            },

            postTag(tagname) {
                axios.post(`/admin/content/articles/${this.articleId}/tags`, {name: tagname})
                    .then(({data}) => this.added_tags = data)
                    .catch(() => alertError('There was an issue saving the tag.'));
            },

            syncAddedTags() {
                axios.put(`/admin/content/articles/${this.articleId}/tags`, {tag_ids: this.getAddedTagIds()})
                    .then(({data}) => this.added_tags = data)
                    .catch(() => alertError('There was an issue syncing the tags.'));
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
            }
        }
    };
</script>