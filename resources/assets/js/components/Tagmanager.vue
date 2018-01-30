<style></style>

<template>
    <div class="tag-manager-component">
        <div class="tag-actions clearfix">
            <button class="btn dd-btn btn-clear-danger pull-right"
                    @click="deleteSelectedTags">
                Delete Selected Tags
            </button>
            <button class="btn dd-btn btn-light pull-right"
                    @click="unselectAll">
                Unselect All
            </button>
            <button class="btn dd-btn pull-right"
                    @click="selectAllUnusedTags">
                Select All Unused Tags
            </button>
            <input type="text"
                   v-model="query"
                   @keydown.enter="selectHighlightedTags"
                   class="tag-search-input pull-left"
                   placeholder="search and select tags"
            >
        </div>
        <div class="tags-list">
            <div v-for="tag in tags"
                 class="tag-row"
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
    </div>
</template>

<script type="text/babel">
    export default {

        data() {
            return {
                tags: [],
                selected: [],
                query: ''
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
                let self = this;
                swal({
                        title: "Are you sure?",
                        text: "You are about to delete " + self.selected.length + " tags.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, do it!",
                        closeOnConfirm: true
                    },
                    function () {
                        self.sendDeleteRequest();
                    });


            },

            sendDeleteRequest() {
                axios.post('/admin/api/tags', {body: {tags: this.selected}})
                     .then(() => {
                     })
                     .catch(() => this.showError(
                         'Unable to successfully delete tags. Please refresh the page and try again.'
                     ));
                this.removeSelectedTags();
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

            showError(message) {
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'An error has occurred.',
                    text: message,
                    confirm: true
                });
            }
        }

    };
</script>