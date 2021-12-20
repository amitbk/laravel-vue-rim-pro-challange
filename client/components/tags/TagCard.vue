<template>
  <div>
    <div class="grid grid-cols-1 gap-3 bg-white rounded-lg shadow p-3 mt-2">
        
        <div class="w-full flex">
          <span class="flex-1 text-2xl">{{ tagType.title }}</span>
          <PushButton @click="onTagAdd" class="" theme="indigo">
            Add New
          </PushButton>
        </div>

        <!-- Show tag list -->
        <div v-for="(tag,index) in tags" class="w-full flex items-center justify-between bg-sky-100 rounded border-gray-600" :key="index">
            <div class="flex-1 p-2">
              {{tag.title}}
            </div>
            <icon-edit @click.native="onEditClick(index, tag)" class="bg-sky-50 hover:bg-sky-100 px-2 h-full cursor-pointer w-8 h-8 " />
            <icon-trash @click.native="onDeleteClick(index, tag)" class="bg-sky-50 hover:bg-sky-100 px-2 h-full cursor-pointer w-8 h-8 " />
        </div>

        <!-- Skeleton -->
        <tag-card-skeleton v-if="tags.length == 0 && loading == true"/>
        
    </div>
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { PropType } from '@nuxtjs/composition-api'
import { Tag, Tags } from '../../types/api'

import TagAdd from './TagAdd.vue'
import TagCardSkeleton from './TagCardSkeleton.vue'

export default Vue.extend({
  components: { TagAdd, TagCardSkeleton },
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
    loading: {
      type: Boolean,
      required: true,
    },
  },
  
  methods: {

    /**
     * Emit events back to parent for actions
     * add, edit, delete
     */
    onTagAdd(): void {
      this.$emit('tag-add', this.tagType.index)
    },
    onEditClick(index: number, tag: Tag): void {
      this.$emit('tag-edit', {index, tag})
    },
    onDeleteClick(index: number, tag: Tag): void {
      this.$emit('tag-delete', {index, tag})
    },
  }
})
</script>
