<style></style>

<template>
    <div class="editor-container">
        <transition name="slide">
            <span class="last-save-indicator"
                  :class="{'success': save_success, 'failed': ! save_success}"
                  v-show="show_save_indicator"
            >{{ save_status }}</span>
        </transition>
        <textarea name="post_body" id="post-body" v-on:change="markDirty">{{ postContent }}</textarea>
        <input type="file" id="post-file-input" style="display: none;" v-on:change="insertImage($event)">
        <modal :show="modalOpen" :wider="true">
            <div slot="header">
                <h5>Insert an Image</h5>
            </div>
            <div slot="body">
                <div class="editor-image-insert-panel"
                     v-on:drop.prevent="handleFiles($event)"
                     v-on:dragenter.prevent="hover=true"
                     v-on:dragover.prevent="hover=true"
                     v-on:dragleave="hover=false"
                     v-bind:class="{'hovering': hover}"
                >
                    <label for="editor-file-picker">
                        <input type="file"
                               id="editor-file-picker"
                               v-on:change="handleFiles($event)"
                               accept=".jpg,.jpeg,.png,.svg"
                        >
                        <img :src="insert_image_src" alt="" v-show="insert_image_src">
                        <p class="prompt-message" v-show="!insert_image_src">Click to insert an image.</p>
                    </label>
                </div>
                <input type="text"
                       class="image-caption-input"
                       v-model="insert_image_caption"
                       placeholder="Add a caption for the image"
                >
            </div>
            <div slot="footer">
                <button class="btn dd-btn btn-grey"
                        v-on:click="closeModal">
                    Cancel
                </button>
                <button class="btn dd-btn btn-light"
                        v-on:click="insertImage"
                        :disabled="!canInsertImage"
                >
                    Insert
                </button>
            </div>
        </modal>
        <modal :show="videoModalOpen" :wider="true">
            <div slot="header">
                <h5><strong>Embed a YouTube or Vimeo Video</strong></h5>
            </div>
            <div slot="body" class="video-embed-form">
                <p>Enter the url for either a YouTube or a Vimeo video you would like to insert.</p>
                <form action="" @submit.prevent="getEmbedCode">
                    <input class="" type="text" v-model="video_url">
                    <button class="" type="submit">Get</button>
                </form>
                <p class="text-success" v-show="video_embed_code">Embed is ready, you may insert it now.</p>
                <p class="text-danger" v-show="embed_fetch_failed">Sorry, we were unable to fetch the embed code for that link. Double check that the url is for youtube or vimeo. Otherwise, refresh and try again. Thanks.</p>
            </div>
            <div slot="footer">
                <button class="btn dd-btn btn-grey"
                        v-on:click="videoModalOpen = false">
                    Cancel
                </button>
                <button class="btn dd-btn"
                        v-on:click="embedVideo"
                        :disabled="!video_embed_code"
                >
                    Insert
                </button>
            </div>
        </modal>
    </div>
</template>

