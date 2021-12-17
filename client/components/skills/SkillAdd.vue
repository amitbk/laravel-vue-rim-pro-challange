<template>
  <div>
    <div class="relative p-6 flex-auto">
      

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="skill">
          Skill
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="skill" type="text" placeholder="Skill">
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
