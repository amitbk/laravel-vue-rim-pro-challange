<template>
  <div>
    <div class="relative p-6 flex-auto">
      

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="company_name">
          Company Name
        </label>
        <input v-model="experience.company" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="company_name" type="text" placeholder="Company name">
        <span v-if="!!errors.company" class="text-red-700">{{ errors.company[0] }}</span>
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
import { Experience } from '../../types/api'

export default Vue.extend({
  components: { ModalFooter },
  props: {
    experienceEdit: {
      type: Object as PropType<Experience>,
      default: null
    }
  },
  data() {
    const errors:Object = {}

    return {
      experience: {} as Experience,
      errors
    }
  },
  mounted() {
      this.experience = !!this.experienceEdit ? {...this.experienceEdit} : this.initExperience() 
  },
  methods: {
    saveAction: function() {
      console.log("Save clicked");

      let self = this;
      return new Promise((resolve, reject) => {
        // decide to create or to update
        let url = !!this.experience.id ? "experiences/"+this.experience.id : "experiences";
        this.$axios.post(url, this.experience)
                          .then((res: { data: { data: any } }): void => {
                            self.$nuxt.$emit('experience-added', res.data.data as Experience)
                            self.experience = self.initExperience();

                            this.$toast.success('New experience added.')

                            resolve(res)
                          }).catch((err) => {
                            console.log(err.response.data.errors)
                            self.errors = err.response.data.errors;
                            reject(err)
                          })
        });
      
    },

    initExperience: function() {
      let experience = {} as Experience
      return experience
    }
  }
})
</script>
