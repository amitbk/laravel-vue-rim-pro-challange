<template>
  <!--footer-->
<div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
    <PushButton @click="toggleModal()" class="ml-2" theme="white">
      Close
    </PushButton>

    <PushButton @click="onSaveClick()" class="ml-2" theme="indigo">
      Add New
    </PushButton>
</div>
</template>

<script>
export default {
  name: "modal-footer",
  props: {
      saveAction: {
          type: Function,
      }
  },
  methods: {
    onSaveClick() {

        this.saveAction();
        this.toggleModal();

    },
    toggleModal() {
      this.$emit("toggle-modal");
    }
  }
}
</script>