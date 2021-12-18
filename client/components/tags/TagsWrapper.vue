<template>
  <div class="grid grid-cols-1 gap-6 bg-gray-100 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
    <div>
        <tag-card :tags="getSkills" :tagType="tagTypes[1]" :loading="loading"
            @tag-add="onTagAdd"
            @tag-edit="onTagEdit"
            @tag-delete="onTagDelete"
        />
    </div>
    <div>
        <tag-card :tags="getExperiences" :tagType="tagTypes[2]" :loading="loading"
            @tag-add="onTagAdd"
            @tag-edit="onTagEdit"
            @tag-delete="onTagDelete"
        />
    </div>

    <modal :title="getModalTitle" :showModal="showModal">
        <tag-add
            :tagEdit="tag"
            :tagType="tagTypes[selectedTagTypeId]"
            @toggle-modal="showModal = !showModal"
            />
    </modal>
  </div>
</template>

<script lang="ts">
import { PropType } from '@nuxtjs/composition-api'
import Vue from 'vue'
import { Tag } from '@/client/types/api'
import { Tags } from '@/types/api'
import Modal from '../widgets/Modal.vue'
import TagCard from "./TagCard.vue"
import TagAdd from "./TagAdd.vue"
import { deleteConfirmModal } from "../../utils"

export default Vue.extend({
  components: { Modal, TagCard, TagAdd },
  data () {
    let tags:Tags = []
    let tag:Tag = {}
    let editIndex:Number = null
    const count:number = 8
    const selectedTagTypeId:Number = 0
    const tagTypes:Object = [
                            {},
                            {title: "Skills", index: 1},                
                            {title: "Interests", index: 2},                
                        ]

    return {
      tags,
      tag,
      editIndex,
      count,
      showModal: false,
      tagTypes,
      selectedTagTypeId,
      loading: false
    }
  },
  computed: {
      getModalTitle: function() {
          return this.selectedTagTypeId!= null ? this.tagTypes[this.selectedTagTypeId].title : "No title";
      },

      getSkills: function() {
          return !!this.tags ? this.tags.filter((el: { tag_type_id: Number }) => el.tag_type_id == 1) : {};
      },
      getExperiences: function() {
          return !!this.tags ? this.tags.filter((el: { tag_type_id: Number }) => el.tag_type_id == 2) : {};
      },
  },
  mounted () {
    this.loading = true
    this.get().then(() => {
        this.loading = false
    })

    this.$nuxt.$on('tag-added', (tag: Tag) => {
      if( this.editIndex != null)
        Vue.set(this.tags, this.editIndex, tag)
      else
        this.tags.push(tag);

      this.editIndex = null;
      this.tag = {};
   })
  },
  
  methods: {
    onTagAdd(tagTypeId) {
        this.selectedTagTypeId = tagTypeId;
        this.showModal = true;
    },
    // fetch initial data
    async get (): Promise<void> {
      await this.$sleep(2000)
      this.tags = (
        await this.$axios.get('tags')
      ).data.data as Tags
    },

    onTagEdit(data: any) {
      this.editIndex = this.tags.findIndex(e => e.id === data.tag.id)
      this.tag = data.tag;
      this.selectedTagTypeId = data.tag.tag_type_id;
      this.showModal = true;
    },

    onTagDelete(data: any) {
      deleteConfirmModal( this, () => {

          this.$axios.delete('tags/'+data.tag.id ).then((res: any) => {
                let index = this.tags.findIndex(e => e.id === data.tag.id)
                this.tags.splice(index, 1);
                this.$toast.success( this.tagTypes[data.tag.tag_type_id].title + ' deleted.')
            })
        })
    }

  },

  beforeDestroy() {
    this.$nuxt.$off('tag-added');
  },

})
</script>
