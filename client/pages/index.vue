<template>
  <div class="container p-2 lg:p-8 flex flex-col">
    <div class="m-8 flex items-center justify-center">
      <Logo />
    </div>

    


    <div class="container">
    
      <div class="grid grid-cols-1 2xl:grid-cols-2 ">
        
        <div class="grid grid-cols-1 gap-6 bg-gray-100 rounded w-full p-2">
        
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
import { Users } from '@/types/api'
import ExperienceCard from '../components/experience/ExperienceCard.vue'
import ExperienceWrapper from '../components/experience/ExperienceWrapper.vue'
import TagsWrapper from '../components/tags/TagsWrapper.vue'
import Intro from '../components/Intro.vue'
export default Vue.extend({
  components: { ExperienceCard, ExperienceWrapper, TagsWrapper, Intro },
  data () {
    const users:Users = []
    const count:number = 9

    return {
      users,
      count,
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
