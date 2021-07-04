<template>
  <div class="invalid-feedback d-block mb-3 mt-0" v-text="message" v-if="message"></div>
</template>

<script>
export default {
  props: {
    message: {
      type: String,
      required: false
    }
  }
}
</script>
