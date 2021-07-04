<template>
  <form action="#" @submit.prevent="getResult">
    <div class="form-floating mb-3">
      <input
        type="date"
        class="form-control"
        :class="{ 'is-invalid': errors.start_date }"
        id="start_date"
        placeholder="Start Date"
        v-model="start_date"
      />
      <label for="start_date">Start Date</label>
    </div>
    <input-error :message="errors.start_date" />

    <div class="form-floating mb-3">
      <input
        type="date"
        class="form-control"
        :class="{ 'is-invalid': errors.end_date }"
        id="end_date"
        placeholder="End Date"
        v-model="end_date"
      />
      <label for="end_date">End Date</label>
    </div>
    <input-error :message="errors.end_date" />

    <button ref="button" type="submit" class="btn btn-primary btn-lg">
      Calculate
    </button>
  </form>
</template>

<script>
export default {
  data: () => ({
    start_date: null,
    end_date: null,
    errors: {}
  }),

  methods: {
    async getResult() {
      try {
        this.$refs.button.disabled = true

        const response = await axios.post("/api/days", {
          start_date: this.start_date,
          end_date: this.end_date
        })

        Bus.$emit("show-result", response.data.result)
      } catch (error) {
        this.getValidationErrors(error.response.data.errors)
      } finally {
        this.$refs.button.disabled = false
      }
    },

    getValidationErrors(errors) {
      if (!errors) return

      errors = Object.entries(errors)
      this.errors = {}

      for (let [err, message] of errors) {
        this.$set(this.errors, err, message[0])
      }
    },

    clearForm() {
      Object.assign(this.$data, {
        start_date: null,
        end_date: null,
        errors: {}
      })
    }
  },

  mounted() {
    Bus.$on("clear-form", this.clearForm)
  }
}
</script>

<style></style>
