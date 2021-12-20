<template>
  <div>
    <div class="relative p-6 flex-auto">
      

      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="skill">
          {{ tagType.title }}
        </label>
        <input v-model="tag.title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" :id="tagType.title" type="text" :placeholder="tagType.title">
      </div>

      <div v-if="!!errors">
        <div v-for="(err, index) in errors" :key="index" class="text-red-700">{{ err.detail }} </div>
      </div>

    </div>

    <!--footer-->
    <modal-footer :saveAction="saveAction" @toggle-modal="$emit('toggle-modal')"/>
    
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import { PropType } from '@nuxtjs/composition-api'
import { Tag } from '../../types/api'

import ModalFooter from '../widgets/ModalFooter.vue'

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
    const errors:Object = {}

    return {
      tag: {} as Tag,
      errors
    }
  },
  mounted() {
    // Check if tag is selected to edit or initialize new tag
    this.tag = !!this.tagEdit ? {...this.tagEdit} : this.initTag() 
  },

  methods: {

    /**
     * on `Save` click,
     * This will call an api to send data to server.
     * Can: Create or update tag
     */
    saveAction: function() {


      let self = this;
      this.tag.tag_type_id = this.tagType.index;
      let url = !!this.tag.id ? "tags/"+this.tag.id : "tags";
      return new Promise((resolve, reject) => {
        // decide to create or to update
        this.$axios.post(url, this.tag)
                          .then((res: { data: { data: any } }): void => {
                            // emit event to update `tags` object to show on UI
                            self.$nuxt.$emit('tag-added', res.data.data as Tag)
                            // reset form
                            self.tag = self.initTag();
                            self.$toast.success('New '+self.tagType.title+' added.')
                            resolve(res)
                          }).catch((err) => {
                            // set errors if any
                            self.errors = err.response.data.errors;
                            reject(err)
                          })
        });
      
    },

    initTag: function() {
      let tag:Tag = {} as Tag;
      return tag
    }
  }
})
</script>
