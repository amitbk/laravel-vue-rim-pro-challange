<template>
  <div>
    <div class="relative p-6 flex-auto">
      

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="skill">
          {{ tagType.title }}
        </label>
        <input v-model="tag.title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="tagType.title" type="text" :placeholder="tagType.title">
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
import { Tag } from '@/types/api'

export default Vue.extend({
  components: { ModalFooter },
  props: {
    tagType: {
      type: Object,
      required: true,
    },
    tagEdit: {
      type: Object as PropType<Tag>,
      default: null
    }
  },
  data() {
    const tag:Tag = {}
    return {
      tag
    }
  },
  mounted() {
      this.tag = !!this.tagEdit ? {...this.tagEdit} : this.initTag() 
  },

  methods: {
    saveAction: function() {
      console.log("Save clicked");

      // decide to create or to update
      let url = !!this.tag.id ? "tags/"+this.tag.id : "tags";
      this.tag.tag_type_id = this.tagType.index+1;
      this.$axios.post(url, this.tag).then((res: { data: { data: any } }): void => {
        this.$nuxt.$emit('tag-added', res.data.data as Tag)
        this.tag = this.initTag();
      })

    },

    initTag: function() {
      return {
        title: "",
        tag_type_id: "",
      }
    }
  }
})
</script>
