<template>
  <div class="container p-2">
    <div class="p-2 mb-1">
      <span class="text-2xl">Experience</span>
      <span class="bg-gray-700 text-white cursor-pointer rounded p-2"  @click="showModal = true">Add New</span>

      <modal title="Add Experience" :showModal="showModal">
        <experience-add @toggle-modal="showModal = !showModal"/>
      </modal>

    </div>
    <ul v-if="users.length === 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
        <experience-skeleton v-for="i in 9" :key="`skel-${i}`" />
      </ul>
      <ul v-if="users.length &gt; 0" class="grid grid-cols-1 gap-6 bg-gray-100 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
        <experience-card v-for="(user, index) in users" :key="index" :user="user" />
    </ul>
  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { User } from '@/client/types/api'
import { Users } from '@/types/api'
import Modal from '../widgets/Modal.vue'
import ExperienceAdd from './ExperienceAdd.vue'

export default Vue.extend({
  components: { Modal, ExperienceAdd },
  data () {
    const users:Users = []
    const count:number = 8

    return {
      users,
      count,
      showModal: true
    }
  },
  mounted () {
    this.get(this.count)
    console.log('test')
  },
  methods: {
    async get (count: number): Promise<void> {
      await this.$sleep(2000)
      this.users = (
        await this.$axios.get('example', { params: { count } })
      ).data.data as Users
    },
    total (count: number): void {
      this.users = []
      this.count = count
      this.get(this.count)
    },
  },

})
</script>
