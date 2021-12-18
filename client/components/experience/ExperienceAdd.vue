<template>
  <div>
    <div class="relative p-6 flex-auto">
      

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="company_name">
          Company Name
        </label>
        <input v-model="experience.company" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_name" type="text" placeholder="Company name">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
          Role
        </label>
        <input v-model="experience.role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="role" type="text" placeholder="Role">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date_start">
          Start Date
        </label>
        <input v-model="experience.date_start" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_start" type="date" placeholder="Start Date">
      </div>

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="date_end">
          End Date
        </label>
        <input v-model="experience.date_end" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="date_end" type="date" placeholder="End Date">
      </div>

    </div>

    <!--footer-->
    <modal-footer :saveAction="saveAction" @toggle-modal="$emit('toggle-modal')"/>
    
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { PropType } from '@nuxtjs/composition-api'
import ModalFooter from '../widgets/ModalFooter.vue'
import { Experience } from '@/types/api'

export default Vue.extend({
  components: { ModalFooter },
  props: {
    experienceEdit: {
      type: Object as PropType<Experience>,
      default: null
    }
  },
  data() {
    const experience:Experience = {}
    return {
      experience
    }
  },
  mounted() {
      this.experience = !!this.experienceEdit ? {...this.experienceEdit} : this.initExperience() 
  },
  methods: {
    saveAction: function() {
      console.log("Save clicked");

      // decide to create or to update
      let url = !!this.experience.id ? "experiences/"+this.experience.id : "experiences";
      this.$axios.post(url, this.experience).then((res: { data: { data: any } }): void => {
        this.$nuxt.$emit('experience-added', res.data.data as Experience)
        this.experience = this.initExperience();
      })
      
    },

    initExperience: function() {
      return {
        company: "",
        role: "",
        date_start: "",
        date_end: ""
      }
    }
  }
})
</script>
