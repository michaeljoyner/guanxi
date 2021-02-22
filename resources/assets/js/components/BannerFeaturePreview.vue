<template>
  <div class="max-w-4xl mx-auto">
    <div class="flex justify-end mb-6">
      <label for="image_input">
        <span class="dd-btn">Change image</span>
        <input
          @input="handleFile"
          type="file"
          class="hidden"
          accept="image/*"
          id="image_input"
        />
      </label>
    </div>
    <div class="flex justify-between">
      <div class="w-1/3 bg-black p-6">
        <p class="text-3xl uppercase text-white">
          {{ feature.title }}
        </p>
      </div>
      <div class="flex-1 relative">
        <img
          :class="{ 'opacity-50': waiting }"
          :src="feature_src"
          class="w-full h-full object-cover"
          alt=""
        />
        <svg
          v-show="waiting"
          class="w-20 h-20 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-brand-soft-purple spin-animated"
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"
          />
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
          />
        </svg>
      </div>
    </div>
  </div>
</template>

<script type="text/babel">
export default {
  props: ["feature"],

  data() {
    return {
      waiting: false,
      uploaded_src: null,
    };
  },

  computed: {
    feature_src() {
      return this.uploaded_src ? this.uploaded_src : this.feature.image;
    },
  },

  methods: {
    handleFile({ target }) {
      const file = target.files[0];

      if (!file) {
        return;
      }

      if (file.size >= 10 * 1024 * 1000) {
        this.showError("File is too big", "Try using an image that under 10MB");
        return;
      }

      if (file.type.indexOf("image") !== 0) {
        this.showError(
          "Unacceptable file type",
          "Try using an PNG, JPG or JPEG"
        );
        return;
      }
      this.uploadFile(file);
    },

    uploadFile(file) {
      const fd = new FormData();
      fd.append("image", file);

      this.waiting = true;

      axios
        .post(`/admin/content/banner/features/${this.feature.id}/image`, fd)
        .then(({ data }) => (this.uploaded_src = data.src))
        .catch(() => this.showError("Oh dear", "Unable to save image"))
        .then(() => (this.waiting = false));
    },

    showError(title, message) {
      swal({
        type: "error",
        title: title,
        text: message,
        showConfirmButton: true,
      });
    },
  },
};
</script>
