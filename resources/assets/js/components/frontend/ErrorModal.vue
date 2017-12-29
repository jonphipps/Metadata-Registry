<template>
    <div>
        <button type="button" class="btn btn-warning btn-xs" @click="open=true">Show Errors</button>
        <modal v-model="open" title="Errors" @hide="callback" ref="modal" id="error-modal">
            <slot></slot>
            <div slot="footer">
                <btn @click="open=false">Ok</btn>
            </div>
        </modal>
    </div>
</template>
<script>
  export default {
    name: "error-modal",
    data() {
      return {
        open: false
      }
    },
    methods: {
      callback(msg) {
        this.$notify(`Modal dismissed with msg '${msg}'.`)
      }
    }
  }
</script>
<style scoped></style>
