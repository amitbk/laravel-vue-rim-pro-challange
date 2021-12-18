<template>
  <div>
    <div class="p-2">
      
      <span class="text-2xl">{{ tagType.title }}</span>
      <span class="bg-gray-700 text-white cursor-pointer rounded p-2"  @click="onTagAdd">Add New</span>

    </div>
    <div class="col-span-1 bg-white rounded-lg shadow">
      <div class="w-full flex p-6 space-x-2">
        
        <span v-for="(tag,index) in tags" class="bg-gray-200 p-2 rounded" :key="index">
          <div class="flex">
            {{tag.title}}
            <icon-edit @click.native="onEditClick(index, tag)" class="cursor-pointer w-5 h-5 mx-1" />
            <icon-trash @click.native="onDeleteClick(index, tag)" class="cursor-pointer w-5 h-5 mx-1" />
          </div>
        </span>

      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Tags } from '@/client/types/api'
import { Tag } from '@/client/types/api'
import TagAdd from './TagAdd.vue'
export default Vue.extend({
  components: { TagAdd },
  data() {
    return {
      showModal: false,
    }
  },
  props: {
    tagType: {
      type: Object,
      required: true,
    },
    tags: {
      type: Array as PropType<Tags>,
      required: true,
    },
  },
  computed: {
    is_admin () {
      return Math.random() >= 0.5
    },
  },
  methods: {
    onTagAdd() {
      this.$emit('tag-add', this.tagType.index)
    },

    onEditClick(index: Number, tag: Tag) {
      this.$emit('tag-edit', {index, tag})
    },
    onDeleteClick(index: Number, tag: Tag) {
      this.$emit('tag-delete', {index, tag})
    },
  }
})
</script>
