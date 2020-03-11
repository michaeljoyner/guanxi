<template>
    <div class="">
        <div class="p-4 shadow flex justify-between items-center">
                <div>
                    <div class="w-64">
                        <input type="text"
                               v-model="query"
                               @keydown.enter="selectHighlightedTags"
                               class="input-text"
                               placeholder="search and select tags"
                        >
                    </div>
                </div>
                <div>
                    <button class="mx-4 "
                            @click="unselectAll">
                        Unselect All
                    </button>
                    <button class="mx-4 "
                            @click="selectAllUnusedTags">
                        Select All Unused Tags
                    </button>
                    <button class="mx-4 dd-btn btn-clear-danger"
                            :disabled="selected.length < 1"
                            @click="showDeleteConfirmation = true">
                        Delete Selected Tags
                    </button>
        </div>



        </div>
        <div class="flex flex-wrap my-20">
            <div v-for="tag in tags"
                 class="w-80"
                 :class="{'highlight': query !== '' && tag.name.indexOf(query) !== -1}"
            >
                <input type="checkbox"
                       :value="tag.id"
                       :id="'tag_' + tag.id"
                       v-model="selected"
                       class="dd-labelled-checkbox">
                <label :for="'tag_' + tag.id"
                       class="dd-checkbox-label-left">
                    <span class="tag-name"
                          :class="{'in-use': tag.articles_count > 0}">{{ tag.name }}</span>
                </label>
                <span class="">{{ tag.articles_count }}</span>
            </div>
        </div>
        <modal :show="showDeleteConfirmation" @close="showDeleteConfirmation = false">
            <div class="p-4 w-screen max-w-md">
                <p class="text-xl text-danger">Are you sure?</p>
                <p>You are about to delete {{ selected.length }} tag(s). They will be removed from any articles if they are in use.</p>
                <div class="mt-6 flex justify-end">
                    <button class="dd-btn btn-grey" type="button" @click="showDeleteConfirmation = false">Cancel</button>
                    <button @click="deleteSelectedTags" class="dd-btn btn-red ml-4">Yes, delete them.</button>
                </div>
            </div>
        </modal>
    </div>
</template>

<script type="text/babel">
    import {alertError, alertComplete} from "../utils/alerts";

    export default {

        data() {
            return {
                tags: [],
                selected: [],
                query: '',
                showDeleteConfirmation: false,
            }
        },

        mounted() {
            this.fetchAllTags();
        },

        methods: {

            fetchAllTags() {
                axios.get('/admin/api/tags')
                     .then(({data}) => this.tags = data)
                     .catch(() => this.showError('Unable to fetch tags. Please refresh the page and try again.'));
            },

            removeSelectedTags: function () {
                this.selected.forEach(id => {
                    this.tags.splice(this.tags.indexOf(this.tags.find(tag => tag.id === id)), 1);
                });
                this.selected = [];
            },

            deleteSelectedTags() {
                if (this.selected.length === 0) {
                    return;
                }

                axios.post('/admin/api/tags/delete', {tags: this.selected})
                     .then(() => {
                         this.showDeleteConfirmation = false;
                         alertComplete('The tags have been removed.');
                         this.removeSelectedTags();
                     })
                     .catch(() => {
                         this.showDeleteConfirmation = false;
                         alertError("Unable to delete tags")
                     });


            },

            selectAllUnusedTags() {
                this.tags.filter(tag => tag.articles_count === 0).forEach(tag => this.addIdToSelected(tag.id))
            },

            unselectAll() {
                this.selected = [];
            },

            addIdToSelected: function (id) {
                if (this.selected.indexOf(id) === -1) {
                    this.selected.push(id);
                }
            },

            selectHighlightedTags() {
                this.tags.filter(tag => tag.name.indexOf(this.query) !== -1).forEach(tag => this.addIdToSelected(tag.id));
                this.query = '';
            },
        }

    };
</script>