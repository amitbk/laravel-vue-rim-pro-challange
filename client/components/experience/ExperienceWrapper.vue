<template>
  <div class="container">
    <div class="bg-teal-50 p-2 shadow rounded">

    <div class="mb-1">

      <div class="w-full flex py-3">
          <span class="flex-1 text-2xl">Experience</span>
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
      <ul v-if="experiences.length === 0 && loading" class="grid grid-cols-1 gap-6 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
        <experience-skeleton v-for="i in 9" :key="`skel-${i}`" />
      </ul>
      <ul v-if="experiences.length &gt; 0" class="grid grid-cols-1 gap-6 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
        <experience-card v-for="(experience, index) in experiences" :key="index" :experience="experience"
          @edit="onEditClick(index, experience)"
          @delete="onDeleteClick(index, experience)"
        />
    </ul>
    </div>

  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Experience } from '@/client/types/api'
import { Experiences } from '@/types/api'
import Modal from '../widgets/Modal.vue'
import ExperienceAdd from './ExperienceAdd.vue'
import { deleteConfirmModal } from "../../utils"

export default Vue.extend({
  components: { Modal, ExperienceAdd },
  data () {
    let experiences:Experiences = []
    let experience:Experience = {}
    let editIndex:Number = null
    const count:number = 2

    return {
      experiences,
      experience,
      editIndex,
      count,
      showModal: false,
      loading: false
    }
  },
  mounted () {
    this.loading = true
    this.get().then(() => {
      this.loading = false
    })

    this.$nuxt.$on('experience-added', (experience: Experience) => {
      if( this.editIndex != null)
        Vue.set(this.experiences, this.editIndex, experience)
      else
        this.experiences.push(experience);

      this.editIndex = null;
      this.experience = {};
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

    onEditClick(index: Number, experience: Experience) {
      this.editIndex = index;
      this.experience = experience;
      this.showModal = true;
    },

    onDeleteClick(index: Number, experience: Experience) {
   
      deleteConfirmModal( this, () => {

        this.$axios.delete('experiences/'+experience.id ).then((res: any) => {
          this.experiences.splice(index, 1);
          this.$toast.success('Experience deleted.')
        })

      })
    }

  },
  beforeDestroy() {
    this.$nuxt.$off('experience-added');
  },

})
</script>
