<template>
  <form action="#" @submit.prevent="getResult">
    <div class="form-floating mb-3">
      <input
        type="date"
        class="form-control"
        id="start_date"
        placeholder="Start Date"
        v-model="start_date"
      />
      <label for="start_date">Start Date</label>
    </div>

    <div class="form-floating mb-3">
      <input
        type="date"
        class="form-control"
        id="end_date"
        placeholder="End Date"
        v-model="end_date"
      />
      <label for="end_date">End Date</label>
    </div>

    <button type="submit" class="btn btn-primary btn-lg">Calculate</button>
  </form>
</template>

<script>
export default {
  data: () => ({
    start_date: null,
    end_date: null
  }),

  methods: {
    async getResult() {
      const response = await axios.get("/api/days", {
        params: {
          start_date: this.start_date,
          end_date: this.end_date
        }
      })

      Bus.$emit("show-result", response.data.result)
    },

    clearForm() {
      Object.assign(this.$data, { start_date: null, end_date: null })
    }
  },

  mounted() {
    Bus.$on("clear-form", this.clearForm)
  }
}
</script>

<style></style>
