<template>
  <div class="container">
    <div class="bg-teal-50 p-2 shadow rounded">

      <div class="mb-1">
        <div class="w-full flex py-3">
            <span class="flex-1 text-2xl">🚀 Experience</span>
            <PushButton @click="showModal = true" class="" theme="indigo">
              Add New
            </PushButton>
        </div>
          

        <modal title="🚀 Add Your Past Experiences" :showModal="showModal">
          <experience-add
            :experienceEdit="experience"
            @toggle-modal="showModal = !showModal"
            />
        </modal>

      </div>

      <!-- Skeleton -->
      <ul v-if="experiences.length === 0 && loading" class="grid grid-cols-1 gap-2 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
        <experience-skeleton v-for="i in 2" :key="`skel-${i}`" />
      </ul>
      <!-- Experiences lists -->
      <ul v-if="experiences.length &gt; 0" class="grid grid-cols-1 gap-2 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
        <experience-card v-for="(experience, index) in experiences" :key="index" :experience="experience"
          @edit="onEditClick(index, experience)"
          @delete="onDeleteClick(index, experience)"
        />
      </ul>

    </div>

  </div>
</template>

<script lang="ts">
import Vue from 'vue'

import { Experience, Experiences } from '../../types/api'
import { deleteConfirmModal } from "../../utils"

import Modal from '../widgets/Modal.vue'
import ExperienceAdd from './ExperienceAdd.vue'

export default Vue.extend({
  components: { Modal, ExperienceAdd },
  data () {
    let experiences:Experiences = []

    return {
      experiences,
      experience: {} as Experience, 
      editIndex: null as number | null, // used to set which `experience` is being edited
      showModal: false, // used to manage modal state to add experiences
      loading: false as Boolean // usefull to decide when to show skeleton
    }
  },
  mounted () {
    this.loading = true
    // fet All experiences
    this.get().then(() => {
      this.loading = false
    })

    // Event listener: To detect when experience will be added or updated.
    // This will update `experiences` object to update on UI
    this.$nuxt.$on('experience-added', (experience: Experience) => {
      if( this.editIndex != null)
        Vue.set(this.experiences, this.editIndex, experience)
      else
        this.experiences.push(experience);

      this.editIndex = null;
      this.experience = {} as Experience;
    })
  },
  
  methods: {
    
    // fetch initial data
    async get (): Promise<void> {
      await this.$sleep(2000)
      this.experiences = (
        await this.$axios.get('experiences')
      ).data.data as Experiences
    },

    // On `Experience edit`, set Experience to edit and show modal
    onEditClick(index: number, experience: Experience) {
      this.editIndex = index;
      this.experience = experience;
      this.showModal = true;
    },

    // on `Experience delete`, show confirmation modal and delete on confirm
    onDeleteClick(index: number, experience: Experience) {
      deleteConfirmModal( this, () => {

        this.$axios.delete('experiences/'+experience.id ).then((res: any) => {
          this.experiences.splice(index, 1);
          this.$toast.success('Experience deleted.')
        })

      })
    }

  },
  beforeDestroy() {
    // Remove event listener beforeDestroying the component
    this.$nuxt.$off('experience-added');
  },

})
</script>
