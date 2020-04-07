<template>
    <div class="editor-container">
        <transition name="slide">
            <span class="fixed z-50 mb-6 mr-6 bottom-0 right-0 text-white bg-primary-blue px-4 py-2 rounded shadow"
                  :class="{'success': save_success, 'failed': ! save_success}"
                  v-show="show_save_indicator"
            >{{ save_status }}</span>
        </transition>
        <textarea name="post_body" id="post-body" v-on:change="markDirty">{{ postContent }}</textarea>
        <input type="file" id="post-file-input" style="display: none;" v-on:change="insertImage($event)">
        <modal :show="modalOpen" @close="modalOpen = false">
            <div class="w-screen max-w-lg p-4">
                <h5 class="text-lg text-brand-purple mb-6">Insert an Image</h5>
                <div class="w-full h-64 border-2"
                     @drop.prevent="handleFiles($event)"
                     @dragenter.prevent="hover=true"
                     @dragover.prevent="hover=true"
                     @dragleave="hover=false"
                     :class="{'border-brand-purple': hover}"
                >
                    <label for="dd-editor-image-upload" class="flex justify-center items-center w-full h-64">
                        <input type="file"
                               class="hidden"
                               id="dd-editor-image-upload"
                               v-on:change="handleFiles($event)"
                               accept=".jpg,.jpeg,.png,.svg"
                        >
                        <img :src="insert_image_src" class="w-full h-full object-cover block" alt="" v-show="insert_image_src">
                        <p class="prompt-message" v-show="!insert_image_src">Click to insert an image.</p>
                    </label>
                </div>
                <div class="my-3">
                    <label for="image-caption" class="text-sm uppercase text-brand-purple">Caption</label>
                    <input type="text"
                           id="image-caption"
                           class="input-text"
                           v-model="insert_image_caption"
                           placeholder="Add an optional caption for the image"
                    >
                </div>

                <div class="flex justify-end">
                    <button class="btn dd-btn btn-grey"
                            v-on:click="closeModal">
                        Cancel
                    </button>
                    <button class="btn dd-btn btn-light ml-4"
                            v-on:click="insertImage"
                            :disabled="!canInsertImage"
                    >
                        Insert
                    </button>
                </div>
            </div>

        </modal>
        <modal :show="videoModalOpen" @close="videoModalOpen = false">
            <div class="p-4 w-screen max-w-xl">
                <h5 class="text-lg text-brand-purple mb-6"><strong>Embed a YouTube or Vimeo Video</strong></h5>
                <div class="">
                    <p>Enter the url for either a YouTube or a Vimeo video you would like to insert.</p>
                    <form @submit.prevent="getEmbedCode" class="flex">
                        <input class="input-text flex-1" type="text" v-model="video_url">
                        <button class="dd-btn" type="submit">Get</button>
                    </form>
                    <p class="text-success" v-show="video_embed_code">Embed is ready, you may insert it now.</p>
                    <p class="text-danger" v-show="embed_fetch_failed">Sorry, we were unable to fetch the embed code for that link. Double check that the url is for youtube or vimeo. Otherwise, refresh and try again. Thanks.</p>
                </div>
                <div class="mt-8 flex justify-end">
                    <button class="btn dd-btn btn-grey"
                            v-on:click="videoModalOpen = false">
                        Cancel
                    </button>
                    <button class="btn dd-btn ml-4"
                            v-on:click="embedVideo"
                            :disabled="!video_embed_code"
                    >
                        Insert
                    </button>
                </div>
            </div>

        </modal>
        <modal :show="showSlideshowsModal" @close="showSlideshowsModal = false">
            <div class="p-4 w-screen max-w-xl">
                <h5 class="text-lg text-brand-purple mb-6"><strong>Include a slideshow</strong></h5>
                <div class="my-8" v-if="slideshows.length === 0">
                    <p>There are no slideshows associated with this article.</p>
                </div>
                <div class="my-8" v-else>
                    <p>Select the slideshow you would like to insert.</p>
                    <div v-for="slideshow in slideshows"
                         :key="slideshow.id"
                         @click="selected_slideshow = slideshow"
                         class="p-2 flex items-center cursor-pointer"
                         :class="{'bg-brand-super-soft-purple border-2 border-brand-purple': selected_slideshow && slideshow.id === selected_slideshow.id}"
                    >
                        <img :src="slideshow.thumb" class="w-20 mr-4">
                        <p class="w-80 truncate">{{ slideshow.title }}</p>
                        <p>{{ slideshow.count }}</p>
                    </div>
                </div>
                <div class="mt-8 flex justify-end">
                    <button class="btn dd-btn btn-grey"
                            v-on:click="showSlideshowsModal = false">
                        Cancel
                    </button>
                    <button class="btn dd-btn ml-4"
                            v-on:click="insertSlideshow"
                            :disabled="!selected_slideshow"
                    >
                        Insert
                    </button>
                </div>
            </div>

        </modal>
    </div>
</template>

<script type="text/babel">
    import config from "./editorinit";
    import {alertError} from "../utils/alerts";

    export default {

        props: ['post-id', 'post-content', 'content-lang', 'slideshows'],

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
                embed_fetch_failed: false,
                showSlideshowsModal: false,
                selected_slideshow: null,
            }
        },

        computed: {
            canInsertImage() {
                return this.insert_image_src !== null;
            }
        },

        mounted() {
            config.images_upload_handler = this.imageUploadHandler;
            config.init_instance_callback = (editor) => {
                editor.on('KeyUp', (e) => this.markDirty());
                editor.on('Change', (e) => this.markDirty());
            };
            config.setup = (ed) => {
                ed.addButton('insert-image-btn', this.makeButton('/images/assets/insert_photo_black.png', this.openUploadModal, ''));
                ed.addButton('embed-video', this.makeButton('/images/assets/insert_video.svg', this.openVideoModal, ''));
                ed.addButton('save_button', this.makeButton('/images/assets/save_button_icon.png', () => this.saveContent(false), 'Save'));
                ed.addButton('insert-slideshow', this.makeButton('/images/assets/slideshare.svg', this.openSlideshowModal, ''));
            };
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
                let html = this.insert_image_caption === '' ? imgTag : figureTag;
                this.editor.insertContent(html);
                this.resetImageInsert();
                this.modalOpen = false;
            },

            insertSlideshow() {
                const {id, slug} = this.selected_slideshow;
                const shrtcode = `<div>[** sl:${id}:${slug} **]</div>`;
                this.editor.insertContent(shrtcode);

                this.selected_slideshow = null;
                this.showSlideshowsModal = false;
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
                alertError('Please only use image files that are jpg, png or svg. Thanks.');
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
                alertError('There is a problem starting up the editor.');
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
            },

            openSlideshowModal() {
                this.showSlideshowsModal = true;
            }
        }
    }
</script>

<style scoped lang="less">
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

    .slide-enter {
        transform: translate3d(200px,0,0);
    }

    .slide-enter-active {
        transform: translate3d(0,0,0);
        transition: .7s;
    }

    .slide-leave {
        transform: translate3d(0,0,0);
    }

    .slide-leave-active {
        transform: translate3d(200px,0,0);
        transition: .7s;
    }
</style>