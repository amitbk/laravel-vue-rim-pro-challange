<template>
  <div class="container p-2">
    <div class="p-2 mb-1">
      <span class="text-2xl">Experience</span>
      <span class="bg-gray-700 text-white cursor-pointer rounded p-2"  @click="showModal = true">Add New</span>

      <modal title="Add Experience" :showModal="showModal">
        <experience-add
          :experienceEdit="experience"
          @toggle-modal="showModal = !showModal"
          />
      </modal>

    </div>
    <ul v-if="experiences.length === 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
        <experience-skeleton v-for="i in 9" :key="`skel-${i}`" />
      </ul>
      <ul v-if="experiences.length &gt; 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
        <experience-card v-for="(experience, index) in experiences" :key="index" :experience="experience"
          @edit="onEditClick(index, experience)"
          @delete="onDeleteClick(index, experience)"
        />
    </ul>
  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Experience } from '@/client/types/api'
import { Experiences } from '@/types/api'
import Modal from '../widgets/Modal.vue'
import ExperienceAdd from './ExperienceAdd.vue'

export default Vue.extend({
  components: { Modal, ExperienceAdd },
  data () {
    let experiences:Experiences = []
    let experience:Experience = {}
    let editIndex:Number = null
    const count:number = 8

    return {
      experiences,
      experience,
      editIndex,
      count,
      showModal: false,
    }
  },
  mounted () {
    this.get(this.count)

    this.$nuxt.$on('experienceAdd', (experience: Experience) => {
      console.log("EVENT WORKS ");

      if( this.editIndex != null)
        Vue.set(this.experiences, this.editIndex, experience)
      else
        this.experiences.push(experience);

      this.editIndex = null;
      this.experience = {};
   })
  },
  beforeDestroy() {
    this.$nuxt.$off('experienceAdd');
  },
  methods: {
    // fetch initial data
    async get (count: number): Promise<void> {
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
      console.log(index);
      this.$axios.delete('experiences/'+experience.id ).then((res: any) => {
        this.experiences.splice(index, 1);
      })
    }

  },

})
</script>
