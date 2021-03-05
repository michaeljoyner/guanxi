<template>
  <div class="loaded-content">
    <div class="my-12 text-center">
      <button
        @click="fetchContent"
        v-show="remaining"
        class="btn focus:outline-none"
        :class="{ 'alt-state': fetching }"
      >
        <span v-show="!fetching">{{ buttonText }}</span>
        <div class="spinner flex justify-center" v-show="fetching">
          <div class="w-3 h-3 bg-black rounded-full m-2"></div>
          <div class="w-3 h-3 bg-black rounded-full m-2"></div>
          <div class="w-3 h-3 bg-black rounded-full m-2"></div>
        </div>
      </button>
    </div>
  </div>
</template>

<script type="text/babel">
export default {
  props: ["url", "page-size", "has-more", "container-id", "button-text"],

  data() {
    return {
      remaining: null,
      nextPage: 2,
      fetching: false,
    };
  },

  mounted() {
    this.remaining = this.hasMore;
  },

  methods: {
    fetchContent() {
      this.fetching = true;
      axios
        .get(`${this.url}?page=${this.nextPage}`)
        .then(({ data }) => this.onSuccess(data))
        .catch((err) => this.onFailure(err));
    },

    onSuccess(data) {
      this.fetching = false;
      this.remaining = data.remaining;
      this.nextPage++;
      this.addContent(data.content_html);
    },

    onFailure(err) {
      this.fetching = false;
      console.log(err);
    },

    addContent(content) {
      document.querySelector("#" + this.containerId).innerHTML += content;
    },
  },
};
</script>

<style scoped>
.spinner > div {
  animation-name: fadeInOut;
  animation-direction: alternate;
  animation-iteration-count: infinite;
  animation-timing-function: ease-in-out;
  animation-duration: 1s;
  animation-fill-mode: forwards;
}

.spinner > div:nth-child(1) {
  animation-delay: 0.2s;
}

.spinner > div:nth-child(2) {
  animation-delay: 0.4s;
}

.spinner > div:nth-child(3) {
  animation-delay: 0.6s;
}

@keyframes fadeInOut {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
</style>
