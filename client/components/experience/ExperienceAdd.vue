<template>
  <div>
    <div class="relative p-6 flex-auto">
      

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="company_name">
          Company Name
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_name" type="text" placeholder="Company name">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
          Role
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" type="text" placeholder="Role">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="year_start">
          Start Year
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="year_start" type="text" placeholder="Start Year">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="year_end">
          End Year
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="year_end" type="text" placeholder="End Year">
      </div>

    </div>

    <!--footer-->
    <modal-footer :saveAction="saveAction" @toggle-modal="$emit('toggle-modal')"/>
    
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import ModalFooter from '../widgets/ModalFooter.vue'
export default Vue.extend({
  components: { ModalFooter },
  methods: {
    saveAction: function() {
      console.log("Save clicked");
    }
  }
})
</script>
