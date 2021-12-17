<template>
  <div>
    <div class="p-2">
      
      <span class="text-2xl">{{ title }}</span>
      <span class="bg-gray-700 text-white cursor-pointer rounded p-2"  @click="showModal = true">Add New</span>

    </div>
    <div class="col-span-1 bg-white rounded-lg shadow">
      <div class="w-full flex p-6 space-x-2">
        
        <span class="bg-gray-200 p-2 rounded">Test</span>
        <span class="bg-gray-200 p-2 rounded">Test</span>
      </div>
    </div>

    <modal title="Add Experience" :showModal="showModal">
        <skill-add @toggle-modal="showModal = !showModal"/>
    </modal>
  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { User } from '@/client/types/api'
import Modal from '../widgets/Modal.vue'
import SkillAdd from './SkillAdd.vue'
export default Vue.extend({
  components: { Modal, SkillAdd },
  data() {
    return {
      showModal: false
    }
  },
  props: {
    title: {
      type: String,
      required: true,
    },
  },
  computed: {
    is_admin () {
      return Math.random() >= 0.5
    },
  },
})
</script>
