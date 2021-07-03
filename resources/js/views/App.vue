<template>
  <div class="da-main-form h-100 row align-items-center mx-auto">
    <div class="col">
      <base-heading />
      <base-form />
      <result-card />
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    message: "Hello World"
  }),

  methods: {}
}
</script>

<style>
.da-main-form {
  max-width: 540px;
}
</style>
