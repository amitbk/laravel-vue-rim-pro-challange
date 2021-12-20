<template>
  <div class="container p-2 lg:p-8 flex flex-col">
    <div class="mb-5 flex items-center justify-center">
      <Logo />
    </div>

    <div class="container">
      <div class="grid grid-cols-1 bg-sky-100 p-3 rounded text-center text-xl mb-2">
        I'm looking for a place where I can work with smart people, learn new things forever and keep myself updated. 🚀
      </div>
      <div class="grid grid-cols-1 gap-5 2xl:grid-cols-2 ">
        <div class="grid grid-cols-1 bg-gray-100 rounded w-full">
      
          <div>
            <intro/>
            <tags-wrapper/>
          </div>

        </div>

        <!-- experience -->
        <experience-wrapper/>
      </div>
      
    </div>    
    
  </div>
</template>

<script lang="ts">
import Vue from 'vue'
import ExperienceCard from '../components/experience/ExperienceCard.vue'
import ExperienceWrapper from '../components/experience/ExperienceWrapper.vue'
import TagsWrapper from '../components/tags/TagsWrapper.vue'
import Intro from '../components/Intro.vue'
export default Vue.extend({
  components: { ExperienceCard, ExperienceWrapper, TagsWrapper, Intro },
})
</script>
