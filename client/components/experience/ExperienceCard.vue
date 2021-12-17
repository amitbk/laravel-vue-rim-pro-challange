<template>
  <li class="col-span-1 bg-white rounded-lg shadow">
    <div class="w-full flex items-center justify-between p-6 space-x-6">
      <!-- <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0" :src="user.avatar" alt="avatar"> -->
      <icon-fume class="w-10 h-10" />

      <div class="flex-1 truncate">
        <div class="flex items-center space-x-3">
          <h3 class="text-gray-900 text-sm leading-5 font-medium truncate">
            Company Name {{ user.name }}
          </h3>
          <span
            v-if="is_admin"
            class="flex-shrink-0 inline-block px-2 text-teal-800 text-xs leading-4 font-medium bg-green-100 rounded-full py-0.5"
          >
            Admin
          </span>
        </div>
        <p class="mt-1 text-gray-500 text-sm leading-5 truncate">
          Role {{ user.job }}
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

  </li>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { User } from '@/client/types/api'
export default Vue.extend({
  props: {
    user: {
      type: Object as PropType<User>,
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
