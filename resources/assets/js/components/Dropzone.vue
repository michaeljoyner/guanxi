<template>
    <div class="drop-area h-40"
         v-on:drop.prevent="handleFiles"
         v-on:dragenter.prevent="hover=true"
         v-on:dragover.prevent="hover=true"
         v-on:dragleave="hover=false"
         v-bind:class="{'hovering': hover}">
        <label for="dropzone-input">
            <p class="drag-prompt" v-show="uploads.length === 0">Drag files or click to upload!</p>
            <input v-on:change.stop.prevent="handleFiles" type="file" id="dropzone-input" multiple style="display:none;"/>
            <ul>
                <li v-for="upload in uploads" v-show="upload.status !== 'success'">
                    <p
                            class="image-upload-info"
                            v-bind:class="{'failed': upload.status === 'failed'}"
                    >
                        <span class="upload-progress-bar"
                              v-bind:style="{width: upload.progress + '%'}"/>
                        {{ upload.name }}
                    </p>
                </li>
            </ul>
        </label>
    </div>
</template>

<script type="text/babel">
    import Upload from "./Upload";

    export default  {

        props: ['url'],

        data() {
            return {
                uploads: [],
                hover: false
            }
        },

        methods: {

            handleFiles(ev) {
                var files = ev.target.files || ev.dataTransfer.files;
                for (var i = 0; i < files.length; i++) {
                    this.processFile(files[i]);
                }
            },

            processFile(file) {
                var upload = new Upload(file.name, 'pending');
                axios.post(this.url, this.makeFormData(file), this.makeUploadOptions(upload))
                        .then(({data}) => {
                            upload.setStatus('success');
                            this.uploads.splice(this.uploads.indexOf(upload), 1);
                            this.alertParent(data);
                        })
                        .catch((err) => {console.log(err); upload.setStatus('failed');});
                this.uploads.push(upload);
            },

            makeFormData(file) {
                let fd = new FormData();
                fd.append('file', file);
                return fd;
            },

            makeUploadOptions(upload) {
                return {
                    onUploadProgress: (ev) => upload.setProgress(parseInt(ev.loaded / ev.total * 100))
                }
            },

            alertParent: function (image) {
                eventHub.$emit('image-added', image);
            }


        }
    }
</script>