<template>
  <div class="grid grid-cols-1 gap-2 bg-gray-100 rounded w-full sm:grid-cols-2 lg:grid-cols-2">
    
    <!-- Skills -->
    <div>
        <tag-card :tags="getSkills" :tagType="tagTypes[1]" :loading="loading"
            @tag-add="onTagAdd"
            @tag-edit="onTagEdit"
            @tag-delete="onTagDelete"
        />
    </div>

    <!-- Experiences -->
    <div>
        <tag-card :tags="getExperiences" :tagType="tagTypes[2]" :loading="loading"
            @tag-add="onTagAdd"
            @tag-edit="onTagEdit"
            @tag-delete="onTagDelete"
        />
    </div>

    <!-- Modal to add new Tags -->
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
import Vue from 'vue'

import { Tag, Tags, TagTypes } from '../../types/api'
import { deleteConfirmModal } from "../../utils"

import Modal from '../widgets/Modal.vue'
import TagCard from "./TagCard.vue"
import TagAdd from "./TagAdd.vue"

export default Vue.extend({
  components: { Modal, TagCard, TagAdd },
  data () {
    const tagTypes:TagTypes = [
                            {title: "", index: 0},                
                            {title: "Skills", index: 1},                
                            {title: "Interests", index: 2},                
                        ]
    const showModal:Boolean = false

    return {
      tags: [] as Tags,
      tag: {} as Tag,
      editIndex: null as number | null, // used to set which `tag` is being edited
      showModal, // used to manage modal state to add tags
      tagTypes,
      selectedTagTypeId: 0 as number,
      loading: false as Boolean // usefull to decide when to show skeleton
    }
  },
  computed: {
    getModalTitle(): String {
        return this.selectedTagTypeId > 0 ? this.tagTypes[this.selectedTagTypeId].title : "No title";
    },

    getSkills(): Tags {
        return !!this.tags ? this.tags.filter((el: Tag) => el.tag_type_id == 1) : {} as Tags;
    },
    getExperiences(): Tags {
        return !!this.tags ? this.tags.filter((el: Tag) => el.tag_type_id == 2) : {} as Tags;
    },
  },
  mounted () {
    this.loading = true

    // fet All tags
    this.get().then(() => {
        this.loading = false
    })

    // Event listener: To detect when tag will be added or updated.
    // This will update `tags` data property
    this.$nuxt.$on('tag-added', (tag: Tag) => {
      if( this.editIndex != null)
        Vue.set(this.tags, this.editIndex, tag)
      else
        this.tags.push(tag);

      this.editIndex = null;
      this.tag = {} as Tag
   })

  },
  
  methods: {
    
    // Show modal, on `Add Tag` button click
    onTagAdd(tagTypeId: number): void {
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

    // On `Tag edit`, set tag to edit and show modal
    onTagEdit(data: any): void {
      this.editIndex = this.tags.findIndex(e => e.id === data.tag.id)
      this.tag = data.tag;
      this.selectedTagTypeId = data.tag.tag_type_id;
      this.showModal = true;
    },

    // on `Tag delete`, show confirmation modal and delete on confirm
    onTagDelete(data: any): void {
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
    // Remove event listener beforeDestroying the component
    this.$nuxt.$off('tag-added');
  },

})
</script>
