<template>
  <span>
    <button @click="showModal = true" type="button" class="dd-btn">
      New Banner
    </button>
    <modal :show="showModal" @close="showModal = false">
      <div class="p-6 rounded max-w-xl w-screen">
        <div v-if="!selected">
          <p class="text-lg text-brand-purple mb-4">
            Select content to feature on home page
          </p>
          <div>
            <input
              type="text"
              class="p-2 bg-gray-100 border border-gray-400 block w-full"
              placeholder="Search for articles or videos by title"
              v-model="query"
            />
          </div>
          <div class="my-6 h-80 overflow-auto">
            <div
              class="flex items-center mb-1 p-1 border-b border-gray-400 cursor-pointer hover:bg-brand-super-soft-purple"
              v-for="result in found_and_sorted"
              :key="`${result.type}_${result.id}`"
              @click="selectContent(result)"
            >
              <p class="text-sm uppercase text-brand-soft-purple w-16">
                {{ result.type }}
              </p>
              <p class="w-64 truncate">{{ result.title.en }}</p>
            </div>
          </div>
        </div>

        <div v-if="selected">
          <p class="text-lg text-brand-purple mb-4">
            Feature this content on the home page banner?
          </p>
          <span
            class="inline-block px-4 py-1 text-sm bg-brand-super-soft-purple border-brand-purple border rounded text-brand-purple uppercase"
            >{{ selected.type }}</span
          >
          <p class="my-6">{{ selected.title.en }}</p>
          <div class="my-6 flex justify-end">
            <button type="button" @click="selected = null" class="mr-4">
              Cancel
            </button>
            <button type="button" @click="createBanner" class="dd-btn">
              Create Banner
            </button>
          </div>
        </div>
      </div>
    </modal>
  </span>
</template>

<script type="text/babel">
import Modal from "@dymantic/modal";
import debounce from "debounce";

export default {
  components: { Modal },
  data() {
    return {
      showModal: false,
      query: "",
      found: [],
      selected: null,
    };
  },

  computed: {
    found_and_sorted() {
      return this.found.sort((a, b) => {
        if (a.title.en > b.title.en) {
          return 1;
        }

        if (a.title.en < b.title.en) {
          return -1;
        }

        return 0;
      });
    },
  },

  watch: {
    query(q) {
      this.search();
    },
  },

  methods: {
    search: debounce(async function () {
      const found_articles = await axios.get(
        `/admin/content/search/articles?q=${this.query}`
      );
      const found_videos = await axios.get(
        `/admin/media/search/videos?q=${this.query}`
      );

      const articles = found_articles.data.map((a) => ({
        type: "article",
        id: a.id,
        title: a.title,
      }));

      const videos = found_videos.data.map((v) => ({
        type: "video",
        id: v.id,
        title: v.title,
      }));

      this.found = [...articles, ...videos];
    }, 250),

    selectContent(content) {
      this.selected = content;
    },

    createBanner() {
      if (!this.selected) {
        return;
      }

      if (this.selected.type === "article") {
        return this.createArticleBanner();
      }

      if (this.selected.type === "video") {
        return this.createVideoBanner();
      }
    },

    createArticleBanner() {
      axios
        .post("/admin/content/banner/feature-article", {
          article_id: this.selected.id,
        })
        .then(({ data }) => window.location.reload());
    },

    createVideoBanner() {
      axios
        .post("/admin/content/banner/feature-video", {
          video_id: this.selected.id,
        })
        .then(({ data }) => window.location.reload());
    },
  },
};
</script>