<script type="text/babel">
    module.exports = {

        props: ['post-id', 'post-content', 'content-lang'],

        data() {
            return {
                editor: null,
                uploads: [],
                modalOpen: false,
                videoModalOpen: false,
                hover: false,
                insert_image_src: null,
                insert_image_caption: '',
                save_status: '',
                save_success: false,
                show_save_indicator: false,
                is_dirty: false,
                video_embed_code: '',
                video_url: '',
                embed_fetch_failed: false
            }
        },

        computed: {
            canInsertImage() {
                return this.insert_image_src !== null;
            }
        },

        mounted() {
            let config = require('./editorinit.js');
            config.images_upload_handler = this.imageUploadHandler;
            config.init_instance_callback = (editor) => {
                editor.on('KeyUp', (e) => this.markDirty());
                editor.on('Change', (e) => this.markDirty());
            };
            config.setup = (ed) => {
                ed.addButton('insert-image-btn', this.makeButton('/images/assets/insert_photo_black.png', this.openUploadModal, ''));
                ed.addButton('embed-video', this.makeButton('/images/assets/insert_video.svg', this.openVideoModal, ''));
                ed.addButton('save_button', this.makeButton('/images/assets/save_button_icon.png', () => this.saveContent(false), 'Save'));
            }
            this.$nextTick(() => tinymce.init(config)
                    .then((editors) => this.editor = editors[0])
                    .catch(() => this.declareFailureToLaunch()));

            window.setInterval(() => this.saveContent(true), 10000);
        },

        methods: {
            insertImage(ev) {
                const imgTag = `<img src="${this.insert_image_src}" alt="${this.insert_image_caption}">`;
                const figureTag = `<figure>
                                ${imgTag}
                                <figcaption>${this.insert_image_caption}</figcaption>
                            </figure><p></p>`;
                let html = this.insert_image_caption == '' ? imgTag : figureTag;
                this.editor.insertContent(html);
                this.resetImageInsert();
                this.modalOpen = false;
            },

            resetImageInsert() {
                this.insert_image_src = null;
                this.insert_image_caption = '';
            },

            handleFiles(ev) {
                let files = ev.target.files || ev.dataTransfer.files;
                if (files[0].type.indexOf('image') === -1) {
                    return this.rejectFile();
                }
                this.processImage(files[0]);

            },

            rejectFile() {
                this.hover = false;
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'That is not a valid file type',
                    text: 'Please only use image files that are jpg, png or svg. Thanks.',
                    confirm: true
                });
            },

            processImage(image) {
                const fileReader = new FileReader();
                fileReader.onload = (event) => this.insert_image_src = event.target.result;
                fileReader.readAsDataURL(image);
            },

            getNextUploadTag() {
                const tag = 'tag_' + this.uploads.length;
                this.uploads.push(tag);
                return tag;
            },

            removeUploadTag(tag) {
                this.uploads.splice(this.uploads.indexOf(tag), 1);
            },

            imageUploadHandler(blobInfo, success, failure) {
                let formData = new FormData;
                const uploadTag = this.getNextUploadTag();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                axios.post(`/admin/content/articles/${this.postId}/images`, formData)
                        .then(({data}) => this.uploadSuccess(data, success, uploadTag))
                        .catch((err) => this.uploadFailure(err, failure, uploadTag));
            },


            uploadSuccess(res, callback, tag) {
                this.removeUploadTag(tag);
                callback(res.location);
            },

            uploadFailure(res, callback, tag) {
                this.removeUploadTag(tag);
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'Image Failed to Upload',
                    text: 'There was a problem uploading the image to the server. Please remove the image and try again. Thanks.',
                    confirm: true
                });
                callback('HTTP Error: ' + res.status);
            },

            makeButton(icon, click_fn, button_text) {
                return {
                    text: button_text,
                    icon: true,
                    image: icon,
                    onclick: click_fn
                }
            },

            declareFailureToLaunch() {
                eventHub.$emit('user-alert', {
                    type: 'error',
                    title: 'Unable to load editor',
                    text: 'There is a problem starting up the editor, possibly a network error. Please try again later.',
                    confirm: true
                });
            },

            closeModal() {
                this.modalOpen = false;
            },

            openUploadModal() {
                this.modalOpen = true;
            },

            markDirty() {
                this.is_dirty = true;
            },

            saveContent(auto) {
                if (auto && !this.needsToSave()) {
                    return;
                }
                const content = this.editor.getContent();

                axios.post(`/admin/content/articles/${this.postId}/body/${this.contentLang}`, {article_body: content})
                        .then(() => this.saved(true))
                        .catch(() => this.saved(false));
            },

            needsToSave() {
                return this.uploads.length === 0 && this.is_dirty;
            },

            saved(success) {
                this.save_status = success ? 'Saved' : 'Failed to save';
                this.save_success = success;
                if (success) {
                    this.is_dirty = false;
                }
                this.flashSaveStatus();
            },

            flashSaveStatus() {
                this.show_save_indicator = true;
                window.setTimeout(() => this.show_save_indicator = false, 2000);
            },

            getEmbedCode() {
                this.embed_fetch_failed = false;
                axios.post('/admin/api/video/embed', {url: this.video_url})
                    .then(({data}) => this.video_embed_code = data.embed)
                    .catch(this.embedFetchFailure);
            },

            embedVideo() {
                const embed = `<div class="guanxi-article-video-embed">${this.video_embed_code}</div>`
                this.editor.insertContent(embed);
                this.video_embed_code = '';
                this.videoModalOpen = false;
            },

            embedFetchFailure() {
                this.video_embed_code = '';
                this.embed_fetch_failed = true;
            },

            openVideoModal() {
                this.videoModalOpen = true;
            }
        }
    }
</script>

<style scoped lang="scss" type="text/css">
    .video-embed-form form {
        display: flex;
        justify-content: space-between;
        width: 100%;
        margin-bottom: 20px;

        input {
            flex: 1;
        }

        button {
            width: 8em;
            height: 32px;
            border: 2px solid teal;
            color: teal;

            &:hover {
                background-color: teal;
                color: white;
             }
        }
    }
</style>