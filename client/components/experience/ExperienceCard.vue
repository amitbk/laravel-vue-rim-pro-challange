<template>
  <li class="col-span-1 bg-white rounded-lg shadow">
    <div class="w-full flex items-center justify-between p-6 space-x-6">
      <!-- <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0" :src="experience.avatar" alt="avatar"> -->
      <icon-fume class="w-10 h-10" />

      <div class="flex-1 truncate">
        <div class="flex items-center space-x-3">
          <h3 class="text-gray-900 text-sm leading-5 font-medium truncate">
            {{ experience.company }}
          </h3>
        </div>
        <p class="mt-1 text-gray-500 text-sm leading-5 truncate">
          {{ experience.role }}
        </p>
        <div class="w-full flex text-sm mt-1">
          <div class="rounded-full flex-shrink-0 pr-1">
            <icon-clock class="w-5 h-5" />
          </div>
          <div class="flex-1 text-gray-500 truncate">
            2019 - 2021
          </div>
        </div>
      </div>

      
    </div>

    <div class="border-t border-gray-200">
      <div class="-mt-px flex">
        <div class="w-0 flex-1 flex border-r border-gray-200">
          <a
            @click="$emit('edit')"
            class="relative cursor-pointer -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-bl-lg transition ease-in-out duration-150 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
          >
            <icon-edit class="w-5 h-5" />
            <span class="ml-3">Edit</span>
          </a>
        </div>
        <div class="-ml-px w-0 flex-1 flex">
          <a
            @click="$emit('delete')"
            class="relative cursor-pointer w-0 flex-1 inline-flex items-center justify-center py-4 text-sm leading-5 text-gray-700 font-medium border border-transparent rounded-br-lg transition ease-in-out duration-150 hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 focus:z-10"
          >
            <icon-trash class="w-5 h-5" />
            <span class="ml-3">Delete</span>
          </a>
        </div>
      </div>
    </div>

  </li>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Experience } from '@/client/types/api'
export default Vue.extend({
  props: {
    experience: {
      type: Object as PropType<Experience>,
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
