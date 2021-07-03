<template>
  <div class="mt-3 alert alert-primary" role="alert" v-show="isShown">
    It is <strong v-text="result"></strong> days from the start date to the end
    date.
  </div>
</template>

<script>
export default {
  data: () => ({
    isShown: false,
    result: null
  }),

  methods: {
    showResult(result) {
      this.result = result
      this.isShown = true

      this.hideResult()
    },

    hideResult() {
      setTimeout(() => {
        this.result = null
        this.isShown = false

        Bus.$emit("clear-form")
      }, 8000)
    }
  },

  mounted() {
    Bus.$on("show-result", this.showResult)
  }
}
</script>
