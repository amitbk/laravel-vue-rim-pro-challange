<template>
  <!--footer-->
<div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
    <button class="text-black-500 bg-transparent border border-solid border-black-500 hover:bg-black-500 hover:text-black active:bg-black-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="toggleModal()">
        Close
    </button>
    <button class="text-black-500 bg-transparent border border-solid border-black-500 hover:bg-black-500 hover:text-black active:bg-black-600 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150" type="button" v-on:click="onSaveClick()">
        Save Changes
    </button>
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